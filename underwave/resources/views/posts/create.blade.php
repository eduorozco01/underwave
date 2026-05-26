<x-app-layout>
    <!-- Leaflet JS & CSS CDNs -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <div class="py-12 bg-uw-bg min-h-screen text-uw-text">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-uw-card border-4 border-uw-border shadow-brutal p-8">

                <div class="mb-8 border-b-4 border-uw-border pb-4">
                    <h2 class="font-serif text-3xl uppercase text-uw-text">SUBMIT_NEW_ENTRY</h2>
                    <p class="font-mono text-xs opacity-50">[ SESSION_ACTIVE // DATABASE_READY ]</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 bg-red-500 border-4 border-uw-border p-4 shadow-brutal font-mono text-sm font-bold text-white">
                        <p class="font-bold border-b border-white pb-2 mb-2">>> ERR_VALIDATION_FAILED:</p>
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-6">
                        <label class="block font-mono font-bold uppercase mb-2">Artistas / Evento:</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full border-2 border-uw-border bg-uw-bg text-uw-text p-3 focus:bg-uw-accent/20 outline-none transition-none font-mono"
                            placeholder="EJ: DIAMANTE NEGRO EN SALA X">
                    </div>

                    <!-- Category & Budget -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block font-mono font-bold uppercase mb-2">Categoría:</label>
                            <select name="category" required
                                class="w-full border-2 border-uw-border p-3 bg-uw-bg text-uw-text font-mono appearance-none outline-none focus:bg-uw-accent/20">
                                <option value="Musica" {{ old('category') == 'Musica' ? 'selected' : '' }}>MÚSICA</option>
                                <option value="Teatro" {{ old('category') == 'Teatro' ? 'selected' : '' }}>TEATRO</option>
                                <option value="Mercadillo" {{ old('category') == 'Mercadillo' ? 'selected' : '' }}>MERCADILLO</option>
                                <option value="Arte" {{ old('category') == 'Arte' ? 'selected' : '' }}>ARTE</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-mono font-bold uppercase mb-2">Presupuesto:</label>
                            <select name="price_range" required class="w-full border-2 border-uw-border p-3 bg-uw-bg text-uw-text font-mono outline-none focus:bg-uw-accent/20">
                                <option value="Gratis" {{ old('price_range') == 'Gratis' ? 'selected' : '' }}>GRATIS</option>
                                <option value="<10€" {{ old('price_range') == '<10€' ? 'selected' : '' }}>+10€</option>
                                <option value=">10€" {{ old('price_range') == '>10€' ? 'selected' : '' }}>-10€</option>
                            </select>
                        </div>
                    </div>

                    <!-- Cartel Upload -->
                    <div class="mb-6">
                        <label class="block font-mono font-bold uppercase mb-2">Cartel / Flyer (Opcional):</label>
                        <div class="border-2 border-dashed border-uw-border p-4 bg-uw-bg text-center hover:bg-uw-accent/20 transition-colors cursor-pointer">
                            <input type="file" name="image" id="image" accept="image/*"
                                class="w-full font-mono text-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:border-2 file:border-uw-border file:text-sm file:font-bold file:bg-uw-border file:text-uw-bg hover:file:bg-uw-accent hover:file:text-uw-text file:transition-none">
                        </div>
                    </div>

                    <!-- Maqueta Upload -->
                    <div class="mb-6">
                        <label class="block font-mono font-bold uppercase mb-2">Maqueta / Audio (.mp3, .wav, .ogg) (Opcional):</label>
                        <div class="border-2 border-dashed border-uw-border p-4 bg-uw-bg text-center hover:bg-uw-accent/20 transition-colors cursor-pointer">
                            <input type="file" name="audio" id="audio" accept="audio/*"
                                class="w-full font-mono text-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:border-2 file:border-uw-border file:text-sm file:font-bold file:bg-uw-border file:text-uw-bg hover:file:bg-uw-accent hover:file:text-uw-text file:transition-none">
                        </div>
                    </div>

                    <!-- Coordinates Map Picker -->
                    <div class="mb-6 border-4 border-uw-border p-4 bg-uw-card shadow-brutal-sm">
                        <label class="block font-mono font-bold uppercase mb-2">🌐 UBICACIÓN DEL EVENTO // COORDINATES</label>
                        <p class="font-mono text-[10px] opacity-60 mb-4">Haz clic en el mapa de radar para marcar exactamente dónde se celebrará el concierto.</p>
                        
                        <div id="picker-map" class="h-64 border-2 border-uw-border bg-uw-bg mb-4 relative z-10 neo-brutal-map"></div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-mono text-xs font-bold uppercase mb-1">Latitud (Auto):</label>
                                <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" readonly placeholder="Haz clic en el mapa..."
                                    class="w-full border-2 border-uw-border p-2 bg-uw-bg text-uw-text font-mono text-xs outline-none cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block font-mono text-xs font-bold uppercase mb-1">Longitud (Auto):</label>
                                <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" readonly placeholder="Haz clic en el mapa..."
                                    class="w-full border-2 border-uw-border p-2 bg-uw-bg text-uw-text font-mono text-xs outline-none cursor-not-allowed">
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label class="block font-mono font-bold uppercase mb-2">Descripción / Bio:</label>
                        <textarea name="content" rows="4" required
                            class="w-full border-2 border-uw-border bg-uw-bg text-uw-text p-3 focus:bg-uw-accent/20 outline-none font-mono resize-none">{{ old('content') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-uw-border text-uw-bg py-4 border-2 border-uw-border font-mono font-black text-xl uppercase hover:bg-uw-accent hover:text-uw-text transition-none shadow-brutal active:translate-x-1 active:translate-y-1">
                        CONFIRM_UPLOAD >>
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- Script para inicializar el mapa elector de Leaflet -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pickerMapEl = document.getElementById('picker-map');
            if (pickerMapEl) {
                // Centrado inicial por defecto en Madrid
                const map = L.map('picker-map').setView([40.4167, -3.7037], 12);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(map);

                const brutalIcon = L.divIcon({
                    className: 'brutal-icon',
                    html: `<div class="w-4 h-4 bg-uw-accent border-2 border-uw-border shadow-[2px_2px_0px_0px_var(--color-border)] hover:scale-110 hover:bg-uw-border transition-all"></div>`,
                    iconSize: [16, 16],
                    iconAnchor: [8, 8]
                });

                let marker = null;

                // Cargar valores antiguos si el formulario falla y se recarga
                const oldLat = document.getElementById('latitude').value;
                const oldLng = document.getElementById('longitude').value;
                if (oldLat && oldLng) {
                    const latlng = L.latLng(oldLat, oldLng);
                    marker = L.marker(latlng, { icon: brutalIcon }).addTo(map);
                    map.setView(latlng, 14);
                }

                map.on('click', (e) => {
                    const lat = e.latlng.lat.toFixed(8);
                    const lng = e.latlng.lng.toFixed(8);

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;

                    if (marker) {
                        marker.setLatLng(e.latlng);
                    } else {
                        marker = L.marker(e.latlng, { icon: brutalIcon }).addTo(map);
                    }
                });
            }
        });
    </script>
</x-app-layout>