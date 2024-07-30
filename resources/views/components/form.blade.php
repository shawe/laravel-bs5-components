{{--
Use:

<x-bs::form submit="login">
    <x-bs::input :label="__('Email')" type="email" model="email" />
    <x-bs::input :label="__('Password')" type="password" model="password" />
    <x-bs::button :label="__('Login')" type="submit" />
</x-bs::form>
--}}

@props([
    'submit' => null,
])

@php
    $attributes = $attributes->class([
        //
    ])->merge([
        'wire:submit.prevent' => $submit
    ]);
@endphp

<form {{ $attributes }}>
    {{ $slot }}
</form>
