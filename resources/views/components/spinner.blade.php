{{--
Use:

<x-bs::spinner />
--}}

@props([
    'label' => null,
])

<div {{ $attributes->merge(['class' => 'spinner-border', 'role' => 'status']) }}>
    <span class="visually-hidden">{{ $label }}</span>
</div>
