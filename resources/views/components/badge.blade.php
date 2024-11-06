{{--
Use:

<x-bs::badge :label="__('Pending')" color="warning" />
--}}

@props([
    'icon' => null,
    'label' => null,
    'color' => 'primary',
])

@php
    $attributes = $attributes->class([
        'badge bg-' . $color,
    ])->merge([
        //
    ]);
@endphp

<span {{ $attributes }}>
    <x-bs::fa-icon :name="$icon"/>

    {!! $label ?? $slot !!}
</span>
