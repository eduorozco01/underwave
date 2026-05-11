<x-app-layout>
    <div class="py-12 bg-under-beige min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('dashboard') }}"
                class="inline-block mb-6 font-mono text-sm hover:text-under-neon bg-black text-white px-4 py-1 border-2 border-black shadow-brutal-sm active:translate-x-1 active:translate-y-1 transition-none">
                << RETURN_TO_SYSTEM </a>

                    <div class="bg-white border-4 border-black shadow-brutal p-8 mb-12">
                        <div class="flex items-center justify-between border-b-4 border-black pb-4 mb-6">
                            <h2 class="font-serif text-5xl uppercase italic">USER_DATA</h2>
                            <span class="bg-under-neon text-black px-3 py-1 border-2 border-black font-mono font-bold">
                                STATUS: ACTIVE
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 font-mono text-lg">
                            <div class="border-2 border-black p-4 bg-under-beige">
                                <p class="text-xs opacity-50 mb-1 uppercase">ID_Alias</p>
                                <p class="font-bold uppercase">{{ $user->name }}</p>
                            </div>
                            <div class="border-2 border-black p-4 bg-under-beige">
                                <p class="text-xs opacity-50 mb-1 uppercase">Registration_Date</p>
                                <p class="font-bold">{{ $user->created_at->format('d.m.Y') }}</p>
                            </div>
                            <div class="border-2 border-black p-4 bg-under-beige">
                                <p class="text-xs opacity-50 mb-1 uppercase">Total_Transmissions</p>
                                <p class="font-bold">{{ $posts->count() }} POSTS</p>
                            </div>
                        </div>
                    </div>

                    <h3
                        class="font-mono text-xl border-b-4 border-black mb-8 inline-block uppercase bg-black text-white px-4 py-1">
                        [ ARCHIVO_DE_{{ $user->name }} ]
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($posts as $post)
                            <div class="bg-white border-4 border-black shadow-brutal flex flex-col">

                                <div class="bg-black text-white p-2 flex justify-between items-center font-mono text-xs">
                                    <span>ID: #{{ str_pad($post->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    <span
                                        class="bg-under-neon text-black px-2 font-bold">{{ strtoupper($post->category) }}</span>
                                </div>

                                @if($post->image_path)
                                    <div class="border-b-4 border-black h-48 overflow-hidden bg-under-beige">
                                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Flyer"
                                            class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-300">
                                    </div>
                                @else
                                    <div
                                        class="border-b-4 border-black h-12 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjRjJGMEU5Ij48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDBMOCA4Wk04IDBMMCA4WiIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEiIG9wYWNpdHk9IjAuMSI+PC9wYXRoPgo8L3N2Zz4=')]">
                                    </div>
                                @endif

                                <div class="p-6 flex-grow">
                                    <h3
                                        class="font-serif text-2xl mb-4 leading-none uppercase hover:text-under-neon transition-colors">
                                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="font-mono text-sm line-clamp-3 opacity-80 mb-6">{{ $post->content }}</p>
                                </div>

                                <div
                                    class="border-t-2 border-black p-4 bg-under-beige/30 font-mono text-[10px] grid grid-cols-2 gap-2">
                                    <div class="border border-black p-1">[PRICE_INDEX: {{ $post->price_range }}]</div>
                                    <div class="border border-black p-1 uppercase">[AUTH: {{ $post->user->name }}]</div>
                                </div>

                            </div>
                        @endforeach
                    </div>

        </div>
    </div>
</x-app-layout>