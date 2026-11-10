@extends('layouts.app', ['title' => 'MT FRESH', 'description' => __('site.home.hero_copy')])

@section('content')
<div class="page-shell">
    <section class="pt-4">
        <div class="flex items-center justify-between gap-3 rounded-full bg-white px-3 py-2 shadow-sm">
            <div class="flex min-w-0 items-center gap-3">
                <span class="grid size-9 shrink-0 place-items-center rounded-full bg-secondary-container text-secondary"><span class="material-symbols-outlined">location_on</span></span>
                <div class="min-w-0">
                    <p class="truncate text-xs font-bold">{{ $settings->translated('business_name') }}</p>
                    <p class="truncate text-xs font-semibold text-secondary">{{ __('site.home.open_today') }} · {{ data_get($settings->opening_hours, strtolower(now()->format('l').'.open'), '07:30') }}–{{ data_get($settings->opening_hours, strtolower(now()->format('l').'.close'), '20:00') }}</p>
                </div>
            </div>
            <a href="{{ route('store.contact', ['locale' => app()->getLocale()]) }}" class="shrink-0 rounded-full bg-surface-low px-4 py-2 text-xs font-bold">{{ __('site.home.map') }} <span aria-hidden="true">→</span></a>
        </div>
    </section>

    <section class="relative mt-4 overflow-hidden rounded-shell bg-gradient-to-br from-[#ffdbd0] via-[#fff2e9] to-white px-6 py-8 sm:px-10 sm:py-12 lg:grid lg:min-h-[390px] lg:grid-cols-2 lg:items-center lg:px-14">
        <div class="pointer-events-none absolute -end-14 -top-16 size-64 rounded-full bg-primary-container/15 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 start-1/3 size-64 rounded-full bg-secondary-container/40 blur-3xl"></div>
        <div class="relative z-10 max-w-xl">
            <div class="mb-4 flex flex-wrap gap-2">
                <span class="rounded-full bg-white/90 px-3 py-1.5 text-xs font-bold text-primary"><span class="material-symbols-outlined me-1 align-middle text-sm">eco</span>{{ __('site.home.organic') }}</span>
                <span class="rounded-full bg-white/90 px-3 py-1.5 text-xs font-bold text-secondary"><span class="material-symbols-outlined me-1 align-middle text-sm">bolt</span>{{ __('site.home.fresh_daily') }}</span>
            </div>
            <h1 class="font-display text-4xl font-extrabold leading-tight tracking-[-.04em] sm:text-5xl">{{ __('site.home.hero_title') }}</h1>
            <p class="mt-4 max-w-lg text-base leading-7 text-on-surface-variant">{{ __('site.home.hero_copy') }}</p>
            <x-button class="mt-6" :href="route('store.menu', ['locale' => app()->getLocale()])">{{ __('site.home.shop') }} <span aria-hidden="true">→</span></x-button>
        </div>
        <div class="relative z-10 mt-6 flex h-52 items-center justify-center sm:h-64 lg:mt-0 lg:h-full">
            @if ($featured->first()?->image_url)
                <img src="{{ $featured->first()->image_url }}" alt="{{ $featured->first()->translated('name') }} fresh juice" fetchpriority="high" class="h-full max-w-full rounded-card object-cover shadow-xl lg:max-h-80">
            @else
                <div class="grid size-48 place-items-center rounded-full bg-primary-container/10 text-8xl" aria-hidden="true">🍊</div>
            @endif
        </div>
    </section>

    <section class="py-14 sm:py-20">
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[.16em] text-secondary">{{ __('site.menu.eyebrow') }}</p>
                <h2 class="mt-2 font-display text-2xl font-bold tracking-tight sm:text-3xl">{{ __('site.home.featured') }}</h2>
                <p class="mt-2 text-sm text-on-surface-variant">{{ __('site.home.featured_copy') }}</p>
            </div>
            <a class="shrink-0 text-sm font-bold text-primary hover:underline" href="{{ route('store.menu', ['locale' => app()->getLocale()]) }}">{{ __('site.home.all_juices') }} <span aria-hidden="true">→</span></a>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($featured as $product)
                <x-product-card :product="$product" :currency="$currency" />
            @endforeach
        </div>
    </section>

    <section class="rounded-shell bg-surface-low px-5 py-12 sm:px-10 sm:py-16">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-xs font-bold uppercase tracking-[.16em] text-secondary">MT FRESH</p>
            <h2 class="mt-2 font-display text-2xl font-bold sm:text-3xl">{{ __('site.home.why_title') }}</h2>
            <p class="mt-3 text-sm leading-6 text-on-surface-variant">{{ __('site.home.why_copy') }}</p>
        </div>
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            @foreach (['cold_pressed' => 'water_drop', 'real_fruit' => 'nutrition', 'made_today' => 'today'] as $key => $icon)
                <article class="rounded-card bg-white p-6 shadow-card">
                    <span class="grid size-11 place-items-center rounded-full bg-secondary-container text-secondary"><span class="material-symbols-outlined">{{ $icon }}</span></span>
                    <h3 class="mt-4 font-display font-bold">{{ __('site.home.'.$key) }}</h3>
                    <p class="mt-2 text-sm leading-6 text-on-surface-variant">{{ __('site.home.'.$key.'_copy') }}</p>
                </article>
            @endforeach
        </div>
    </section>

    @if (! empty($settings->reviews))
        <section class="py-14 sm:py-20" aria-labelledby="reviews-title">
            <div class="mb-6 text-center">
                <p class="text-xs font-bold uppercase tracking-[.16em] text-secondary">MT FRESH</p>
                <h2 id="reviews-title" class="mt-2 font-display text-2xl font-bold">{{ __('site.home.reviews') }}</h2>
            </div>
            <div class="grid gap-4 md:grid-cols-3">
                @foreach ($settings->reviews as $review)
                    <figure class="rounded-card bg-white p-6 shadow-card">
                        <div class="text-tertiary" aria-label="{{ $review['rating'] ?? 5 }} / 5">{{ str_repeat('★', min(5, max(1, (int) ($review['rating'] ?? 5)))) }}</div>
                        <blockquote class="mt-3 text-sm leading-6 text-on-surface-variant">“{{ data_get($review, 'quote.'.app()->getLocale(), data_get($review, 'quote.fr', '')) }}”</blockquote>
                        <figcaption class="mt-4 font-display text-sm font-bold">{{ $review['name'] ?? '' }}</figcaption>
                    </figure>
                @endforeach
            </div>
        </section>
    @endif

    <section class="mb-16 grid gap-4 rounded-shell bg-on-surface px-6 py-10 text-white sm:grid-cols-2 sm:px-10 sm:py-12">
        <div>
            <p class="text-xs font-bold uppercase tracking-[.16em] text-secondary-container">MT FRESH</p>
            <h2 class="mt-2 font-display text-2xl font-bold">{{ __('site.home.hours_title') }}</h2>
        </div>
        <div class="grid grid-cols-2 gap-6 text-sm">
            <div><p class="font-bold">{{ __('site.home.hours') }}</p><p class="mt-2 text-white/70">{{ data_get($settings->opening_hours, 'summary.'.app()->getLocale(), '07:30 – 20:00') }}</p></div>
            <div><p class="font-bold">{{ __('site.home.location') }}</p><p class="mt-2 text-white/70">{{ $settings->translated('location') ?: __('site.home.location_not_set') }}</p></div>
        </div>
    </section>
</div>
@endsection
