{{--
Use:

<x-bs::accordion id="accordionExample">
    <x-slot name="body">
        <x-bs::accordion-item id="accordionExample" target="collapseOne :header="Accordion Item #1"
            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </x-bs::accordion-item>
        <x-bs::accordion-item id="accordionExample" target="collapseTwo" :header="Accordion Item #2">
            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </x-bs::accordion-item>
        <x-bs::accordion-item id="accordionExample" target="collapseThree" :header="Accordion Item #3">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </x-bs::accordion-item>
    </x-slot>
</x-bs::accordion>
--}}

@props([
    'body' => null,
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);

    $attributes = $attributes->class([
        'accordion',
    ])->merge([
        'id' => $id,
        'name' => $key,
    ]);
@endphp

<div {{ $attributes }}>
    {!! $body ?? $slot !!}
</div>
