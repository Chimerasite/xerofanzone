@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-base mb-2']) }}>
    {{ $value ?? $slot }}
</label>
