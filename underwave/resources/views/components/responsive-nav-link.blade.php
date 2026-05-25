@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-black text-left text-base font-mono font-bold uppercase text-black bg-[#D4FF00] transition-none'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-mono font-bold uppercase text-black hover:bg-black hover:text-[#D4FF00] transition-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
