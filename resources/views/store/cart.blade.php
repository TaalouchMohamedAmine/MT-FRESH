@extends('layouts.app', ['title' => __('site.cart.title')])
@section('content')
<div class="page-shell py-8 sm:py-12"><h1 class="font-display text-3xl font-extrabold tracking-tight">{{ __('site.cart.title') }}</h1><div class="mt-6">@livewire('cart-contents')</div></div>
@endsection
