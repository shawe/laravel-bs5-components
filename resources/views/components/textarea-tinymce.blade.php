{{--
Use:

<x-bs::textarea-tinymce :label="__('Biography')" rows="5" :help="__('Please tell us about yourself.')" model="biography" />
--}}

@props([
    'label' => null,
    'icon' => null,
    'prepend' => null,
    'append' => null,
    'rows' => 3,
    'size' => null,
    'help' => null,
    'model' => null,
    'debounce' => false,
    'lazy' => false,
    'live' => false,
    'value' => null,
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

    $attributes = $attributes->class([
        'form-control',
        'wysihtml5-tinymce',
        'form-control-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'id' => $id,
        'name' => $key,
        'rows' => $rows,
        'wire:model' . $bind => $model ? $prefix . $model : null,
    ]);

    $cleanPrefix = rtrim($prefix, '.');
    $value = $value ?? ($model ? $this->{$cleanPrefix}[$model] : null);
@endphp

<div>
    <x-bs::label :for="$id" :label="$label"/>

    <div wire:ignore>
        <textarea @if(isset($this) && $this->hasModel($key)) wire:model="{{ $key }}" @endif {{ $attributes }}
        >{!! $value ?? $slot !!}</textarea>
    </div>

    <x-bs::error :key="$key"/>

    <x-bs::help :label="$help"/>
</div>
