{{--
Use:

<x-bs::input :label="__('Email Address')" type="email" :help="__('Please enter your email.')" id="email_address" name="email_address" />

<x-bs::input :label="__('Email Address')" type="email" :help="__('Please enter your email.')" model="email_address" >
    <x-slot name="prepend">
        <i class="fa fa-envelope"></i>
    </x-slot>
</x-bs::input>
--}}

@props([
    'label' => null,
    'type' => 'text',
    'icon' => null,
    'prepend' => null,
    'append' => null,
    'size' => null,
    'help' => null,
    'model' => null,
    'debounce' => false,
    'lazy' => false,
    'disabled' => false,
    'readonly' => false,
])

@php
    if ($type == 'number') $inputmode = 'decimal';
    else if (in_array($type, ['tel', 'search', 'email', 'url'])) $inputmode = $type;
    else $inputmode = 'text';

    if ($debounce) $bind = 'debounce.' . (ctype_digit($debounce) ? $debounce : 150) . 'ms';
    else if ($lazy) $bind = 'lazy';
    else $bind = 'defer';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;

    $attributes = $attributes->class([
        'form-control',
        'form-control-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'type' => $type,
        'inputmode' => $inputmode,
        'id' => $id,
        'name' => $key,
        'wire:model.' . $bind => $model ? $prefix . $model : null,
        'autocomplete' => 'off',
        'readonly' => (bool) $readonly,
        'disabled' => (bool) $disabled,
    ]);
@endphp

<div>
    <x-bs::label :for="$id" :label="$label"/>

    <div class="input-group">
        <x-bs::input-addon :icon="$icon" :label="$prepend"/>

        <input {{ $attributes }}>

        <x-bs::input-addon :label="$append" class="rounded-end"/>

        <x-bs::error :key="$key"/>
    </div>

    <x-bs::help :label="$help"/>
</div>
