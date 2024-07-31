{{--
Use:

<x-bs::nav>

</x-bs::nav>
--}}

@props([
    'type' => 'nav',
])

@php
    $attributes = $attributes->merge([
        'class' => 'nav',
    ]);
@endphp

<{{ $type }} {{ $attributes }}>
{!! $items ?? $slot !!}
</{{ $type }}>
