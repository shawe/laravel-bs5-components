{{--
Use:

<x-bs::color :label="__('Favorite Color')" :prepend="__('I like')" :append="_('the most.')" :help="__('Please pick a color.')" model="favorite_color" />
--}}

@props([
    'label' => null,
    'icon' => null,
    'prepend' => null,
    'append' => null,
    'size' => null,
    'help' => null,
    'model' => null,
    'lazy' => false,
    'live' => false,
])

@php
    if ($lazy) $bind = 'blur';
    else if ($live) $bind = 'live';
    else $bind = '';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;

    $attributes = $attributes->class([
        'form-control form-control-color',
        'form-control-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'type' => 'color',
        'id' => $id,
        'name' => $key,
        'wire:model.' . $bind => $model ? $prefix . $model : null,
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
