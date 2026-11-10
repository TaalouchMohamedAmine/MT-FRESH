@extends('layouts.app', ['title' => __('site.nav.contact')])

@section('content')
<div class="page-shell py-10 sm:py-16">
    <div class="mx-auto max-w-3xl">
        <p class="text-xs font-bold uppercase tracking-[.16em] text-secondary">MT FRESH</p>
        <h1 class="mt-2 font-display text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('site.contact.title') }}</h1>
        <p class="mt-4 max-w-xl leading-7 text-on-surface-variant">{{ __('site.contact.copy') }}</p>
        <div class="mt-8 grid gap-4 sm:grid-cols-2">
            @if ($settings->phone)
                <a href="tel:{{ $settings->phone }}" class="rounded-card bg-white p-6 shadow-card"><span class="material-symbols-outlined text-secondary">call</span><h2 class="mt-3 font-display font-bold">{{ __('site.contact.phone') }}</h2><p class="mt-1 text-sm text-on-surface-variant">{{ $settings->phone }}</p></a>
            @endif
            @if ($settings->whatsapp_number)
                <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings->whatsapp_number) }}" class="rounded-card bg-white p-6 shadow-card"><span class="material-symbols-outlined text-secondary">chat</span><h2 class="mt-3 font-display font-bold">{{ __('site.contact.whatsapp') }}</h2><p class="mt-1 text-sm text-on-surface-variant">{{ $settings->whatsapp_number }}</p></a>
            @endif
            <div class="rounded-card bg-white p-6 shadow-card"><span class="material-symbols-outlined text-secondary">schedule</span><h2 class="mt-3 font-display font-bold">{{ __('site.contact.hours') }}</h2><p class="mt-1 text-sm text-on-surface-variant">{{ data_get($settings->opening_hours, 'summary.'.app()->getLocale(), '07:30 – 20:00') }}</p></div>
            <div class="rounded-card bg-white p-6 shadow-card"><span class="material-symbols-outlined text-secondary">location_on</span><h2 class="mt-3 font-display font-bold">{{ __('site.contact.location') }}</h2><p class="mt-1 text-sm text-on-surface-variant">{{ $settings->translated('location') ?: __('site.home.location_not_set') }}</p></div>
        </div>
    </div>
</div>
@endsection
