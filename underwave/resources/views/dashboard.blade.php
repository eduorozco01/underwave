<x-app-layout>
    <div class="py-12 bg-uw-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-10 flex justify-between items-end border-b-4 border-uw-border pb-4">
                <div>
                    <h2 class="font-serif text-5xl uppercase italic text-uw-text">Live_Feed</h2>
                    <p class="font-mono text-sm opacity-60 mt-2 text-uw-text">[ RECORDS_FOUND: {{ $posts->count() }} ]</p>
                </div>
                <a href="{{ route('posts.create') }}"
                    class="bg-uw-accent text-uw-text border-2 border-uw-border px-6 py-2 font-mono font-bold hover:bg-uw-border hover:text-uw-bg transition-none shadow-brutal-sm active:translate-x-1 active:translate-y-1">
                    + ADD_NEW_ENTRY
                </a>
            </div>

            <!-- FILTERS & SCANNER PANEL -->
            <div
                class="mb-10 border-4 border-uw-border bg-uw-card p-4 shadow-brutal flex flex-col md:flex-row justify-between items-center gap-6 text-uw-text">

                <div class="flex flex-wrap gap-2 font-mono text-sm items-center">
                    <span class="bg-uw-border text-uw-bg px-2 py-1 font-bold">FILTERS:</span>

                    <a href="{{ route('dashboard') }}"
                        class="border-2 border-uw-border px-3 py-1 transition-none hover:bg-uw-border hover:text-uw-bg {{ !request('category') && !request('search') ? 'bg-uw-accent font-bold' : 'bg-uw-bg' }}">
                        ALL_DATA
                    </a>

                    <a href="{{ route('dashboard', ['category' => 'Musica']) }}"
                        class="border-2 border-uw-border px-3 py-1 transition-none hover:bg-uw-border hover:text-uw-bg {{ request('category') == 'Musica' ? 'bg-uw-accent font-bold' : 'bg-uw-bg' }}">
                        MÚSICA
                    </a>

                    <a href="{{ route('dashboard', ['category' => 'Teatro']) }}"
                        class="border-2 border-uw-border px-3 py-1 transition-none hover:bg-uw-border hover:text-uw-bg {{ request('category') == 'Teatro' ? 'bg-uw-accent font-bold' : 'bg-uw-bg' }}">
                        TEATRO
                    </a>

                    <a href="{{ route('dashboard', ['category' => 'Mercadillo']) }}"
                        class="border-2 border-uw-border px-3 py-1 transition-none hover:bg-uw-border hover:text-uw-bg {{ request('category') == 'Mercadillo' ? 'bg-uw-accent font-bold' : 'bg-uw-bg' }}">
                        MERCADILLO
                    </a>

                    <a href="{{ route('dashboard', ['category' => 'Arte']) }}"
                        class="border-2 border-uw-border px-3 py-1 transition-none hover:bg-uw-border hover:text-uw-bg {{ request('category') == 'Arte' ? 'bg-uw-accent font-bold' : 'bg-uw-bg' }}">
                        ARTE
                    </a>
                </div>

                <form action="{{ route('dashboard') }}" method="GET"
                    class="flex w-full md:w-auto border-2 border-uw-border bg-uw-card">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="SCAN_DATABASE..."
                        class="p-2 font-mono text-sm w-full md:w-64 outline-none focus:bg-uw-accent border-none bg-uw-card text-uw-text">
                    <button type="submit"
                        class="bg-uw-border text-uw-bg px-4 font-mono font-bold hover:text-uw-accent transition-none">
                        SCAN >>
                    </button>
                </form>
            </div>

            <!-- MASONRY CARDS container -->
            <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8 p-4 bg-uw-bg" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=\'0 0 200 200\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'noiseFilter\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.85\' numOctaves=\'3\' stitchTiles=\'stitch\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23noiseFilter)\' opacity=\'0.05\'/%3E%3C/svg%3E');">
                @foreach($posts as $post)
                    @php
                        // Definimos una lista de clases de rotación ligera (caos controlado)
                        $rotaciones = ['-rotate-1', 'rotate-1', '-rotate-2', 'rotate-2', '-rotate-3', 'rotate-3', 'rotate-0'];
                        // Elegimos una al azar para este post
                        $rotacionAzar = $rotaciones[array_rand($rotaciones)];
                    @endphp

                    <div class="bg-uw-card border-4 border-uw-border shadow-brutal flex flex-col break-inside-avoid transition-transform hover:scale-105 hover:rotate-0 {{ $rotacionAzar }} text-uw-text">
                        <div class="bg-uw-border text-uw-bg p-2 flex justify-between items-center font-mono text-xs">
                            <span>ID: #{{ str_pad($post->id, 4, '0', STR_PAD_LEFT) }}</span>
                            <span class="bg-uw-accent text-black px-2 font-bold">{{ strtoupper($post->category) }}</span>
                        </div>

                        @if($post->image_path)
                            <div class="border-b-4 border-uw-border h-48 overflow-hidden bg-uw-bg">
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Flyer"
                                    class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-300">
                            </div>
                        @else
                            <div
                                class="border-b-4 border-uw-border h-12 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjRjJGMEU5Ij48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDBMOCA4Wk04IDBMMCA4WiIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEiIG9wYWNpdHk9IjAuMSI+PC9wYXRoPgo8L3N2Zz4=')]">
                            </div>
                        @endif

                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h3
                                    class="font-serif text-2xl mb-4 leading-none uppercase hover:text-uw-accent transition-colors">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="font-mono text-sm line-clamp-3 opacity-80 mb-6">
                                    {{ $post->content }}
                                </p>
                            </div>

                            <!-- ME APUNTO / ATTEND EVENT BUTTON -->
                            <div class="mt-4 border-t-4 border-uw-border pt-4">
                                <form method="POST" action="{{ route('posts.attend', $post) }}">
                                    @csrf
                                    @php
                                        // Comprobamos si el usuario actual ya está apuntado a este evento
                                        $isAttending = auth()->user()->attendedEvents->contains($post);
                                    @endphp
                                    
                                    <button type="submit" class="w-full font-mono font-bold uppercase py-2 border-4 border-uw-border transition-transform hover:translate-y-1 hover:translate-x-1 shadow-[4px_4px_0px_0px_var(--color-border)] hover:shadow-none 
                                        {{ $isAttending ? 'bg-[#ff3333] text-white' : 'bg-uw-accent text-black hover:bg-uw-border hover:text-uw-bg' }}">
                                        {{ $isAttending ? 'NO VOY A IR [X]' : '¡ME APUNTO! >>' }}
                                    </button>
                                </form>
                                <p class="text-xs font-mono mt-2 text-right">
                                    Asistentes confirmados: {{ $post->attendees()->count() }}
                                </p>
                            </div>
                        </div>

                        <!-- Footer metadata details -->
                        <div
                            class="border-t-2 border-uw-border p-4 bg-uw-bg/30 font-mono text-[10px] grid grid-cols-2 gap-2">
                            <div class="border border-uw-border p-1">
                                [PRICE_INDEX: {{ $post->price_range }}]
                            </div>
                            <div class="border border-uw-border p-1 uppercase flex items-center gap-2">
                                @if($post->user->avatar_path)
                                    <img src="{{ $post->user->avatar_path }}" alt="Avatar" class="w-4 h-4 border border-uw-border bg-uw-card">
                                @endif
                                <span>[AUTH: <a href="{{ route('users.show', $post->user) }}" class="hover:text-uw-accent hover:underline">{{ $post->user->name ?? 'UNKNOWN_ENTITY' }}</a>]</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- PAGINATION -->
            <div class="mt-12 bg-uw-card border-4 border-uw-border p-4 shadow-brutal font-mono text-uw-text">
                {{ $posts->links() }}
            </div>

        </div>
    </div>
</x-app-layout>