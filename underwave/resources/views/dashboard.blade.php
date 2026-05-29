<x-app-layout>
    <!-- Leaflet JS & CSS CDNs -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <div x-data class="py-12 bg-uw-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b-4 border-uw-border pb-4">
                <div class="max-w-full overflow-hidden">
                    <h2 class="font-serif font-black text-2xl sm:text-3xl md:text-4xl text-uw-text uppercase tracking-tighter bg-uw-card px-4 py-2 border-4 border-uw-border shadow-brutal inline-block max-w-full break-words">TABLÓN DE EVENTOS</h2>
                    <p class="font-mono text-sm opacity-60 mt-4 text-uw-text break-words">[ RECORDS_FOUND: {{ $posts->count() }} ]</p>
                </div>
                @hasrole('Banda')
                <a href="{{ route('posts.create') }}"
                    class="bg-uw-accent text-black border-2 border-uw-border px-6 py-2 font-mono font-bold hover:bg-black hover:text-uw-accent transition-all shadow-brutal-sm active:translate-x-1 active:translate-y-1 w-full md:w-auto text-center">
                    + ADD_NEW_ENTRY
                </a>
                @endhasrole
            </div>

            <!-- FILTERS & SCANNER PANEL -->
            <div
                class="mb-10 border-4 border-uw-border bg-uw-card p-4 shadow-brutal flex flex-col md:flex-row justify-between items-center gap-6 text-uw-text">

                <div class="flex flex-wrap gap-2 font-mono text-sm items-center">
                    <span class="bg-uw-border text-uw-bg px-2 py-1 font-bold">FILTERS:</span>

                    <a href="{{ route('dashboard') }}"
                        class="border-2 border-uw-border px-3 py-1 transition-all hover:bg-black hover:text-uw-accent {{ !request('category') && !request('search') ? 'bg-uw-accent text-black font-bold' : 'bg-uw-bg' }}">
                        ALL_DATA
                    </a>

                    <a href="{{ route('dashboard', ['category' => 'Musica']) }}"
                        class="border-2 border-uw-border px-3 py-1 transition-all hover:bg-black hover:text-uw-accent {{ request('category') == 'Musica' ? 'bg-uw-accent text-black font-bold' : 'bg-uw-bg' }}">
                        MÚSICA
                    </a>

                    <a href="{{ route('dashboard', ['category' => 'Teatro']) }}"
                        class="border-2 border-uw-border px-3 py-1 transition-all hover:bg-black hover:text-uw-accent {{ request('category') == 'Teatro' ? 'bg-uw-accent text-black font-bold' : 'bg-uw-bg' }}">
                        TEATRO
                    </a>

                    <a href="{{ route('dashboard', ['category' => 'Mercadillo']) }}"
                        class="border-2 border-uw-border px-3 py-1 transition-all hover:bg-black hover:text-uw-accent {{ request('category') == 'Mercadillo' ? 'bg-uw-accent text-black font-bold' : 'bg-uw-bg' }}">
                        MERCADILLO
                    </a>

                    <a href="{{ route('dashboard', ['category' => 'Arte']) }}"
                        class="border-2 border-uw-border px-3 py-1 transition-all hover:bg-black hover:text-uw-accent {{ request('category') == 'Arte' ? 'bg-uw-accent text-black font-bold' : 'bg-uw-bg' }}">
                        ARTE
                    </a>
                </div>

                <form action="{{ route('dashboard') }}" method="GET"
                    class="flex flex-col sm:flex-row w-full md:w-auto border-2 border-uw-border bg-uw-card">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="SCAN_DATABASE..."
                        class="p-2 font-mono text-sm w-full outline-none focus:bg-uw-accent border-none bg-uw-card text-uw-text sm:w-48 md:w-64 min-w-0">
                    <button type="submit"
                        class="bg-uw-border text-uw-bg px-4 py-2 font-mono font-bold hover:bg-black hover:text-uw-accent transition-all border-t-2 sm:border-t-0 sm:border-l-2 border-uw-border whitespace-nowrap">
                        SCAN >>
                    </button>
                </form>
            </div>

            <!-- DYNAMIC RADAR MAP -->
            @php
                $mapData = collect($posts->items())->map(function($post) {
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'category' => $post->category,
                        'price_range' => $post->price_range,
                        'event_date' => $post->event_date ? \Carbon\Carbon::parse($post->event_date)->format('d/m/Y') : 'TBA',
                        'latitude' => $post->latitude,
                        'longitude' => $post->longitude,
                        'audio_path' => $post->audio_path ? asset('storage/' . $post->audio_path) : null,
                        'author' => $post->user->name ?? 'UNKNOWN_ENTITY',
                        'show_url' => route('posts.show', $post),
                    ];
                })->toArray();
            @endphp
            <div class="mb-10 border-4 border-uw-border shadow-brutal bg-[#0D0C0F]" x-data="{ mapOpen: true }">
                <div class="bg-uw-border text-uw-bg p-3 font-mono text-xs sm:text-sm flex flex-col sm:flex-row justify-between items-start sm:items-center cursor-pointer select-none gap-2" @click="mapOpen = !mapOpen; if(mapOpen) { $nextTick(() => { window.dispatchEvent(new Event('resize')); }) }">
                    <span class="font-bold break-all">🌐 RADAR_MAP // LOCATION_SCANNER</span>
                    <span x-text="mapOpen ? '[- HIDE_RADAR_MAP]' : '[+ SHOW_RADAR_MAP]'" class="whitespace-nowrap"></span>
                </div>
                <div x-show="mapOpen" class="w-full h-96 border-t-4 border-uw-border neo-brutal-map relative bg-black" id="radar-map-container"></div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const mapContainer = document.getElementById('radar-map-container');
                    if (mapContainer) {
                        const map = L.map('radar-map-container').setView([37.3891, -5.9845], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap'
                        }).addTo(map);

                        const mapPosts = @json($mapData);

                        const brutalIcon = L.divIcon({
                            className: 'brutal-icon',
                            html: `<div class="w-4 h-4 bg-uw-accent border-2 border-uw-border shadow-[2px_2px_0px_0px_var(--color-border)] hover:scale-110 hover:bg-uw-border transition-all"></div>`,
                            iconSize: [16, 16],
                            iconAnchor: [8, 8]
                        });

                        mapPosts.forEach(post => {
                            if (post.latitude && post.longitude) {
                                const marker = L.marker([post.latitude, post.longitude], { icon: brutalIcon }).addTo(map);
                                let popupHtml = `
                                    <div class="font-mono text-xs p-1 select-none">
                                        <div class="border-b-2 border-uw-border pb-1 mb-2 font-bold text-uw-accent text-sm uppercase">${post.category}</div>
                                        <h4 class="font-serif font-black text-sm uppercase mb-2 text-uw-text leading-tight">${post.title}</h4>
                                        <p class="mb-2 opacity-80">[AUTH: ${post.author}] // [PRICE: ${post.price_range}]<br>[DATE: ${post.event_date}]</p>
                                        <div class="flex gap-2 mt-2">
                                            <a href="${post.show_url}" class="px-2 py-1 bg-uw-accent text-black border-2 border-uw-border font-bold hover:bg-black hover:text-uw-accent transition-all text-center block text-[10px] shadow-[2px_2px_0px_0px_var(--color-border)]" style="text-decoration: none;">DETALLES >></a>
                                `;
                                if (post.audio_path) {
                                    popupHtml += `
                                        <button onclick="window.dispatchEvent(new CustomEvent('play-track', { detail: { url: '${post.audio_path}', title: '${post.title.replace(/'/g, "\\'")}', band: '${post.author.replace(/'/g, "\\'")}' } }))" class="px-2 py-1 bg-uw-border text-uw-bg border-2 border-uw-border font-bold hover:bg-uw-accent hover:text-black text-center text-[10px] shadow-[2px_2px_0px_0px_var(--color-accent)]">🔊 ESCUCHAR</button>
                                    `;
                                }
                                popupHtml += `
                                        </div>
                                    </div>
                                `;
                                marker.bindPopup(popupHtml);
                            }
                        });
                    }
                });
            </script>

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
                                @if($post->audio_path)
                                    <div class="mb-4">
                                        <button @click="$dispatch('play-track', { url: '{{ asset('storage/' . $post->audio_path) }}', title: '{{ $post->title }}', band: '{{ $post->user->name }}' })"
                                            class="w-full font-mono text-xs uppercase px-3 py-2 border-4 border-uw-border bg-uw-accent text-black font-bold hover:bg-black hover:text-uw-accent transition-all shadow-[4px_4px_0px_0px_var(--color-border)] active:translate-y-[1px] active:translate-x-[1px]">
                                            🔊 ESCUCHAR MAQUETA
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Footer metadata details -->
                        <div
                            class="border-t-2 border-uw-border p-4 bg-uw-bg/30 font-mono text-[10px] grid grid-cols-2 gap-2">
                            <div class="border border-uw-border p-1">
                                [PRICE: {{ $post->price_range }}] // [DATE: {{ $post->event_date ? \Carbon\Carbon::parse($post->event_date)->format('d/m/Y') : 'TBA' }}] // [GOERS: {{ $post->attendees()->count() }}]
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