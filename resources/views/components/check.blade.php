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
    'debounce' => false,
    'lazy' => false,
    'live' => false,
    'defer' => false,
    'checked' => false,
    'value' => 'true',
])

@php
    if ($debounce) $bind = '.live.debounce.' . (ctype_digit($debounce) ? $debounce : 250) . 'ms';
    else if ($lazy) $bind = '.blur';
    else if ($live) $bind = '.live';
    else if ($defer) $bind = '.defer';
    else $bind = '';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel ?? 'check_id_' . random_int(10, 20));
    $id = str_replace(['[', ']', '.'], '_', $id);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;

    $attributes = $attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($key),
    ])->merge([
        'type' => 'checkbox',
        'id' => $id,
        'name' => $key,
        'wire:model' . $bind => $model ? $prefix . $model : null,
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
