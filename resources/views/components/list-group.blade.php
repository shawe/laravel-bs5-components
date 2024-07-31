{{--
Use:

<x-bs::list-group>

</x-bs::list-group>
--}}

@props([
    'type' => 'div',
])

@php
    $attributes = $attributes->class([
        'list-group',
    ])->merge([
        //
    ]);
@endphp

<{{ $type }} {{ $attributes }}>
{!! $items ?? $slot !!}
</{{ $type }}>
