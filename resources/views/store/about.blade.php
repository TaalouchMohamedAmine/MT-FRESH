@extends('layouts.app', ['title' => __('site.nav.about')])

@section('content')
<div class="page-shell py-10 sm:py-16">
    <div class="mx-auto max-w-3xl rounded-shell bg-gradient-to-br from-[#ffdbd0] to-white px-6 py-12 text-center sm:px-12 sm:py-20">
        <p class="text-xs font-bold uppercase tracking-[.16em] text-primary">MT FRESH</p>
        <h1 class="mt-4 font-display text-3xl font-extrabold tracking-tight sm:text-5xl">{{ __('site.about.title') }}</h1>
        <p class="mx-auto mt-5 max-w-2xl text-base leading-8 text-on-surface-variant">{{ __('site.about.copy') }}</p>
        <x-button class="mt-7" :href="route('store.menu', ['locale' => app()->getLocale()])">{{ __('site.home.shop') }}</x-button>
    </div>
    <section class="mx-auto mt-12 max-w-3xl text-center">
        <h2 class="font-display text-2xl font-bold">{{ __('site.about.values_title') }}</h2>
        <p class="mt-3 text-on-surface-variant">{{ __('site.about.values_copy') }}</p>
    </section>
</div>
@endsection
