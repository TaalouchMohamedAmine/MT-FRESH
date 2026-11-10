<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function __invoke(Request $request): View
    {
        $query = Product::query()
            ->with(['category', 'availableSizes'])
            ->where('is_available', true);

        if ($request->filled('category')) {
            $categorySlug = $request->string('category')->toString();
            $query->whereHas('category', fn ($category) => $category->where('slug', $categorySlug));
        }

        if ($request->filled('q')) {
            $term = trim($request->string('q')->toString());
            $locale = app()->getLocale();
            $query->where(function ($products) use ($term, $locale) {
                $products->whereRaw("name->>? ilike ?", [$locale, "%{$term}%"])
                    ->orWhereRaw("description->>? ilike ?", [$locale, "%{$term}%"]);
            });
        }

        $settings = BusinessSetting::current();

        return view('store.menu', [
            'products' => $query->orderBy('sort_order')->paginate(12)->withQueryString(),
            'categories' => Category::query()->where('is_available', true)->orderBy('sort_order')->get(),
            'activeCategory' => $request->string('category')->toString(),
            'search' => $request->string('q')->toString(),
            'currency' => $settings->currency,
        ]);
    }
}
