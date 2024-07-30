{{--
Use:

<x-bs::breadcrumb>
    <x-bs::breadcrumb-item>
        <x-bs::link :label="__('Home')" route="home" />
    </x-bs::breadcrumb>
    <x-bs::breadcrumb-item>
        <x-bs::link :label="__('Library')" route="library" />
    </x-bs::breadcrumb>
    <x-bs::breadcrumb-item>
        <x-bs::link :label="__('Data')" active />
    </x-bs::breadcrumb>
</x-bs::breadcrumb>
--}}

@php
    $attributes = $attributes->class([
        'breadcrumb',
    ])->merge([
        //
    ]);
@endphp

<nav aria-label="breadcrumb">
    <ol {{ $attributes }}>
        {{ $slot }}
    </ol>
</nav>
