<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-4 border-black shadow-brutal p-6">
            <h2 class="font-serif text-4xl uppercase mb-4">UnderWave_System_Active</h2>

            <div class="flex gap-4">
                <span class="bg-under-neon px-2 py-1 border-2 border-black font-bold">
                    [ STATUS: ONLINE ]
                </span>
                <span class="bg-black text-white px-2 py-1 border-2 border-black">
                    USER_ID: {{ Auth::user()->id }}
                </span>
            </div>

            <p class="mt-6 text-lg">
                Bienvenido a la terminal de artistas emergentes.
                Este panel ahora sigue la estética de Minimalismo Radical.
            </p>

            <button
                class="mt-8 bg-black text-white px-6 py-3 border-2 border-black hover:bg-under-neon hover:text-black transition-none uppercase font-bold active:translate-x-1 active:translate-y-1">
                Explorar Comunidades
            </button>
        </div>
    </div>
</x-app-layout>