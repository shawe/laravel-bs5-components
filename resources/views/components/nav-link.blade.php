{{--
Use:

<x-bs::nav-link :label="__('Users')" route="users" />
--}}

@props([
    'icon' => null,
    'label' => null,
    'route' => null,
    'url' => null,
    'href' => null,
    'click' => null,
    'selected' => false,
    'toogle' => false,
    'target' => false,
])

@php
    if ($route) $href = route($route);
    else if ($url) $href = url($url);

    $attributes = $attributes->class([
        'nav-link',
        'rounded-top-3',
        'bg-white' => (bool) $selected,
        'bg-light' => !(bool) $selected,
        'active' => (bool) $selected,
    ])->merge([
        'href' => $href,
        'wire:click.prevent' => $click,
        'data-bs-toggle' => $toogle,
        'data-bs-target' => '#' . $target,
        'aria-controls' => $target ? $target : false,
        'aria-selected' => (bool) $selected ? 'true' : 'false',
        'tabindex' => (bool) $selected ? false : -1,
    ]);
@endphp

<button {{ $attributes }}>
    <x-bs::fa-icon :name="$icon"/>

    {!! $label ?? $slot !!}
</button>
