{{--
Use:

<x-bs::button :label="__('Login')" color="primary" size="lg" route="login" />
--}}

@props([
    'icon' => null,
    'label' => null,
    'color' => 'primary',
    'size' => null,
    'type' => 'button',
    'route' => null,
    'url' => null,
    'href' => null,
    'dismiss' => null,
    'toggle' => null,
    'click' => null,
    'confirm' => false,
    'title' => null,
])

@php
    if ($route) $href = route($route);
    else if ($url) $href = url($url);

    $attributes = $attributes->class([
        'btn btn-' . $color,
        'btn-' . $size => $size,
    ])->merge([
        'type' => !$href ? $type : null,
        'title' => $title,
        'href' => $href,
        'data-bs-dismiss' => $dismiss,
        'data-bs-toggle' => $toggle,
        'wire:click' => $click,
        'onclick' => isset($confirm) ? $confirm : false,
    ]);
@endphp

<{{ $href ? 'a' : 'button' }} {{ $attributes }}>
    <x-bs::fa-icon :name="$icon"/>

<span @if($icon) class="ms-1" @endif >{!! $label ?? $slot !!}</span>
</{{ $href ? 'a' : 'button' }}>
