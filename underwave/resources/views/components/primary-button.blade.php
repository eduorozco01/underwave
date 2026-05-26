<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center font-mono font-black text-lg bg-uw-accent text-black border-4 border-uw-border py-2 px-6 shadow-brutal-sm hover:bg-black hover:text-uw-accent hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all uppercase']) }}>
    {{ $slot }}
</button>
