@extends('layouts.app', ['title' => __('site.checkout.success')])
@section('content')
<div class="page-shell py-10 sm:py-16">
    <section class="mx-auto max-w-2xl rounded-shell bg-white p-6 text-center shadow-card sm:p-10">
        <span class="mx-auto grid size-16 place-items-center rounded-full bg-secondary-container text-secondary"><span class="material-symbols-outlined text-3xl">check</span></span>
        <p class="mt-5 text-xs font-bold uppercase tracking-[.16em] text-secondary">MT FRESH</p><h1 class="mt-2 font-display text-3xl font-extrabold">{{ __('site.checkout.success') }}</h1>
        <p class="mt-3 leading-7 text-on-surface-variant">{{ __('site.checkout.confirmation') }}</p><p class="mt-5 text-sm text-on-surface-variant">{{ __('site.checkout.order_number') }}: <strong class="text-on-surface">{{ $order->order_number }}</strong></p>
        <div class="mt-6 rounded-2xl bg-surface-low p-4 text-start">
            @foreach ($order->items as $item)<div class="flex justify-between gap-3 py-2 text-sm"><span>{{ $item->quantity }} × {{ $item->product_name }} · {{ $item->size_label }}</span><span class="font-semibold">{{ number_format((float) $item->line_total, 3) }} {{ $order->currency }}</span></div>@endforeach
            <div class="mt-2 flex justify-between border-t border-outline-variant/50 pt-3 font-bold"><span>{{ __('site.cart.total') }}</span><span>{{ number_format((float) $order->total, 3) }} {{ $order->currency }}</span></div>
        </div>
        @if ($settings->whatsapp_number)
            @php
                $summary = __('site.checkout.order_number').': '.$order->order_number."\n";
                foreach ($order->items as $item) $summary .= $item->quantity.' × '.$item->product_name.' ('.$item->size_label.') — '.number_format((float) $item->line_total, 3).' '.$order->currency."\n";
                $summary .= __('site.cart.total').': '.number_format((float) $order->total, 3).' '.$order->currency;
                $whatsappUrl = 'https://wa.me/'.preg_replace('/\D+/', '', $settings->whatsapp_number).'?text='.rawurlencode($summary);
            @endphp
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex min-h-[52px] items-center justify-center rounded-full border border-secondary px-6 text-sm font-bold text-secondary hover:bg-secondary/5">{{ __('site.checkout.whatsapp') }}</a>
        @endif
    </section>
</div>
@endsection
