@extends('layouts.app', ['title' => $product->translated('name'), 'description' => $product->translated('description')])

@section('content')
<div class="page-shell py-5 sm:py-10">
    <a href="{{ route('store.menu', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center gap-2 rounded-full px-3 py-2 text-sm font-semibold text-on-surface-variant hover:bg-surface-low"><span aria-hidden="true">←</span>{{ __('site.nav.menu') }}</a>
    <div class="mt-3 grid gap-7 lg:grid-cols-2 lg:gap-12">
        <div class="relative overflow-hidden rounded-shell bg-surface-low">
            @if ($product->is_featured)<span class="absolute start-4 top-4 z-10 rounded-full bg-primary px-3 py-1 text-xs font-bold text-white">{{ __('site.product.bestseller') }}</span>@endif
            @if ($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->translated('name') }}" fetchpriority="high" class="aspect-square w-full object-cover">
            @endif
            <div class="flex items-center justify-between gap-3 bg-surface-container/80 px-5 py-3 text-xs font-bold text-secondary"><span><span class="material-symbols-outlined me-1 align-middle text-sm">eco</span>{{ __('site.product.fresh_daily') }}</span><span>{{ __('site.product.consume') }}</span></div>
        </div>
        <div class="lg:py-5">
            <p class="text-sm font-bold text-secondary">{{ $product->category->translated('name') }}</p>
            <h1 class="mt-2 font-display text-3xl font-extrabold tracking-tight sm:text-4xl">{{ $product->translated('name') }}</h1>
            <p class="mt-4 leading-7 text-on-surface-variant">{{ $product->translated('description') }}</p>
            <div class="mt-8 border-t border-outline-variant/50 pt-6">
                @livewire('add-to-cart', ['product' => $product])
            </div>
        </div>
    </div>

    @if ($related->isNotEmpty())
        <section class="py-14">
            <h2 class="mb-5 font-display text-2xl font-bold">{{ __('site.product.related') }}</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($related as $item)<x-product-card :product="$item" :currency="$currency" />@endforeach
            </div>
        </section>
    @endif
</div>
@endsection
