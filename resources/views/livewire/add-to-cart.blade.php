<div>
    <label for="product-size" class="mb-2 block text-sm font-semibold">{{ __('site.product.choose_size') }}</label>
    <select id="product-size" wire:model.live="selectedSizeId" class="min-h-12 w-full rounded-full border border-outline-variant/70 bg-white px-4 text-sm focus:border-primary">
        @forelse ($sizes as $size)
            <option value="{{ $size->id }}">{{ $size->translated('label') }} — {{ number_format((float) $size->price, 3) }} {{ $currency }}</option>
        @empty
            <option value="">{{ __('site.menu.unavailable') }}</option>
        @endforelse
    </select>
    @error('selectedSizeId')<p class="mt-2 text-sm text-red-700">{{ $message }}</p>@enderror
    <button wire:click="add" wire:loading.attr="disabled" class="mt-4 inline-flex min-h-[52px] w-full items-center justify-center gap-2 rounded-full bg-primary-container px-6 text-sm font-bold text-white shadow-juice transition active:scale-[.98] disabled:opacity-60">
        <span wire:loading.remove>{{ __('site.product.add_to_cart') }}</span>
        <span wire:loading>{{ __('site.product.add_to_cart') }}…</span>
    </button>
    @if ($added)<p role="status" class="mt-3 text-sm font-semibold text-secondary">{{ __('site.product.added') }}</p>@endif
</div>
