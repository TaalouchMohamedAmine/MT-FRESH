<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductSize;
use App\Services\CartService;
use Livewire\Component;

class AddToCart extends Component
{
    public int $productId;

    public ?int $selectedSizeId = null;

    public bool $added = false;

    public function mount(Product $product): void
    {
        $this->productId = $product->id;
        $this->selectedSizeId = $product->availableSizes()->value('id');
    }

    public function add(CartService $cart): void
    {
        $size = ProductSize::query()
            ->whereKey($this->selectedSizeId)
            ->where('product_id', $this->productId)
            ->where('is_available', true)
            ->whereHas('product', fn ($query) => $query->where('is_available', true))
            ->first();

        if (! $size) {
            $this->addError('selectedSizeId', __('site.product.choose_size'));

            return;
        }

        $cart->add($size);
        $this->added = true;
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $settings = \App\Models\BusinessSetting::current();

        return view('livewire.add-to-cart', [
            'sizes' => ProductSize::query()->where('product_id', $this->productId)->where('is_available', true)->orderBy('sort_order')->get(),
            'currency' => $settings->currency,
        ]);
    }
}
