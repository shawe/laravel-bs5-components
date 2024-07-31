{{--
Use:

<x-bs::tab-content>

</x-bs::tab-content>
--}}

@php
    $attributes = $attributes->class([
        'tab-content',
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }}>
    {!! $slot !!}
</div>
