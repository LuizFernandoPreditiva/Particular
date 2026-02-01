@props(['active'])

@php
$classes = ($active ?? false) ? 'link' : 'link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
