<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $settings = BusinessSetting::current();
        $featured = Product::query()
            ->with('availableSizes')
            ->where('is_available', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('store.home', [
            'settings' => $settings,
            'featured' => $featured,
            'categories' => Category::query()->where('is_available', true)->orderBy('sort_order')->get(),
            'currency' => $settings->currency,
        ]);
    }
}
