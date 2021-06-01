@props([
    'height' => null,
    'striped' => false,
    'animated' => false,
    'color' => 'primary',
    'percent' => 0,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'progress',
    ])->merge([
        'style' => $height ? 'height: ' . $height . 'px;' : null,
    ]);
@endphp

<div {{ $attributes }}>
    <div class="progress-bar {{ $striped ? 'progress-bar-striped' : '' }} {{ $animated ? 'progress-bar-animated' : '' }} bg-{{ $color }}"
        style="width: {{ $percent }}%;">
        {{ $label ?? $slot }}
    </div>
</div>
