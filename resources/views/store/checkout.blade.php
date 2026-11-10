@extends('layouts.app', ['title' => __('site.checkout.title')])
@section('content')
<div class="page-shell py-8 sm:py-12"><h1 class="font-display text-3xl font-extrabold tracking-tight">{{ __('site.checkout.title') }}</h1><div class="mt-6 max-w-3xl">@livewire('checkout-form')</div></div>
@endsection
