{{--
Use:

<x-bs::breadcrumb-item>
    <x-bs::link :label="__('Home')" route="home" />
</x-bs::breadcrumb>
--}}

@props([
    'active' => false,
    'label' => null,
    'route' => null,
])

@php
    $attributes = $attributes->class([
        'breadcrumb-item',
        'active' => $active,
    ])->merge([
        //
    ]);
@endphp

<li {{ $attributes }} @if ($active) aria-current="page" @endif >
    <x-bs::link :label="$label" route="$route"/>
</li>