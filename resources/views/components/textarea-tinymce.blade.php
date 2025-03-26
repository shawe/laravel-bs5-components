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
    'defer' => false,
    'value' => null,
])

@php
    if ($debounce) $bind = '.live.debounce.' . (ctype_digit($debounce) ? $debounce : 250) . 'ms';
    else if ($lazy) $bind = '.blur';
    else if ($live) $bind = '.live';
    else if ($defer) $bind = '.defer';
    else $bind = '';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel ?? 'textarea_tinymce_id_' . random_int(10, 20));
    $id = str_replace(['[', ']', '.'], '_', $id);
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
        'height' => $rows * 85, // Calculated to be used in textarea_wysihtml5.blade.php
        'wire:model' . $bind => $model ? $prefix . $model : null,
    ]);

    $cleanPrefix = rtrim($prefix, '.');

    try {
        $value = $value ?? ($model && is_array($this->{$cleanPrefix}) ? $this->{$cleanPrefix}[$model] : null);
    } catch (\Throwable $th) {
        $value = null;
    }
@endphp

<div>
    <x-bs::label :for="$id" :label="$label"/>

    <div wire:ignore>
        <x-bs::help :label="$help"/>

        <textarea @if(isset($this) && $this->hasModel($key)) wire:model="{{ $key }}" @endif {{ $attributes }}
        >{!! $value ?? $slot !!}</textarea>

        <x-bs::error :key="$key"/>
        <div id="{{ $id }}-error" class="text-danger mt-1"></div>
    </div>
</div>
