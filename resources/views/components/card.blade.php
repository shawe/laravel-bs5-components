{{--
Use:

<x-bs::card>
    <slot name="header">
        <h5 class="card-header">Featured</h5>
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
])

@php
    $attributes = $attributes->class([
        'card',
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }}>
    @if ($header)
        <div {{ $header->merge(['card-header']) }}>
            {{ $header }}
        </div>
    @endif
    <div {{ $header->merge(['card-body']) }}>
        {{ $body ?? $slot }}
    </div>
    @if ($footer)
        <div {{ $header->merge(['card-footer']) }}>
            {{ $footer }}
        </div>
    @endif
</div>
