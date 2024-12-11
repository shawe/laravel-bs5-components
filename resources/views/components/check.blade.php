{{--
Use:

<x-bs::check :label="__('Agree')" :checkLabel="__('I agree to the TOS')" :help="__('Please accept the TOS.')" switch model="agree" />
--}}

@props([
    'label' => null,
    'checkLabel' => null,
    'help' => null,
    'switch' => false,
    'model' => null,
    'lazy' => false,
    'checked' => false,
    'value' => 'true',
])

@php
    if ($lazy) $bind = 'lazy';
    else $bind = 'defer';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;

    $attributes = $attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($key),
    ])->merge([
        'type' => 'checkbox',
        'id' => $id,
        'name' => $key,
        'wire:model.' . $bind => $model ? $prefix . $model : null,
        'checked' => (bool) $checked,
        'value' => $value,
    ]);
@endphp

<div>
    <x-bs::label :label="$label"/>

    <div class="form-check {{ $switch ? 'form-switch' : '' }}">
        <input {{ $attributes }}>

        <x-bs::check-label :for="$id" :label="$checkLabel"/>

        <x-bs::error :key="$key"/>

        <x-bs::help :label="$help"/>
    </div>
</div>
