@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-stone-950 border-stone-400 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm']) !!}>
