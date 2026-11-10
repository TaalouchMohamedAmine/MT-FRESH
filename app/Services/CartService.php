<?php

namespace App\Services;

use App\Models\ProductSize;
use Illuminate\Support\Collection;

class CartService
{
    private const SESSION_KEY = 'store.cart';

    public function add(ProductSize $size, int $quantity = 1): void
    {
        $cart = session()->get(self::SESSION_KEY, []);
        $id = (string) $size->getKey();
        $cart[$id] = min(20, (int) ($cart[$id] ?? 0) + $quantity);
        session()->put(self::SESSION_KEY, $cart);
    }

    public function setQuantity(int $sizeId, int $quantity): void
    {
        $cart = session()->get(self::SESSION_KEY, []);
        $key = (string) $sizeId;

        if (! array_key_exists($key, $cart)) {
            return;
        }

        if ($quantity < 1) {
            unset($cart[$key]);
        } else {
            $cart[$key] = min(20, $quantity);
        }

        session()->put(self::SESSION_KEY, $cart);
    }

    public function remove(int $sizeId): void
    {
        $cart = session()->get(self::SESSION_KEY, []);
        unset($cart[(string) $sizeId]);
        session()->put(self::SESSION_KEY, $cart);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public function lines(): Collection
    {
        $cart = session()->get(self::SESSION_KEY, []);

        if ($cart === []) {
            return collect();
        }

        return ProductSize::query()
            ->with('product')
            ->whereIn('id', array_map('intval', array_keys($cart)))
            ->where('is_available', true)
            ->whereHas('product', fn ($query) => $query->where('is_available', true))
            ->get()
            ->map(function (ProductSize $size) use ($cart) {
                $quantity = min(20, max(1, (int) ($cart[(string) $size->id] ?? 1)));

                return (object) [
                    'size' => $size,
                    'product' => $size->product,
                    'quantity' => $quantity,
                    'line_total' => round((float) $size->price * $quantity, 3),
                ];
            });
    }

    public function quantity(): int
    {
        return (int) $this->lines()->sum('quantity');
    }

    public function subtotal(): float
    {
        return (float) $this->lines()->sum('line_total');
    }
}
