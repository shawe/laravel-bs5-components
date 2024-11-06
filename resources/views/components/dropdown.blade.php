{{--
Use:

<x-bs::dropdown :label="__('Filter')" color="danger" >
    <x-bs::dropdown-item :label="__('By Name')" click="$set('filter', 'name')" />
    <x-bs::dropdown-item :label="__('By Age')" click="$set('filter', 'age')" />
</x-bs::dropdown>
--}}

@props([
    'icon' => null,
    'label' => null,
    'items' => null,
    'color' => 'primary',
    'size' => null,
])

@php
    $attributes = $attributes->class([
        'btn btn-' . $color,
        'btn-' . $size => $size,
        'dropdown-toggle',
        'border-0 p-0' => $color == 'link',
    ])->merge([
        'type' => 'button',
        'data-bs-toggle' => 'dropdown',
    ]);
@endphp

<div class="dropdown d-inline-block">
    <button {{ $attributes }}>
        <x-bs::fa-icon :name="$icon"/>

        {{ $label }}
    </button>

    <div class="dropdown-menu">
        {!! $items ?? $slot !!}
    </div>
</div>
