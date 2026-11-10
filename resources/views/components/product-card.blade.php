@props(['product', 'currency' => 'TND'])

<article class="group flex h-full flex-col overflow-hidden rounded-card border border-outline-variant/40 bg-white shadow-card transition hover:-translate-y-1 hover:shadow-card-hover">
    <a href="{{ route('store.product', ['locale' => app()->getLocale(), 'product' => $product->slug]) }}" class="relative block aspect-[4/3] overflow-hidden bg-primary-container/10">
        @if ($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->translated('name') }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        @else
            <div class="grid h-full place-items-center text-6xl" aria-hidden="true">🍊</div>
        @endif
        @if ($product->is_featured)
            <span class="absolute start-3 top-3 rounded-full bg-primary px-3 py-1 text-[11px] font-bold text-white">{{ __('site.product.bestseller') }}</span>
        @endif
    </a>
    <div class="flex flex-1 flex-col p-4">
        <div class="mb-3 flex-1">
            <h2 class="font-display text-lg font-bold leading-tight">
                <a href="{{ route('store.product', ['locale' => app()->getLocale(), 'product' => $product->slug]) }}" class="hover:text-primary">{{ $product->translated('name') }}</a>
            </h2>
            <p class="mt-1 line-clamp-2 text-sm leading-6 text-on-surface-variant">{{ $product->translated('description') }}</p>
        </div>
        <div class="flex items-end justify-between gap-3">
            <div>
                <span class="block text-xs text-on-surface-variant">{{ __('site.menu.from') }}</span>
                <span class="font-display text-base font-bold text-primary">{{ number_format((float) $product->availableSizes->min('price'), 3) }} {{ $currency }}</span>
            </div>
            <a href="{{ route('store.product', ['locale' => app()->getLocale(), 'product' => $product->slug]) }}" class="grid size-11 shrink-0 place-items-center rounded-full bg-primary-container text-2xl font-medium text-white shadow-juice transition hover:scale-105" aria-label="{{ __('site.menu.add') }} {{ $product->translated('name') }}">+</a>
        </div>
    </div>
</article>
