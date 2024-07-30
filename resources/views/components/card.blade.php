{{--
Use:

<x-bs::card>
    <slot name="header">
        <h3 class="card-header">Featured</h3>
    </slot>
    <slot name="body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </slot>
    <slot name="footer" class="text-body-secondary">
        2 days ago
    </slot>
</x-bs::card>
--}}

@props([
    'header' => null,
    'body' => null,
    'footer' => null,
    'imgTop' => null,
    'imgBottom' => null,
])

@php
    $attributes = $attributes->class([
        'card',
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }}>
    @if (isset($imgTop) && !$imgTop->isEmpty())
        {{ $imgTop }}
    @endif
    @if (isset($header) && !$header->isEmpty())
        <div {{ $header->attributes->merge(['class' => 'card-header']) }}>
            {{ $header }}
        </div>
    @endif
    <div {{ $body->attributes->merge(['class' => 'card-body']) }}>
        {{ $body ?? $slot }}
    </div>
    @if (isset($footer) && !$footer->isEmpty())
        <div {{ $footer->attributes->merge(['class' => 'card-footer']) }}>
            {{ $footer }}
        </div>
    @endif
    @if (isset($imgBottom) && !$imgBottom->isEmpty())
        {{ $imgBottom }}
    @endif
</div>
