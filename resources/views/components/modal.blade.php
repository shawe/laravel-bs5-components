{{--
Use:

<x-bs::modal class="modal-dialog-centered">
    <slot name="title">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </slot>
    <slot name="body">
        <p>Modal body text goes here.</p>
    </slot>
    <slot name="footer" class="text-body-secondary">
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
])

@php
    $attributes = $attributes->class([
        'modal',
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }} tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $class }}">
        <div class="modal-content">
            @if (isset($title) && !$title->isEmpty())
                <div class="modal-header">
                    <div {{ $title->attributes->merge(['class' => 'modal-title']) }}>
                        {{ $title }}
                    </div>
                </div>
            @endif
            <div {{ isset($body) && $body->attributes->merge(['class' => 'modal-body']) }}>
                {{ $body ?? $slot }}
            </div>
            @if (isset($footer) && !$footer->isEmpty())
                <div {{ $footer->attributes->merge(['class' => 'modal-footer']) }}>
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
