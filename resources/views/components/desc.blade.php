{{--
Use:

<x-bs::desc :term="__('ID')" :details="$user->id" />
--}}

@props([
    'term' => null,
    'details' => null,
    'date' => null,
])

@php
    $attributes = $attributes->class([
        'mb-0',
    ])->merge([
        //
    ]);
@endphp

<dl {{ $attributes }}>
    <dt>{{ $term }}</dt>

    <dd class="mb-0">
        @if($details || !$slot->isEmpty())
            {!! $details ?? $slot !!}
        @elseif($date)
            @displayDate($date)
        @else
            No detail set
        @endif
    </dd>
</dl>
