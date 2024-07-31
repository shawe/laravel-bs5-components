{{--
Use:

<x-bs::collapse-div id="myDiv">
    <p>Some content</p>
</x-bs::collapse-div>
--}}

@php
    $attributes = $attributes->class([
        'collapse',
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }}>
    {!! $content ?? $slot !!}
</div>
