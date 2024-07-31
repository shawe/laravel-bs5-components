{{--
Use:

<x-bs::nav-item>

</x-bs::nav-item>
--}}

@php
    $attributes = $attributes->merge([
        'class' => 'nav-item',
        'role' => 'presentation',
    ]);
@endphp

<li {{ $attributes }} >
    {!! $label ?? $slot !!}
</li>
