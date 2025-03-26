{{--
Use:

<x-bs::link :label="__('Users')" route="users" />
--}}

@props([
    'icon' => null,
    'label' => null,
    'color' => null,
    'route' => null,
    'url' => null,
    'href' => '#',
    'click' => null,
    'title' => null,
])

@php
    if ($route) $href = route($route);
    else if ($url) $href = url($url);

    $attributes = $attributes->class([
        'text-' . $color => $color,
    ])->merge([
        'href' => $href,
        'wire:click.prevent' => $click,
        'title' => $title,
    ]);
@endphp

<a {{ $attributes }}>
    <x-bs::fa-icon :name="$icon"/>

    {!! $label ?? $slot !!}
</a>
