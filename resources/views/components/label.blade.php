{{--
Use:

<x-bs::label label="This is label" />
--}}

@props([
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'control-label fw-bold',
    ])->merge([
        //
    ]);
@endphp

@if($label || !$slot->isEmpty())
    <label {{ $attributes }}>
        {!! $label ?? $slot !!}
    </label>
@endif
