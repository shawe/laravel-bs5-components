{{--
Use:

<x-bs::error :key="$key" />
--}}

@props([
    'key' => null,
])

@php
    $attributes = $attributes->class([
        'invalid-feedback',
    ])->merge([
        //
    ]);
@endphp

@error($key)
    <div {{ $attributes }}>
        {{ $message }}
    </div>
@enderror
