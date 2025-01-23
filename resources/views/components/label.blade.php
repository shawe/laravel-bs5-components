{{--
Use:

<x-bs::label label="This is label" />
--}}

@props([
    'label' => null,
    'for' => null,
])

@php
    $attributes = $attributes->class([
        'control-label fw-bold mb-1',
    ])->merge([
        //
    ]);
@endphp

@if($label || !$slot->isEmpty())
    <label @if($for) for="{{ $for }}" @endif {{ $attributes }}>
        {!! $label ?? $slot !!}
    </label>
@endif
