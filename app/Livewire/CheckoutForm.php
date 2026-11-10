<?php

namespace App\Livewire;

use App\Models\BusinessSetting;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutForm extends Component
{
    public string $customerName = '';
    public string $phone = '';
    public string $fulfillment = 'delivery';
    public string $address = '';
    public string $notes = '';

    public function mount(): void
    {
        $fulfillment = request()->query('fulfillment', 'delivery');
        $this->fulfillment = in_array($fulfillment, ['delivery', 'pickup'], true) ? $fulfillment : 'delivery';
    }

    public function placeOrder(CartService $cart)
    {
        $key = 'checkout:'.hash('sha256', (string) request()->ip());

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('checkout', __('site.checkout.rate_limited'));
            return null;
        }

        RateLimiter::hit($key, 60);

        $validated = $this->validate([
            'customerName' => ['required', 'string', 'min:2', 'max:120'],
            'phone' => ['required', 'string', 'max:40', 'regex:/^\+?[0-9\s\-()]{7,40}$/'],
            'fulfillment' => ['required', 'in:delivery,pickup'],
            'address' => ['nullable', 'string', 'max:500', 'required_if:fulfillment,delivery'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'required' => __('site.checkout.required'),
            'required_if' => __('site.checkout.required'),
            'regex' => __('site.checkout.invalid_phone'),
            'max' => __('site.checkout.too_long'),
            'min' => __('site.checkout.too_short'),
            'in' => __('site.checkout.required'),
        ]);

        $lines = $cart->lines();
        if ($lines->isEmpty()) {
            $this->addError('checkout', __('site.cart.empty'));
            return null;
        }

        $settings = BusinessSetting::current();
        $subtotal = (float) $lines->sum('line_total');
        $deliveryFee = $validated['fulfillment'] === 'delivery' ? (float) $settings->delivery_fee : 0;

        $order = DB::transaction(function () use ($validated, $lines, $settings, $subtotal, $deliveryFee): Order {
            $order = Order::query()->create([
                'order_number' => 'MTF-'.now()->format('ymd').'-'.Str::upper(Str::random(6)),
                'customer_name' => trim($validated['customerName']),
                'phone' => trim($validated['phone']),
                'fulfillment_type' => $validated['fulfillment'],
                'address' => $validated['fulfillment'] === 'delivery' ? trim($validated['address']) : null,
                'notes' => filled($validated['notes']) ? trim($validated['notes']) : null,
                'status' => 'new',
                'payment_method' => 'cash_on_delivery',
                'locale' => app()->getLocale(),
                'currency' => $settings->currency,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $subtotal + $deliveryFee,
            ]);

            foreach ($lines as $line) {
                $order->items()->create([
                    'product_id' => $line->product->id,
                    'product_size_id' => $line->size->id,
                    'product_name' => $line->product->translated('name'),
                    'size_label' => $line->size->translated('label'),
                    'unit_price' => $line->size->price,
                    'quantity' => $line->quantity,
                    'line_total' => $line->line_total,
                ]);
            }

            return $order;
        });

        $cart->clear();

        return $this->redirectRoute('store.confirmation', ['locale' => app()->getLocale(), 'order' => $order->public_id]);
    }

    public function render()
    {
        return view('livewire.checkout-form', ['currency' => BusinessSetting::current()->currency]);
    }
}
