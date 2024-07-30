{{--
Use:

<x-bs::icon name="cog" />
--}}

@props([
    'name' => null,
    'style' => config('laravel-bs5-components.font_awesome_style'),
    'size' => null,
    'color' => null,
    'spin' => false,
    'pulse' => false,
])

@php
    $attributes = $attributes->class([
        'fa' . Str::limit($style, 1, null) . ' fa-fw fa-' . $name,
        'fa-' . $size => $size,
        'text-' . $color => $color,
        'fa-spin' => $spin,
        'fa-pulse' => $pulse,
    ])->merge([
        //
    ]);
@endphp

@if($name)
    <i {{ $attributes }}></i>
@endif
