<x-app-layout>
    <div class="py-12 bg-under-beige">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-4 border-black shadow-brutal p-8">

                <div class="mb-8 border-b-4 border-black pb-4">
                    <h2 class="font-serif text-3xl uppercase">SUBMIT_NEW_ENTRY</h2>
                    <p class="font-mono text-xs opacity-50">[ SESSION_ACTIVE // DATABASE_READY ]</p>
                </div>

                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block font-mono font-bold uppercase mb-2">Artistas / Evento:</label>
                        <input type="text" name="title"
                            class="w-full border-2 border-black p-3 focus:bg-under-neon outline-none transition-none font-mono"
                            placeholder="EJ: DIAMANTE NEGRO EN SALA X">
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block font-mono font-bold uppercase mb-2">Categoría:</label>
                            <select name="category"
                                class="w-full border-2 border-black p-3 bg-white font-mono appearance-none">
                                <option value="Musica">MÚSICA</option>
                                <option value="Teatro">TEATRO</option>
                                <option value="Mercadillo">MERCADILLO</option>
                                <option value="Arte">ARTE</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-mono font-bold uppercase mb-2">Presupuesto:</label>
                            <select name="price_range" class="w-full border-2 border-black p-3 bg-white font-mono">
                                <option value="Gratis">GRATIS</option>
                                <option value="<10€">+10€</option>
                                <option value=">10€">-10€</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-mono font-bold uppercase mb-2">Descripción / Bio:</label>
                        <textarea name="content" rows="4"
                            class="w-full border-2 border-black p-3 focus:bg-under-neon outline-none font-mono"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-black text-under-neon py-4 border-2 border-black font-mono font-black text-xl uppercase hover:bg-under-neon hover:text-black transition-none active:translate-x-1 active:translate-y-1">
                        CONFIRM_UPLOAD >>
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>