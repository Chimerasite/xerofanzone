@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-base text-black mb-2']) }}>
    {{ $value ?? $slot }}
</label>
