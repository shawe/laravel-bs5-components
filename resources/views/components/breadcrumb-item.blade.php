{{--
Use:

<x-bs::breadcrumb-item>
    <x-bs::link :label="__('Home')" route="home" />
</x-bs::breadcrumb>
--}}

@props([
    'active' => false,
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
    {{ $slot }}
</li>