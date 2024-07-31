{{--
Use:

<x-bs::tab-pane>

</x-bs::tab-pane>
--}}

@props([
    'selected' => false,
    'labelled' => false,
])

@php
    $attributes = $attributes->class([
        'tab-pane fade',
        'show' => (bool) $selected,
        'active' => (bool) $selected,
    ])->merge([
        'role' => 'tabpanel',
        'tabindex' => '0',
        'area-labelledby' => $labelled ? $labelled : false,
    ]);
@endphp

<div {{ $attributes }}>
    {!! $items ?? $slot !!}
</div>
