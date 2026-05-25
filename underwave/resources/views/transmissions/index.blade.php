<x-app-layout>
    <div class="py-12 bg-uw-bg" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=\'0 0 200 200\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'noiseFilter\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.85\' numOctaves=\'3\' stitchTiles=\'stitch\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23noiseFilter)\' opacity=\'0.05\'/%3E%3C/svg%3E');">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Title & Live Indicator -->
            <div class="mb-10 flex justify-between items-end border-b-4 border-uw-border pb-4">
                <div>
                    <h2 class="font-serif text-5xl uppercase italic flex items-center gap-3 text-uw-text">
                        Transmisiones
                        <span class="inline-flex items-center px-3 py-1 border-2 border-uw-border bg-uw-border text-uw-accent text-xs font-mono tracking-wider animate-pulse">
                            ● LIVE_RADAR
                        </span>
                    </h2>
                    <p class="font-mono text-sm opacity-60 mt-2 text-uw-text">[ FREQ: 94.3_MHZ // BROADCASTING_ACTIVE ]</p>
                </div>
            </div>

            <!-- Error/Success Alerts -->
            @if(session('success'))
                <div class="mb-6 bg-uw-accent border-4 border-uw-border p-4 shadow-brutal font-mono text-sm font-bold text-black flex justify-between items-center">
                    <span>>> {{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="hover:bg-uw-border hover:text-uw-bg px-2 border border-uw-border font-bold">X</button>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-400 border-4 border-uw-border p-4 shadow-brutal font-mono text-sm font-bold text-black">
                    <p class="font-bold border-b border-uw-border pb-2 mb-2">>> ERR_TRANSMISSION_FAILED:</p>
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form: LANZA TU MENSAJE -->
            <div class="mb-12 border-4 border-uw-border bg-uw-card shadow-brutal p-6 relative overflow-hidden text-uw-text">
                <!-- Retro Grid Decorative background -->
                <div class="absolute inset-0 bg-[radial-gradient(#000_1px,transparent_1px)] [background-size:16px_16px] opacity-[0.03] pointer-events-none"></div>
                
                <div class="relative z-10">
                    <div class="flex justify-between items-center mb-4 font-mono text-xs text-uw-text/50 border-b-2 border-dashed border-uw-border pb-2">
                        <span>[ PANEL_ID: XP-800 ]</span>
                        <span>[ STAT: READY_TO_BROADCAST ]</span>
                    </div>

                    <form action="{{ route('transmissions.store') }}" method="POST">
                        @csrf
                        <div class="mb-4 relative">
                            <textarea 
                                name="content" 
                                id="transmission-textarea"
                                rows="4" 
                                maxlength="280"
                                placeholder="Escribe tu mensaje... ¿Qué se cuece en el radar underground? (Máx. 280 caracteres)..."
                                class="w-full bg-uw-bg text-uw-text border-4 border-uw-border font-mono focus:ring-0 focus:outline-none p-4 placeholder-uw-text/50 shadow-brutal-sm focus:shadow-brutal transition-all"
                            ></textarea>
                            
                            <!-- Custom corner brackets in textarea box for extra techno vibe -->
                            <div class="absolute top-1 left-1 font-mono text-xs opacity-25 pointer-events-none">[</div>
                            <div class="absolute top-1 right-1 font-mono text-xs opacity-25 pointer-events-none">]</div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 font-mono">
                            <div class="text-xs bg-uw-border text-uw-bg px-3 py-1 border-2 border-uw-border flex items-center gap-2 shadow-brutal-sm">
                                <span>CHARS:</span>
                                <span id="char-counter" class="font-bold text-uw-accent">0</span>
                                <span class="opacity-50">/</span>
                                <span class="opacity-50">280</span>
                            </div>

                            <button type="submit" class="w-full sm:w-auto bg-uw-border text-uw-bg hover:bg-uw-accent hover:text-black font-bold uppercase py-3 px-8 border-4 border-uw-border transition-colors shadow-brutal-sm active:translate-x-1 active:translate-y-1 active:shadow-none">
                                TRANSMITIR >>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Feed: BURBUJAS DE RADAR -->
            <div class="space-y-8 mb-12">
                @forelse($transmissions as $transmission)
                    <div class="bg-uw-card border-4 border-uw-border shadow-brutal p-6 relative overflow-hidden group text-uw-text">
                        
                        <!-- Radar wave pulse aesthetic decoration at the corners of each card -->
                        <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-uw-border group-hover:bg-uw-accent transition-colors duration-300"></div>
                        <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-uw-border group-hover:bg-uw-accent transition-colors duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-uw-border group-hover:bg-uw-accent transition-colors duration-300"></div>
                        <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-uw-border group-hover:bg-uw-accent transition-colors duration-300"></div>

                        <!-- Scanlines simulation element -->
                        <div class="absolute top-0 left-0 w-full h-[2px] bg-uw-accent/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none shadow-[0_0_8px_var(--color-accent)]"></div>

                        <!-- Card Header -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b-2 border-uw-border pb-4 mb-4 gap-4">
                            <div class="flex items-center gap-3">
                                <!-- User Avatar -->
                                @if($transmission->user->avatar_path)
                                    <img src="{{ $transmission->user->avatar_path }}" alt="Avatar" class="w-10 h-10 border-2 border-uw-border bg-uw-bg shadow-[2px_2px_0px_0px_var(--color-border)]">
                                @else
                                    <div class="w-10 h-10 border-2 border-uw-border bg-uw-border flex items-center justify-center text-uw-bg text-xs font-mono font-bold shadow-[2px_2px_0px_0px_var(--color-border)]">
                                        UW
                                    </div>
                                @endif

                                <!-- User Name -->
                                <div class="font-mono text-sm">
                                    <a href="{{ route('users.show', $transmission->user) }}" class="font-bold hover:text-uw-accent hover:underline uppercase">
                                        {{ $transmission->user->name }}
                                    </a>
                                    <span class="text-xs opacity-50 block sm:inline sm:ml-2">[ID: #{{ str_pad($transmission->user->id, 4, '0', STR_PAD_LEFT) }}]</span>
                                </div>
                            </div>

                            <!-- Datetime and decoration -->
                            <div class="flex items-center gap-3 font-mono text-[10px] self-start sm:self-auto">
                                <div class="border border-uw-border px-2 py-0.5 bg-uw-bg/30 uppercase">
                                    {{ $transmission->created_at->diffForHumans() }}
                                </div>
                                <div class="hidden md:flex text-uw-text/40 font-bold">
                                    [SIG_RADAR: █ █ █ ░ ░]
                                </div>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="font-mono text-base text-uw-text whitespace-pre-wrap leading-relaxed py-2">
                            {{ $transmission->content }}
                        </div>

                        <!-- Card Footer Decoration -->
                        <div class="mt-4 border-t border-dashed border-uw-border/30 pt-3 flex justify-between items-center font-mono text-[9px] opacity-60">
                            <span>SYS_STREAM: ACTIVE</span>
                            <span>RADAR_NODE://{{ $transmission->id }}_{{ substr(md5($transmission->id), 0, 5) }}</span>
                        </div>

                    </div>
                @empty
                    <div class="border-4 border-uw-border border-dashed bg-uw-card p-12 text-center shadow-brutal font-mono text-uw-text">
                        <div class="text-4xl mb-4">📡</div>
                        <p class="text-lg font-bold uppercase mb-2">No hay señales captadas</p>
                        <p class="text-sm opacity-60">Sintonizador a la espera de la primera transmisión. ¡Sé el primero en emitir!</p>
                    </div>
                @endforelse
            </div>

            <!-- Paginator -->
            <div class="mt-12 bg-uw-card border-4 border-uw-border p-4 shadow-brutal font-mono text-uw-text">
                {{ $transmissions->links() }}
            </div>

        </div>
    </div>

    <!-- Micro-interactivity Client-side JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textarea = document.getElementById('transmission-textarea');
            const counter = document.getElementById('char-counter');

            if (textarea && counter) {
                textarea.addEventListener('input', function () {
                    const length = textarea.value.length;
                    counter.textContent = length;

                    if (length >= 250) {
                        counter.className = 'font-bold text-red-500';
                    } else if (length >= 200) {
                        counter.className = 'font-bold text-yellow-600';
                    } else {
                        counter.className = 'font-bold text-uw-accent';
                    }
                });
            }
        });
    </script>
</x-app-layout>
