{{--
Use:

@php
    $countries = ['Australia', 'Canada', 'USA']
@endphp
<x-bs::select :label="__('Your Country')" :placeholder="__('Select Country')" :options="$countries" :prepend="__('I live in')" :append="_('right now.')" :help="__('Please select your country.')" model="your_country" />

TODO: Need to be updated with multiple support from: resources/views/components/form/select.blade.php
--}}

@props([
    'label' => null,
    'placeholder' => null,
    'options' => [],
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
    'selectedItem' => null,
])

@php
    if ($debounce) $bind = '.live.debounce.' . (ctype_digit($debounce) ? $debounce : 250) . 'ms';
    else if ($lazy) $bind = '.blur';
    else if ($live) $bind = '.live';
    else if ($defer) $bind = '.defer';
    else $bind = '';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel ?? 'select_id_' . random_int(10, 20));
    $id = str_replace(['[', ']', '.'], '_', $id);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;
    $options = Arr::isAssoc($options) ? $options : array_combine($options, $options);

    $attributes = $attributes->class([
        'form-select',
        'form-select-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
        'bs5-component',
    ])->merge([
        'id' => $id,
        'name' => $key,
        'wire:model' . $bind => $model ? $prefix . $model : null,
    ]);
@endphp

<div>
    <x-bs::label :for="$id" :label="$label" />

    <div class="input-group">
        <x-bs::input-addon :icon="$icon" :label="$prepend" />

        {{-- IF NEEDED livewire support: MyBusiness/resources/views/components/form/select.blade.php --}}
        <select {{ $attributes }}>
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @if ($optionValue === $selectedItem) selected @endif>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>

        <x-bs::input-addon :label="$append" class="rounded-end" />

        <x-bs::error :key="$key" />
    </div>

    <x-bs::help :label="$help" />
</div>
