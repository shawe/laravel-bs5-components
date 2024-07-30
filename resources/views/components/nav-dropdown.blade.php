{{--
Use:

<x-bs::nav-dropdown :label="Auth::user()->name">
    <x-bs::dropdown-item :label="__('Update Profile')" click="$emit('showModal', 'profile.update')" />
    <x-bs::dropdown-item :label="__('Logout')" click="logout" />
</x-bs::nav-dropdown>
--}}

@props([
    'icon' => null,
    'label' => null,
    'items' => null,
])

@php
    $attributes = $attributes->class([
        'nav-link',
        'dropdown-toggle',
    ])->merge([
        'href' => '#',
        'data-bs-toggle' => 'dropdown',
    ]);
@endphp

<div class="nav-item dropdown">
    <a {{ $attributes }}>
        <x-bs::icon :name="$icon"/>

        {{ $label }}
    </a>

    <div class="dropdown-menu">
        {{ $items ?? $slot }}
    </div>
</div>
