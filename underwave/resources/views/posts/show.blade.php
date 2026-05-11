<x-app-layout>
    <div class="py-12 bg-under-beige min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('dashboard') }}"
                class="inline-block mb-6 font-mono text-sm hover:text-under-neon bg-black text-white px-4 py-1 border-2 border-black">
                << RETURN_TO_FEED </a>

                    <div class="bg-white border-4 border-black shadow-brutal overflow-hidden">
                        <div class="bg-black text-white p-4 font-mono text-xs flex justify-between">
                            <span>FILE_TYPE: {{ strtoupper($post->category) }}</span>
                            <span>CREATED_AT: {{ $post->created_at->format('d.m.Y // H:i') }}</span>
                        </div>

                        <div class="p-10">
                            <h1 class="font-serif text-6xl uppercase leading-none mb-8 border-b-4 border-black pb-4">
                                {{ $post->title }}
                            </h1>
                            @if($post->image_path)
                                <div class="mb-8 border-4 border-black shadow-brutal-sm">
                                    <img src="{{ asset('storage/' . $post->image_path) }}"
                                        alt="Cartel de {{ $post->title }}" class="w-full max-h-[500px] object-cover">
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                <div class="md:col-span-1 font-mono text-sm space-y-4">
                                    <div class="border-2 border-black p-3 bg-under-neon/20">
                                        <p class="font-bold border-b border-black mb-1">AUTHOR</p>
                                        <p><a href="{{ route('users.show', $post->user) }}"
                                                class="hover:text-under-neon hover:underline">{{ $post->user->name }}</a>
                                        </p>
                                    </div>
                                    <div class="border-2 border-black p-3">
                                        <p class="font-bold border-b border-black mb-1">BUDGET</p>
                                        <p>{{ $post->price_range }}</p>
                                    </div>
                                </div>

                                <div class="md:col-span-3">
                                    <p class="font-mono text-lg leading-relaxed whitespace-pre-line">
                                        {{ $post->content }}
                                    </p>
                                </div>
                            </div>@if(Auth::id() === $post->user_id)

                                <div class="mt-12 border-t-4 border-black pt-6 flex gap-4">

                                    <a href="{{ route('posts.edit', $post) }}"
                                        class="bg-under-neon text-black px-6 py-2 border-4 border-black font-mono font-bold hover:bg-black hover:text-under-neon transition-none shadow-brutal-sm active:translate-x-1 active:translate-y-1">
                                        [~] EDIT_RECORD
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                        onsubmit="return confirm('WARNING: ¿Purgar este registro permanentemente de UnderWave?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-black px-6 py-2 border-4 border-black font-mono font-bold hover:bg-black hover:text-red-500 transition-none shadow-brutal-sm active:translate-x-1 active:translate-y-1">
                                            [X] PURGE_RECORD
                                        </button>
                                    </form>
                                </div>
                            @endif
                            <div class="mt-16 border-t-8 border-black pt-8">
                                <h3 class="font-serif text-3xl uppercase mb-6 flex items-center gap-4">
                                    <span
                                        class="bg-black text-white px-3 py-1 text-sm font-mono align-middle">{{ $post->comments->count() }}</span>
                                    USER_FEEDBACK
                                </h3>

                                <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-10">
                                    @csrf
                                    <div class="flex flex-col border-4 border-black shadow-brutal-sm">
                                        <textarea name="content" rows="3" placeholder="WRITE_YOUR_TRANSMISSION_HERE..."
                                            class="w-full p-4 font-mono outline-none border-b-4 border-black resize-none focus:bg-under-neon/20"></textarea>
                                        <div class="bg-under-beige p-2 flex justify-end">
                                            <button type="submit"
                                                class="bg-black text-white px-6 py-2 font-mono font-bold hover:bg-under-neon hover:text-black transition-none uppercase text-sm">
                                                TRANSMIT >>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="space-y-6">
                                    @foreach($post->comments()->latest()->get() as $comment)
                                        <div
                                            class="border-2 border-black p-4 {{ $comment->user_id === Auth::id() ? 'bg-under-neon/20' : 'bg-white' }}">
                                            <div
                                                class="flex justify-between items-center border-b-2 border-black pb-2 mb-3 font-mono text-xs">
                                                <span class="font-bold uppercase">ID_USR: {{ $comment->user->name }}</span>
                                                <span class="opacity-50">T:
                                                    {{ $comment->created_at->format('H:i // d.m.y') }}</span>
                                            </div>
                                            <p class="font-mono text-sm leading-relaxed">
                                                {{ $comment->content }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-under-neon p-2 border-t-4 border-black font-mono text-[10px] text-center uppercase tracking-[0.2em]">
                            System_UnderWave // Digital_Underground_Archive
                        </div>
                    </div>

        </div>
    </div>
</x-app-layout>