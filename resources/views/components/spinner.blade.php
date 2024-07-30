{{--
Use:

<x-bs::spinner />
--}}

@props([
    'loading' => __('Loading'),
])

<div {{ $attributes->merge(['class' => 'spinner-border', 'role' => 'status']) }}>
    <span class="visually-hidden">{{ $loading }}</span>
</div>
