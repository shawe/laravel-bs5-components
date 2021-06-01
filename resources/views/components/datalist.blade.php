@props([
    'label' => null,
    'size' => null,
    'prependIcon' => null,
    'prependLabel' => null,
    'appendIcon' => null,
    'appendLabel' => null,
    'options' => [],
    'errorKey' => $attributes->get('name', Str::replaceFirst('model.', '', $attributes->whereStartsWith('wire:model')->first())),
    'help' => null,
])

@php
    $attributes = $attributes->class([
        'form-control',
        'form-control-' . $size => $size,
        'rounded-end' => !$appendIcon && !$appendLabel,
        'is-invalid' => $errors->has($errorKey),
    ])->merge([
        'id' => $id = $attributes->get('id', $errorKey),
        'list' => $list = $attributes->get('list', $errorKey . '.options'),
    ]);
@endphp

<div class="mb-3">
    <x-bs::label :for="$id" :label="$label"/>

    <div class="input-group">
        <x-bs::input-addon :icon="$prependIcon" :label="$prependLabel"/>

        <input {{ $attributes }}>

        <datalist id="{{ $list }}">
            @foreach($options as $option)
                <option value="{{ $option }}">
            @endforeach
        </datalist>

        <x-bs::input-addon :icon="$appendIcon" :label="$appendLabel" class="rounded-end"/>

        <x-bs::error :key="$errorKey"/>
    </div>

    <x-bs::help :message="$help"/>
</div>
