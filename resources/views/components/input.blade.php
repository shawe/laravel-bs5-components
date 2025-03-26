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
    'live' => false,
    'defer' => false,
    'disabled' => false,
    'readonly' => false,
    'attrs' => [],
])

@php
    $inputmode = 'text';
    if ($type === 'number') {
        $inputmode = 'decimal';
    } elseif (in_array($type, ['date', 'datetime-local', 'email', 'hidden', 'month', 'password', 'range', 'reset', 'search', 'submit', 'tel', 'time', 'url', 'week'])) {
        $inputmode = $type;
    }

    if ($debounce) $bind = '.live.debounce.' . (ctype_digit($debounce) ? $debounce : 250) . 'ms';
    else if ($lazy) $bind = '.blur';
    else if ($live) $bind = '.live';
    else if ($defer) $bind = '.defer';
    else $bind = '';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel ?? 'input_id_' . random_int(10, 20));
    $id = str_replace(['[', ']', '.'], '_', $id);
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
        'wire:model' . $bind => $model ? $prefix . $model : null,
        'autocomplete' => 'off',
        'readonly' => (bool) $readonly,
        'disabled' => (bool) $disabled,
    ])->merge($attrs ?? []);
@endphp

<div>
    <x-bs::label :for="$id" :label="$label"/>

    <div class="input-group">
        <x-bs::input-addon :icon="$icon" :label="$prepend"/>

        <input {{ $attributes }}>

        <x-bs::input-addon :label="$append" class="rounded-end"/>
    </div>

    <x-bs::error :key="$key"/>

    <x-bs::help :label="$help"/>
</div>
