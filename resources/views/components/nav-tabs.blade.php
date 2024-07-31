{{--
Use:

<x-bs::nav-tabs>

</x-bs::nav-tabs>
--}}

@php
    $attributes = $attributes->merge([
        'class' => 'nav-tabs',
        'role' => 'tablist',
    ]);
@endphp

<x-bs::nav type="ul" {{ $attributes }}>
    {!! $items ?? $slot !!}
</x-bs::nav>
