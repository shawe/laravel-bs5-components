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
    'lazy' => false,
    'selectedItem' => null,
])

@php
    if ($lazy) $bind = 'lazy';
    else $bind = 'defer';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;
    $options = Arr::isAssoc($options) ? $options : array_combine($options, $options);

    $attributes = $attributes->class([
        'form-select',
        'form-select-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'id' => $id,
        'wire:model.' . $bind => $model ? $prefix . $model : null,
    ]);
@endphp

<div>
    <x-bs::label :for="$id" :label="$label"/>

    <div class="input-group">
        <x-bs::input-addon :icon="$icon" :label="$prepend"/>

        <select {{ $attributes }}>
            <option value="">{{ $placeholder }}</option>

            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @if ($optionValue == $selectedItem) selected @endif>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>

        <x-bs::input-addon :label="$append" class="rounded-end"/>

        <x-bs::error :key="$key"/>
    </div>

    <x-bs::help :label="$help"/>
</div>

@once
    @push('css')
        <link rel="stylesheet" href="{{ asset('build/extensions/select2/css/select2.min.css') }}">
        <link rel="stylesheet"
              href="{{ asset('build/extensions/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css') }}">
    @endpush

    @push('js')
        <script src="{{ asset('build/extensions/select2/js/select2.min.js') }}"></script>
        @if (file_exists(public_path('build/extensions/select2/js/i18n/' . app()->getLocale() . '.js')))
            <script src="{{ asset('build/extensions/select2/js/i18n/' . app()->getLocale() . '.js') }}"></script>
        @endif
    @endpush
@endonce

@if (isset($attributes['class']) && Illuminate\Support\Str::contains($attributes['class'], 'select2'))
    @push('js')
        <script>
            $(document).ready(function () {
                $('#{{ $id }}').select2({
                    theme: 'bootstrap-5',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    closeOnSelect: false,
                    placeholder: {
                        id: '-1', // the value of the option
                        text: '{{ __('Select one item') }}'
                    }
                });
            });
        </script>
    @endpush
@endif
