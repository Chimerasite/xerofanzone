@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-stone-950 h-32 border-stone-400 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm']) !!}></textarea>
