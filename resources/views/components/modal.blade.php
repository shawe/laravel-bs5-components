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

<div {{ $attributes }} tabindex="-1">
    <div class="modal-dialog {{ $class }}">
        <div class="modal-content">
            @if ($title)
                <div {{ $title->merge(['modal-title']) }}>
                    {{ $title }}
                </div>
            @endif
            <div {{ $header->merge(['modal-body']) }}>
                {{ $body ?? $slot }}
            </div>
            @if ($footer)
                <div {{ $header->merge(['modal-footer']) }}>
                    {{ $footer }}
                </div>
            @endif
        </div>
</div>
