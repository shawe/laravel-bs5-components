{{--
Use:

<x-bs::accordion-item id="accordionExample" target="collapseOne" :header="Accordion Item #1" active>
    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
</x-bs::accordion-item>
--}}

@props([
    'header' => null,
    'body' => null,
    'active' => false,
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $id = $attributes->get('id', $model ?? $wireModel);
    $target = $attributes->get('target', $model ?? $wireModel);

    $attributes = $attributes->class([
        'accordion-item',
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }}>
    <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $target}}" aria-active="{{ $active }}" aria-controls="{{ $target }}">
            {{ $header ?? __('N/A') }}
        </button>
    </h2>
    <div id="{{ $target }}" class="accordion-collapse collapse @if($active) show @endif"  data-bs-parent="#{{ $id }}">
        <div class="accordion-body">
            {{ $body ?? $slot }}
        </div>
    </div>
</div>