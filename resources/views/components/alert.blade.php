{{--
Use:

<x-bs::alert :label="__('It was successful!')" color="info" dismissible />
--}}

@props([
    'icon' => null,
    'label' => null,
    'color' => 'success',
    'dismissible' => false,
])

@php
    $attributes = $attributes->class([
        'alert alert-' . $color . ' fade show mb-0',
        'alert-dismissible' => $dismissible,
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }}>
    <x-bs::fa-icon :name="$icon"/>
    {!! $label ?? $slot !!}

    @if($dismissible)
        <x-bs::close dismiss="alert"/>
    @endif
</div>
