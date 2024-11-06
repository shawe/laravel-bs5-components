{{--
Use:

<x-bs::ti-icon name="cog" />
--}}

@props([
    'name' => null,
    'color' => null,
])

@php
    $attributes = $attributes->class([
        'ti ti-' . $name,
        'text-' . $color => $color,
    ])->merge([
        //
    ]);
@endphp

@if($name)
    <i {{ $attributes }}></i>
@endif
