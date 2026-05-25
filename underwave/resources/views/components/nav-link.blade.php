@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 border-2 border-black bg-[#D4FF00] text-black text-xs font-mono font-bold uppercase transition-none shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]'
            : 'inline-flex items-center px-4 py-2 border-2 border-black bg-white hover:bg-black hover:text-[#D4FF00] text-black text-xs font-mono font-bold uppercase transition-none shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
