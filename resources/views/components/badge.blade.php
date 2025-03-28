{{--
Use:

<x-bs::badge :label="__('Pending')" color="warning" />
--}}

@props([
    'icon' => null,
    'label' => null,
    'color' => 'primary',
    'rounded' => false,
])

@php
    $attributes = $attributes->class([
        'badge bg-' . $color,
        'rounded-pill' => $rounded,
        'mb-1'
    ])->merge([
        //
    ]);
@endphp

<span {{ $attributes }}>
    <x-bs::fa-icon :name="$icon"/>

    {!! $label ?? $slot !!}
</span>
