{{--
Use:

@php
    $images = [
        [
            'src' => 'https://via.placeholder.com/800x400?text=First+slide',
            'alt' => 'First slide',
            'caption' => 'First slide caption',
        ],
        [
            'src' => 'https://via.placeholder.com/800x400?text=Second+slide',
            'alt' => 'Second slide',
            'caption' => 'Second slide caption',
        ],
        [
            'src' => 'https://via.placeholder.com/800x400?text=Third+slide',
            'alt' => 'Third slide',
            'caption' => 'Third slide caption',
        ],
    ]);
@endphp
<x-bs::carousel id="XXX" :images="$images" />
--}}

@props([
    'id' => 'random_id_' . mt_rand(),
    'indicators' => true,
    'controls' => true,
    'images' => [],
])

@php
    $attributes = $attributes->class([
        'carousel',
    ])->merge([
        //
    ]);
@endphp

<div id="{{ $id }}" {{ $attributes }}>
    @if ($indicators)
        <div class="carousel-indicators">
            @foreach($images as $image)
                <button type="button" data-bs-target="#{{ $id }}" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="{{ $loop->iteration }}"></button>
            @endforeach
        </div>
    @endif
    <div class="carousel-inner">
        @foreach($images as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ $image['src'] }}" class="d-block w-100" alt="{{ $image['alt'] }}">
                @if ($image['caption'] ?? false)
                    <div class="carousel-caption d-none d-md-block">
                        {{ $image['caption'] }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @if ($controls)
        <button class="carousel-control-prev" type="button" data-bs-target="#{{ $id }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('Previous') }}</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#{{ $id }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('Next') }}</span>
        </button>
    @endif
</div>
