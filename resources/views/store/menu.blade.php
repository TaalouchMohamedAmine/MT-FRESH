@extends('layouts.app', ['title' => __('site.nav.menu')])

@section('content')
<div class="page-shell py-8 sm:py-12">
    <div class="max-w-2xl">
        <p class="text-xs font-bold uppercase tracking-[.16em] text-secondary">{{ __('site.menu.eyebrow') }}</p>
        <h1 class="mt-2 font-display text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('site.menu.title') }}</h1>
        <p class="mt-3 text-base leading-7 text-on-surface-variant">{{ __('site.menu.copy') }}</p>
    </div>

    <form action="{{ route('store.menu', ['locale' => app()->getLocale()]) }}" method="get" role="search" class="mt-7 max-w-xl">
        @if ($activeCategory)<input type="hidden" name="category" value="{{ $activeCategory }}">@endif
        <label class="sr-only" for="menu-search">{{ __('site.menu.search') }}</label>
        <div class="flex min-h-12 items-center gap-3 rounded-full border border-outline-variant/60 bg-white px-4 focus-within:border-primary focus-within:ring-4 focus-within:ring-primary-container/15">
            <span class="material-symbols-outlined text-secondary" aria-hidden="true">search</span>
            <input id="menu-search" name="q" value="{{ $search }}" placeholder="{{ __('site.menu.search') }}" class="min-w-0 flex-1 border-0 bg-transparent py-3 text-sm outline-none placeholder:text-on-surface-variant/70">
            <button class="text-sm font-bold text-primary" type="submit">{{ __('site.menu.search') }}</button>
        </div>
    </form>

    <nav class="mt-6 flex gap-2 overflow-x-auto pb-2" aria-label="{{ __('site.menu.all') }}">
        <a href="{{ route('store.menu', ['locale' => app()->getLocale()]) }}" @class(['whitespace-nowrap rounded-full border px-4 py-2 text-sm font-bold', 'border-on-surface bg-on-surface text-white' => ! $activeCategory, 'border-outline-variant/60 bg-white hover:bg-surface-low' => $activeCategory])>{{ __('site.menu.all') }}</a>
        @foreach ($categories as $category)
            <a href="{{ route('store.menu', ['locale' => app()->getLocale(), 'category' => $category->slug, 'q' => $search ?: null]) }}" @class(['whitespace-nowrap rounded-full border px-4 py-2 text-sm font-bold', 'border-on-surface bg-on-surface text-white' => $activeCategory === $category->slug, 'border-outline-variant/60 bg-white hover:bg-surface-low' => $activeCategory !== $category->slug])>{{ $category->translated('name') }}</a>
        @endforeach
    </nav>

    @if ($products->count())
        <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
                <x-product-card :product="$product" :currency="$currency" />
            @endforeach
        </div>
        <div class="mt-8">{{ $products->links() }}</div>
    @else
        <div class="mt-8 rounded-card bg-surface-low p-10 text-center text-on-surface-variant">{{ __('site.menu.empty') }}</div>
    @endif
</div>
@endsection
