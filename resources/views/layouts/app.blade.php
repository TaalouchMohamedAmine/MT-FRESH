<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? __('site.home.hero_copy') }}">
    <meta name="theme-color" content="#f8f9ff">
    <title>{{ $title ?? $businessSettings->translated('business_name') }} · {{ $businessSettings->translated('business_name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0;400,1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen">
    <header class="glass-header fixed inset-x-0 top-0 z-40 border-b border-white/60 shadow-sm">
        <div class="page-shell flex h-16 items-center justify-between gap-4">
            <a href="{{ route('store.home', ['locale' => app()->getLocale()]) }}" class="flex shrink-0 items-center gap-2" aria-label="{{ __('site.nav.home') }}">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBP04ziPPc1bEV_U1VmtRUrxBmHDW4DOHXQmwXoEGLh-ClK67eTP-2i9PYq11jhDI7lDKzcUm7a_sX_RpID9j6N69jV3hgrrsG4-qd5SzRUPiMLcCUufMFXlHKAyXhKUgPlk9ycO_N4-98mbFa-JdVaMjMm3krXHBZdxpYoofcIiZmtKmCqtOhASMYe-KbW59JxECekx2yRkH0sDk9Lr6yggJcutfX7Nwp85tBcRas" alt="" class="h-8 w-8 object-contain" width="32" height="32" fetchpriority="high">
                <span class="font-display text-lg font-extrabold tracking-tight">{{ $businessSettings->translated('business_name') }}</span>
            </a>
            <nav class="hidden items-center gap-7 text-sm font-semibold md:flex" aria-label="{{ __('site.nav.home') }}">
                <a class="transition hover:text-primary" href="{{ route('store.home', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.home') }}</a>
                <a class="transition hover:text-primary" href="{{ route('store.menu', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.menu') }}</a>
                <a class="transition hover:text-primary" href="{{ route('store.about', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.about') }}</a>
                <a class="transition hover:text-primary" href="{{ route('store.contact', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.contact') }}</a>
            </nav>
            <div class="flex items-center gap-1">
                <div class="hidden gap-1 sm:flex" aria-label="Language">
                    @foreach (['fr' => 'FR', 'en' => 'EN', 'ar' => 'ع'] as $locale => $label)
                        <a href="{{ route(Route::currentRouteName() ?? 'store.home', array_merge(request()->route()?->parameters() ?? [], ['locale' => $locale])) }}"
                           lang="{{ $locale }}" @class(['rounded-full px-2.5 py-1 text-xs font-bold', 'bg-surface-high text-primary' => app()->getLocale() === $locale, 'text-on-surface-variant hover:bg-surface-low' => app()->getLocale() !== $locale])>
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
                <a href="{{ route('store.cart', ['locale' => app()->getLocale()]) }}" class="relative grid size-11 place-items-center rounded-full text-on-surface-variant transition hover:bg-surface-low" aria-label="{{ __('site.nav.cart') }}">
                    <span class="material-symbols-outlined" aria-hidden="true">shopping_bag</span>
                    @livewire('cart-count')
                </a>
            </div>
        </div>
        <nav class="page-shell flex gap-5 overflow-x-auto pb-2 text-xs font-semibold md:hidden" aria-label="{{ __('site.nav.home') }}">
            <a class="whitespace-nowrap" href="{{ route('store.home', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.home') }}</a>
            <a class="whitespace-nowrap" href="{{ route('store.menu', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.menu') }}</a>
            <a class="whitespace-nowrap" href="{{ route('store.about', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.about') }}</a>
            <a class="whitespace-nowrap" href="{{ route('store.contact', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.contact') }}</a>
        </nav>
    </header>

    <main class="min-h-[65vh] pt-24 md:pt-20">
        @yield('content')
    </main>

    <footer class="mt-20 bg-on-surface py-10 text-white">
        <div class="page-shell grid gap-8 md:grid-cols-3 md:items-center">
            <a href="{{ route('store.home', ['locale' => app()->getLocale()]) }}" class="font-display text-xl font-extrabold">{{ $businessSettings->translated('business_name') }}</a>
            <p class="text-sm text-white/70">{{ __('site.footer.tagline') }}</p>
            <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-white/80 md:justify-end">
                <a class="hover:text-white" href="{{ route('store.menu', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.menu') }}</a>
                <a class="hover:text-white" href="{{ route('store.about', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.about') }}</a>
                <a class="hover:text-white" href="{{ route('store.contact', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.contact') }}</a>
            </div>
            <p class="text-xs text-white/50 md:col-span-3">© {{ now()->year }} MT FRESH. {{ __('site.footer.rights') }}</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
