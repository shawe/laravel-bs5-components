{{--
Use:

<x-bs::button-group>
    <x-bs::button :label="__('Login')" color="primary" size="lg" route="login" />
    <x-bs::button :label="__('Login')" color="primary" size="lg" route="login" />
</x-bs::button-group>
--}}

@php
    $attributes = $attributes->class([
        'btn-group',
    ])->merge([
        'role' => 'group',
    ]);
@endphp

<div {{ $attributes }}>
    {!! $items ?? $slot !!}
</div>
