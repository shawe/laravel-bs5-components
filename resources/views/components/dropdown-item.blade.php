{{--
Use:

<x-bs::dropdown-item :label="__('Login')" route="login" />
--}}

@props([
    'icon' => null,
    'label' => null,
    'route' => null,
    'url' => null,
    'href' => null,
    'click' => null,
])

@php
    if ($route) $href = route($route);
    else if ($url) $href = url($url);

    $attributes = $attributes->class([
        'dropdown-item',
        'active' => false,
    ])->merge([
        'type' => !$href ? 'button' : null,
        'href' => $href,
        'wire:click' => $click,
    ]);
@endphp

<{{ $href ? 'a' : 'button' }} {{ $attributes }}>
    <x-bs::fa-icon :name="$icon"/>

{!! $label ?? $slot !!}
</{{ $href ? 'a' : 'button' }}>
