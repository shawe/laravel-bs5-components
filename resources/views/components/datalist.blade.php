{{--
Use:

@php
    $options = ['Toronto', 'Montreal', 'Las Vegas'];
@endphp
<x-bs::datalist :label="__('City Name')" :options="$options" :prepend="__('I live in')" :append="_('right now.')" :help="__('Please enter your city.')" model="city_name" />
--}}

@props([
    'label' => null,
    'options' => [],
    'icon' => null,
    'prepend' => null,
    'append' => null,
    'size' => null,
    'help' => null,
    'model' => null,
    'debounce' => null,
    'lazy' => false,
    'live' => false,
])

@php
    if ($debounce) $bind = '.live.debounce.' . (ctype_digit($debounce) ? $debounce : 250) . 'ms';
    else if ($lazy) $bind = '.blur';
    else if ($live) $bind = '.live';
    else $bind = '';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;
    $list = $attributes->get('list', $key . '_list');

    $attributes = $attributes->class([
        'form-control',
        'form-control-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'list' => $list,
        'id' => $id,
        'name' => $key,
        'wire:model' . $bind => $model ? $prefix . $model : null,
    ]);
@endphp

<div>
    <x-bs::label :for="$id" :label="$label"/>

    <div class="input-group">
        <x-bs::input-addon :icon="$icon" :label="$prepend"/>

        <input {{ $attributes }}>

        <datalist id="{{ $list }}">
            @foreach($options as $option)
                <option value="{{ $option }}">
            @endforeach
        </datalist>

        <x-bs::input-addon :label="$append" class="rounded-end"/>

        <x-bs::error :key="$key"/>
    </div>

    <x-bs::help :label="$help"/>
</div>
