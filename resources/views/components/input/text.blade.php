@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-400 focus:border-midnight-500 focus:ring-midnight-500 rounded-md shadow-sm']) !!}>
