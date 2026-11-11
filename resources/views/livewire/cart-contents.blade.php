<div class="grid gap-6 lg:grid-cols-[1fr_340px]">
    <section>
        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <p class="text-sm font-semibold text-secondary">{{ $quantity }} {{ __('site.cart.item') }}</p>
            <div class="flex rounded-full bg-surface-low p-1">
                <button type="button" wire:click="$set('fulfillment', 'delivery')" @class(['rounded-full px-4 py-2 text-sm font-bold transition', 'bg-primary-container text-white shadow-sm' => $fulfillment === 'delivery', 'text-on-surface-variant' => $fulfillment !== 'delivery'])>{{ __('site.cart.delivery') }}</button>
                <button type="button" wire:click="$set('fulfillment', 'pickup')" @class(['rounded-full px-4 py-2 text-sm font-bold transition', 'bg-primary-container text-white shadow-sm' => $fulfillment === 'pickup', 'text-on-surface-variant' => $fulfillment !== 'pickup'])>{{ __('site.cart.pickup') }}</button>
            </div>
        </div>
        @forelse ($lines as $line)
            <article wire:key="cart-{{ $line->size->id }}" class="mb-3 flex gap-4 rounded-card border border-outline-variant/40 bg-white p-3 shadow-card sm:p-4">
                <div class="size-24 shrink-0 overflow-hidden rounded-xl bg-primary-container/10 sm:size-28">
                    @if ($line->product->image_url)<img src="{{ $line->product->image_url }}" onerror="this.onerror=null;this.src='{{ asset('images/juice-placeholder.svg') }}';" alt="{{ $line->product->translated('name') }}" loading="lazy" class="h-full w-full object-cover">@else<div class="grid h-full place-items-center text-4xl" aria-hidden="true">🍊</div>@endif
                </div>
                <div class="flex min-w-0 flex-1 flex-col justify-between py-1">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0"><h2 class="truncate font-display font-bold">{{ $line->product->translated('name') }}</h2><p class="mt-1 text-sm text-on-surface-variant">{{ $line->size->translated('label') }}</p></div>
                        <button type="button" wire:click="remove({{ $line->size->id }})" class="rounded-full p-2 text-xs text-on-surface-variant hover:bg-surface-low" aria-label="{{ __('site.cart.remove') }}">×</button>
                    </div>
                    <div class="mt-2 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 rounded-full bg-surface-low px-2 py-1">
                            <button type="button" wire:click="quantity({{ $line->size->id }}, {{ $line->quantity - 1 }})" class="grid size-7 place-items-center rounded-full font-bold" aria-label="−">−</button>
                            <span class="min-w-5 text-center text-sm font-bold">{{ $line->quantity }}</span>
                            <button type="button" wire:click="quantity({{ $line->size->id }}, {{ $line->quantity + 1 }})" class="grid size-7 place-items-center rounded-full font-bold" aria-label="+">+</button>
                        </div>
                        <span class="font-display font-bold text-primary">{{ number_format($line->line_total, 3) }} {{ $currency }}</span>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-card bg-surface-low p-10 text-center"><p class="font-display text-lg font-bold">{{ __('site.cart.empty') }}</p><a href="{{ route('store.menu', ['locale' => app()->getLocale()]) }}" class="mt-4 inline-block font-bold text-primary">{{ __('site.cart.browse') }} →</a></div>
        @endforelse
    </section>
    <aside class="h-fit rounded-card bg-white p-5 shadow-card lg:sticky lg:top-24">
        <h2 class="font-display text-lg font-bold">{{ __('site.checkout.title') }}</h2>
        <dl class="mt-4 space-y-3 text-sm">
            <div class="flex justify-between gap-3"><dt class="text-on-surface-variant">{{ __('site.cart.subtotal') }}</dt><dd class="font-semibold">{{ number_format($subtotal, 3) }} {{ $currency }}</dd></div>
            <div class="flex justify-between gap-3"><dt class="text-on-surface-variant">{{ __('site.cart.delivery_fee') }}</dt><dd class="font-semibold">{{ number_format($deliveryFee, 3) }} {{ $currency }}</dd></div>
            <div class="flex justify-between gap-3 border-t border-outline-variant/50 pt-3 text-base"><dt class="font-bold">{{ __('site.cart.total') }}</dt><dd class="font-display font-bold text-primary">{{ number_format($total, 3) }} {{ $currency }}</dd></div>
        </dl>
        @if ($lines->isNotEmpty())<a href="{{ route('store.checkout', ['locale' => app()->getLocale(), 'fulfillment' => $fulfillment]) }}" class="mt-5 inline-flex min-h-[52px] w-full items-center justify-center rounded-full bg-primary-container px-5 text-sm font-bold text-white shadow-juice">{{ __('site.cart.checkout') }} <span class="ms-2" aria-hidden="true">→</span></a>@endif
    </aside>
</div>
