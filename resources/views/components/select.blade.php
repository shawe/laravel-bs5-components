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
    'live' => false,
    'selectedItem' => null,
])

@php
    if ($lazy) $bind = '.blur';
    else if ($live) $bind = '.live';
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
    ])->merge([
        'id' => $id,
        'name' => $key,
        'wire:model' . $bind => $model ? $prefix . $model : null,
    ]);
@endphp

<div>
    <x-bs::label :for="$id" :label="$label"/>

    <div class="input-group">
        <x-bs::input-addon :icon="$icon" :label="$prepend"/>

        {{-- IF NEEDED livewire support: MyBusiness/resources/views/components/form/select.blade.php --}}
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

@if (isset($attributes['class']) && Illuminate\Support\Str::contains($attributes['class'], 'select2'))
    @push('js')
        <script>
          document.addEventListener('DOMContentLoaded', function() {
                $('#{{ $id }}').select2({
                    theme: 'bootstrap-5',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    closeOnSelect: true,
                    placeholder: {
                        id: '-1', // the value of the option
                        text: '{{ __('Select one item') }}'
                    }
                });
            });
        </script>
    @endpush
@endif
