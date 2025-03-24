{{--
Use:

<x-bs::textarea-ace :label="__('Biography')" rows="5" mode="ace/mode/html" model="biography" />
--}}

@props([
    'label' => null,
    'height' => '300px',
    'minHeight' => '300px',
    'help' => null,
    'model' => null,
    'debounce' => false,
    'lazy' => false,
    'live' => false,
    'value' => null,
    'mode' => 'ace/mode/html',
])

@php
    if ($debounce) $bind = '.live.debounce.' . (ctype_digit($debounce) ? $debounce : 250) . 'ms';
    else if ($lazy) $bind = '.blur';
    else if ($live) $bind = '.live';
    else $bind = '';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel ?? 'textarea_ace_id_' . random_int(10, 20));
    $id = str_replace(['[', ']', '.'], '_', $id);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;

    $attributes = $attributes->class([
        'form-control',
        'wysihtml5-ace-editor',
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'id' => $id,
        'name' => $key,
        'wire:model' . $bind => $model ? $prefix . $model : null,
        'data-mode' => $mode ?? 'ace/mode/html',
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
        <div @if(isset($this) && $this->hasModel($key)) wire:model="{{ $key }}" @endif {{ $attributes }}
        >{!! $value ?? $slot !!}</div>
    </div>

    <x-bs::error :key="$key"/>

    <x-bs::help :label="$help"/>
</div>

@push('css')
    <style>
        .wysihtml5-ace-editor {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            width: 100%;
            height: {{ $height }};
            min-height: {{ $minHeight ?? '300px' }};
            resize: vertical;
            overflow: hidden;
        }
    </style>
@endpush
