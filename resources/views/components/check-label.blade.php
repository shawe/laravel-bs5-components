{{--
Use:

<x-bs::check-label :label="__('Agree')" />
--}}

@props([
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'form-check-label',
    ])->merge([
        //
    ]);
@endphp

@if($label || !$slot->isEmpty())
    <label {{ $attributes }}>
        {!! $label ?? $slot !!}
    </label>
@endif
