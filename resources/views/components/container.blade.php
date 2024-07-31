{{--
Use:

<x-bs::container>
    <h1>Container</h1>
    <p>This is a container.</p>
</x-bs::container>
--}}


@props([
    'type' => 'container',
])

@php
    $attributes = $attributes->class([
        $type,
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }}>
    {!! $content ?? $slot !!}
</div>
