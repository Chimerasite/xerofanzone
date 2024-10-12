@props(['disabled' => false])

<input type="checkbox" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-stone-50 border-stone-400 checked:bg-teal-500 focus:border-teal-500 focus:ring-teal-500 focus:bg-teal-500 rounded-md shadow-sm']) !!}>
