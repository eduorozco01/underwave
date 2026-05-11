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

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                <div class="md:col-span-1 font-mono text-sm space-y-4">
                                    <div class="border-2 border-black p-3 bg-under-neon/20">
                                        <p class="font-bold border-b border-black mb-1">AUTHOR</p>
                                        <p>{{ $post->user->name }}</p>
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
                                <div class="mt-12 border-t-4 border-red-500 pt-6">
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
                        </div>

                        <div
                            class="bg-under-neon p-2 border-t-4 border-black font-mono text-[10px] text-center uppercase tracking-[0.2em]">
                            System_UnderWave // Digital_Underground_Archive
                        </div>
                    </div>

        </div>
    </div>
</x-app-layout>