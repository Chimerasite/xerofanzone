@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block py-1 uppercase text-teal-500 hover:text-stone-50 focus:outline-none focus:text-stone-50 transition duration-150 ease-in-out'
            : 'block py-1 uppercase text-teal-500 hover:text-stone-50 focus:outline-none focus:text-stone-50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
