@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-lg mb-1 uppercase text-uw-text font-mono']) }}>
    {{ $value ?? $slot }}
</label>
