{{--
Use:

<x-bs::list-group-item :label="__('An item')" />
--}}

@props([
    'active' => false,
    'disabled' => false,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'list-group-item',
        'active' => $active,
        'disabled' => $disabled,
    ])->merge([
        //
    ]);
@endphp

<li {{ $attributes }} @if ($active) aria-current="true" @endif  @if ($disabled) aria-disabled="true" @endif >
    {!! $label ?? $slot !!}
</li>
