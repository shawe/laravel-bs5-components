{{--
Use:

<x-bs::radio :label="__('Gender')" :options="['Male', 'Female']" :help="__('Please select your gender.')" switch model="gender" />
--}}

@props([
    'label' => null,
    'options' => [],
    'help' => null,
    'switch' => false,
    'model' => null,
    'debounce' => false,
    'lazy' => false,
    'live' => false,
    'defer' => false,
])

@php
    if ($debounce) $bind = '.live.debounce.' . (ctype_digit($debounce) ? $debounce : 250) . 'ms';
    else if ($lazy) $bind = '.blur';
    else if ($live) $bind = '.live';
    else if ($defer) $bind = '.defer';
    else $bind = '';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;
    $options = Arr::isAssoc($options) ? $options : array_combine($options, $options);

    $attributes = $attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($key),
    ])->merge([
        'type' => 'radio',
        'name' => $key,
        'wire:model' . $bind => $model ? $prefix . $model : null,
    ]);
@endphp

<div>
    <x-bs::label :label="$label"/>

    @foreach($options as $optionValue => $optionLabel)
        <div class="form-check {{ $switch ? 'form-switch' : '' }}">
            @php($optionId = $id . '_' . $loop->index)
            <input {{ $attributes->merge(['id' => $optionId, 'value' => $optionValue]) }}>

            <x-bs::check-label :for="$optionId" :label="$optionLabel"/>

            @if($loop->last)
                <x-bs::error :key="$key"/>

                <x-bs::help :label="$help"/>
            @endif
        </div>
    @endforeach
</div>
