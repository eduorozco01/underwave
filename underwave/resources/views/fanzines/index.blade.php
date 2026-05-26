<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-serif font-black text-4xl text-uw-text uppercase tracking-tighter bg-uw-card px-4 py-2 border-4 border-uw-border shadow-brutal inline-block">
                {{ __('Tablón de Fanzines') }}
            </h2>
            <a href="{{ route('fanzines.create') }}" class="font-mono font-bold text-xl bg-uw-accent text-black border-4 border-uw-border px-6 py-3 shadow-brutal hover:bg-black hover:text-uw-accent hover:translate-x-1 hover:translate-y-1 hover:shadow-brutal-sm transition-all">
                + PUBLICAR FANZINE
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-uw-bg min-h-screen relative" style="background-image: radial-gradient(var(--color-border) 1px, transparent 1px); background-size: 20px 20px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-8 font-mono font-bold text-lg bg-uw-accent text-black border-4 border-uw-border px-6 py-4 shadow-brutal">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse ($fanzines as $fanzine)
                    <div class="bg-uw-card border-4 border-uw-border text-uw-text flex flex-col shadow-brutal hover:-translate-y-2 transition-transform duration-200">
                        <!-- Portada (Mitad Superior) -->
                        <div class="h-64 md:h-80 w-full border-b-4 border-uw-border bg-uw-bg overflow-hidden">
                            <img src="{{ Storage::url($fanzine->cover_path) }}" alt="{{ $fanzine->title }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-300">
                        </div>
                        
                        <!-- Detalles (Mitad Inferior) -->
                        <div class="p-6 flex flex-col flex-grow justify-between">
                            <div>
                                <h3 class="font-mono font-black text-2xl uppercase mb-2 line-clamp-2 leading-tight">{{ $fanzine->title }}</h3>
                                <p class="font-mono font-bold text-lg text-uw-text bg-uw-bg border-2 border-uw-border inline-block px-2 py-1 mb-6">
                                    POR: {{ $fanzine->user->name }}
                                </p>
                            </div>
                            
                            <a href="{{ Storage::url($fanzine->file_path) }}" target="_blank" rel="noopener noreferrer" class="block w-full text-center font-mono font-black text-xl bg-uw-accent text-black border-4 border-uw-border py-4 shadow-brutal-sm hover:bg-black hover:text-uw-accent hover:translate-x-1 hover:translate-y-1 hover:shadow-none active:scale-95 transition-all">
                                >> LEER VOLUMEN
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center border-4 border-uw-border bg-uw-card text-uw-text shadow-brutal">
                        <p class="font-mono font-black text-3xl uppercase">Aún no hay fanzines en el kiosko.</p>
                        <p class="font-mono font-bold text-xl mt-4">Sé el primero en publicar el tuyo.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
