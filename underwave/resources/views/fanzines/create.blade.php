<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-black text-4xl text-uw-text uppercase tracking-tighter bg-uw-card px-4 py-2 border-4 border-uw-border shadow-brutal inline-block">
            {{ __('Nuevo Fanzine') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-uw-bg min-h-screen relative" style="background-image: radial-gradient(var(--color-border) 1px, transparent 1px); background-size: 20px 20px;">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-uw-card border-4 border-uw-border text-uw-text shadow-brutal p-8">
                
                <div class="mb-8 border-b-4 border-uw-border pb-4">
                    <h3 class="font-mono font-black text-2xl uppercase">> REGISTRO_Kiosko.exe</h3>
                    <p class="font-mono text-uw-text/70 mt-2">Sube tu volumen. El formato es estricto.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-500 text-white font-mono font-bold border-4 border-uw-border p-4 shadow-brutal-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('fanzines.store') }}" enctype="multipart/form-data" class="space-y-6 font-mono font-bold">
                    @csrf

                    <!-- Título -->
                    <div>
                        <label for="title" class="block text-xl mb-2 uppercase">Título del Fanzine</label>
                        <input id="title" class="block w-full bg-uw-bg text-uw-text border-4 border-uw-border px-4 py-3 focus:ring-0 focus:outline-none focus:bg-uw-accent transition-colors" type="text" name="title" value="{{ old('title') }}" required autofocus />
                    </div>

                    <!-- Portada -->
                    <div class="p-4 border-4 border-dashed border-uw-border bg-uw-bg/50">
                        <label for="cover" class="block text-xl mb-2 uppercase">Portada (JPG/PNG, Max 2MB)</label>
                        <input id="cover" class="block w-full text-uw-text file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-4 file:border-uw-border file:text-sm file:font-black file:font-mono file:bg-uw-accent file:text-black hover:file:bg-black hover:file:text-uw-accent file:transition-colors" type="file" name="cover" accept=".jpg,.jpeg,.png" required />
                    </div>

                    <!-- Archivo PDF -->
                    <div class="p-4 border-4 border-dashed border-uw-border bg-uw-bg/50">
                        <label for="file" class="block text-xl mb-2 uppercase">Archivo Fanzine (PDF, Max 10MB)</label>
                        <input id="file" class="block w-full text-uw-text file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-4 file:border-uw-border file:text-sm file:font-black file:font-mono file:bg-uw-accent file:text-black hover:file:bg-black hover:file:text-uw-accent file:transition-colors" type="file" name="file" accept=".pdf" required />
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full font-mono font-black text-2xl bg-uw-border text-uw-bg border-4 border-uw-border py-4 shadow-[8px_8px_0px_0px_var(--color-accent)] hover:bg-uw-accent hover:text-uw-border hover:translate-x-2 hover:translate-y-2 hover:shadow-none transition-all">
                            [ SUBIR AL KIOSKO ]
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="mt-8 text-center">
                <a href="{{ route('fanzines.index') }}" class="font-mono font-bold text-lg text-uw-text bg-uw-card border-4 border-uw-border px-6 py-2 shadow-brutal-sm hover:bg-uw-border hover:text-uw-bg transition-colors inline-block">
                    <- CANCELAR
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
