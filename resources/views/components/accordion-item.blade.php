{{--
Use:

<x-bs::accordion-item id="accordionExample" target="collapseOne" :header="Accordion Item #1" active>
    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
</x-bs::accordion-item>
--}}

@props([
    'header' => null,
    'body' => null,
    'active' => 'false',
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel ?? 'accordion_item_id_' . random_int(10, 20));
    $id = str_replace(['[', ']', '.'], '_', $id);
    $target = $attributes->get('target', $model ?? $wireModel);

    $attributes = $attributes->class([
        'accordion-item',
    ])->merge([
        'id' => $id,
        'name' => $key,
    ]);
@endphp

<div {{ $attributes }}>
    <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $target}}"
                aria-expanded="{{ $active }}" aria-controls="{{ $target }}">
            {{ $header ?? 'No header set' }}
        </button>
    </h2>
    <div id="{{ $target }}" class="accordion-collapse collapse @if($active == 'true') show @endif"
         data-bs-parent="#{{ $id }}">
        <div class="accordion-body">
            {!! $body ?? $slot !!}
        </div>
    </div>
</div>
