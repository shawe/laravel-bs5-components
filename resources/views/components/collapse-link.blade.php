{{--
Use:

<x-bs::collapse-link collapsableId="myDiv" href="#myDiv" :label="__('Collapse div')" color="primary" icon="link" />
--}}

@props([
    'collapsableId' => null,
    'icon' => null,
    'label' => null,
    'color' => null,
    'href' => '#',
    'click' => null,
])

@php
    $attributes = $attributes->class([
        'text-' . $color => $color,
    ])->merge([
        'href' => $href,
        'wire:click.prevent' => $click,
    ]);
@endphp

<x-bs::link :icon="$icon" :label="$label" :color="$color" data-bs-toggle="collapse"
            aria-controls="{{ $collapsableId }}" {{ $attributes }} />