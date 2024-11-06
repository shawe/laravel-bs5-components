{{--
Use:

<x-bs::toast :title="Bootstrap"
             :subtitle="11 mins ago"
             :body="Hello, world! This is a toast message."
             :icon="circle" />
--}}

@props([
    'title' => null,
    'subtitle' => null,
    'body' => null,
    'icon' => null,
])

@php
    $attributes = $attributes->class([
        'toast',
    ])->merge([
        'role' => 'alert',
        'aria-live' => 'assertive',
        'aria-atomic' => 'true',
    ]);
@endphp

<div {{ $attributes }}>
    <div class="toast-header">
        <x-bs::fa-icon :name="$icon"/>
        <strong class="me-auto">{{ $title }}</strong>
        @if ($subtitle)
            <small>{{ $subtitle }}</small>
        @endif
        <x-bs::close dismiss="toast"/>
    </div>
    <div class="toast-body">
        {!! $body !!}
    </div>
</div>
