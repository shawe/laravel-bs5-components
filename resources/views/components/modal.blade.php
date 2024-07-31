{{--
Use:

<x-bs::modal class="modal-dialog-centered">
    <x-slot name="title">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </slot>
    <x-slot name="body">
        <p>Modal body text goes here.</p>
    </slot>
    <x-slot name="footer" class="text-body-secondary">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </slot>
</x-bs::modal>
--}}

@props([
    'title' => null,
    'body' => null,
    'footer' => null,
    'class' => null,
    'static' => false,
])

@php
    $attributes = $attributes->class([
        'modal',
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }} tabindex="-1" aria-hidden="true" @if ($static)  data-bs-backdrop="static"
     data-bs-keyboard="false" @endif >
    <div class="modal-dialog {{ $class }}">
        <div class="modal-content">
            <div class="modal-header">
                @if (isset($title) && !$title->isEmpty())
                    <div {{ $title->attributes->merge(['class' => 'modal-title']) }}>
                        {!! $title !!}
                    </div>
                @endif
                <x-bs::close/>
            </div>
            @if (isset($body) && !$body->isEmpty())
                <div {{ $body->attributes->merge(['class' => 'modal-body']) }}>
                    {!! $body !!}
                </div>
            @endif
            @if (isset($footer) && !$footer->isEmpty())
                <div {{ $footer->attributes->merge(['class' => 'modal-footer']) }}>
                    {!! $footer !!}
                </div>
            @endif
        </div>
    </div>
</div>
