<?php

namespace App\Livewire;

use App\Models\BusinessSetting;
use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class CartContents extends Component
{
    public string $fulfillment = 'delivery';

    #[On('cart-updated')]
    public function refreshCart(): void {}

    public function updatedFulfillment(): void
    {
        $this->dispatch('cart-updated');
    }

    public function quantity(int $sizeId, int $quantity, CartService $cart): void
    {
        $cart->setQuantity($sizeId, $quantity);
        $this->dispatch('cart-updated');
    }

    public function remove(int $sizeId, CartService $cart): void
    {
        $cart->remove($sizeId);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $cart = app(CartService::class);
        $settings = BusinessSetting::current();
        $lines = $cart->lines();
        $subtotal = (float) $lines->sum('line_total');
        $deliveryFee = $this->fulfillment === 'delivery' ? (float) $settings->delivery_fee : 0;

        return view('livewire.cart-contents', [
            'lines' => $lines,
            'quantity' => (int) $lines->sum('quantity'),
            'subtotal' => $subtotal,
            'deliveryFee' => $deliveryFee,
            'total' => $subtotal + $deliveryFee,
            'currency' => $settings->currency,
        ]);
    }
}
