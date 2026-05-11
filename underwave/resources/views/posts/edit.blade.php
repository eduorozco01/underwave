<x-app-layout>
    <div class="py-12 bg-under-beige">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-4 border-black shadow-brutal p-8">

                <div class="mb-8 border-b-4 border-black pb-4">
                    <h2 class="font-serif text-3xl uppercase">PATCH_RECORD_DATA</h2>
                    <p class="font-mono text-xs opacity-50">[ OVERWRITING_ID:
                        #{{ str_pad($post->id, 4, '0', STR_PAD_LEFT) }} ]</p>
                </div>

                <form action="{{ route('posts.update', $post) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-6">
                        <label class="block font-mono font-bold uppercase mb-2">Artistas / Evento:</label>
                        <input type="text" name="title" value="{{ $post->title }}"
                            class="w-full border-2 border-black p-3 focus:bg-under-neon outline-none transition-none font-mono">
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block font-mono font-bold uppercase mb-2">Categoría:</label>
                            <select name="category"
                                class="w-full border-2 border-black p-3 bg-white font-mono appearance-none">
                                <option value="Musica" {{ $post->category == 'Musica' ? 'selected' : '' }}>MÚSICA</option>
                                <option value="Teatro" {{ $post->category == 'Teatro' ? 'selected' : '' }}>TEATRO</option>
                                <option value="Mercadillo" {{ $post->category == 'Mercadillo' ? 'selected' : '' }}>
                                    MERCADILLO</option>
                                <option value="Arte" {{ $post->category == 'Arte' ? 'selected' : '' }}>ARTE</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-mono font-bold uppercase mb-2">Presupuesto:</label>
                            <select name="price_range" class="w-full border-2 border-black p-3 bg-white font-mono">
                                <option value="Gratis" {{ $post->price_range == 'Gratis' ? 'selected' : '' }}>GRATIS
                                </option>
                                <option value="<10€" {{ $post->price_range == '<10€' ? 'selected' : '' }}>-10€</option>
                                <option value=">10€" {{ $post->price_range == '>10€' ? 'selected' : '' }}>+10€</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-mono font-bold uppercase mb-2">Descripción / Bio:</label>
                        <textarea name="content" rows="4"
                            class="w-full border-2 border-black p-3 focus:bg-under-neon outline-none font-mono">{{ $post->content }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-under-neon text-black py-4 border-4 border-black font-mono font-black text-xl uppercase hover:bg-black hover:text-under-neon transition-none active:translate-x-1 active:translate-y-1 shadow-brutal-sm">
                        EXECUTE_OVERWRITE >>
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>