@props([
    'tag' => 'a',
    'href' => '#',
    'type' => 'button',
    'text' => 'Button',
])
@php
    $class = 'rounded-md bg-primary-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600'
@endphp

@if ($tag === 'a')
    <a href="{{ $href }}" {{ $attributes->class([$class]) }}>
        {{ $slot }}
    </a>
@elseif ($tag === 'button')
    <button type="{{ $type }}" {{ $attributes->class([$class]) }}>
        {{ $slot }}
    </button>
@else
    <{{ $tag }} {{ $attributes->class([$class]) }}>
        {{ $slot }}
    </{{ $tag }}>
@endif
