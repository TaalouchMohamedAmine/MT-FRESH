@props(['href' => null, 'variant' => 'primary', 'type' => 'button'])

@php
    $classes = 'inline-flex min-h-[52px] items-center justify-center gap-2 rounded-full px-6 text-sm font-bold transition active:scale-[.98] disabled:pointer-events-none disabled:opacity-50';
    $classes .= match ($variant) {
        'secondary' => ' border border-secondary bg-white text-secondary hover:bg-secondary/5',
        'ghost' => ' text-on-surface hover:bg-surface-low',
        default => ' bg-primary-container text-white shadow-juice hover:brightness-105',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
