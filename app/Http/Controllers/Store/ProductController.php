<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __invoke(string $locale, string $product): View
    {
        $juice = Product::query()->with(['category', 'availableSizes'])->where('slug', $product)->where('is_available', true)->firstOrFail();
        $settings = BusinessSetting::current();

        return view('store.product', [
            'product' => $juice,
            'related' => Product::query()->with('availableSizes')->where('category_id', $juice->category_id)->where('id', '!=', $juice->id)->where('is_available', true)->take(3)->get(),
            'currency' => $settings->currency,
        ]);
    }
}
