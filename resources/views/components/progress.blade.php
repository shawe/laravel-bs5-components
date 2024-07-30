{{--
Use:

<x-bs::progress :label="__('25% Complete')" percent="25" color="success" height="10" animated striped />
--}}

@props([
    'label' => null,
    'value' => 0,
    'min' => 0,
    'max' => 100,
    'color' => 'primary',
    'height' => null,
    'animated' => false,
    'striped' => false,
])

@php
    $attributes = $attributes->class([
        'progress-bar',
        'progress-bar-animated' => $animated,
        'progress-bar-striped' => $striped,
        'bg-' . $color => $color,
    ])->merge([
        'style' => 'width: ' . $value . '%;' . ($height ? ' height: ' . $height . 'px;' : ''),
    ]);
@endphp

<div class="progress mb-3" role="progressbar" aria-valuenow="{{ $value }}" aria-valuemin="{{ $min }}"
     aria-valuemax="{{ $max }}"
     style="{{($height ? ' height: ' . $height . 'px;' : '')}}"
>
    <div {{ $attributes }}>
        {{ $label ?? $slot }}
    </div>
</div>
