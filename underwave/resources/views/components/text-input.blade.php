@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full bg-uw-bg text-uw-text border-4 border-uw-border px-4 py-2 focus:ring-0 focus:outline-none focus:bg-uw-accent focus:text-black transition-colors font-mono font-bold']) !!}>
