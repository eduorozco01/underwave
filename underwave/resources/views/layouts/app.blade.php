<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script>
        const theme = localStorage.getItem('theme') || 'fanzine';
        if (theme !== 'fanzine') {
            document.documentElement.setAttribute('data-theme', theme);
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Syne:wght@400..800&display=swap" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-mono antialiased bg-uw-bg text-uw-text">
    <div class="min-h-screen bg-uw-bg">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-uw-card border-b-4 border-uw-border">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="border-t-4 border-uw-border min-h-screen">
            {{ $slot }}
        </main>
    </div>

    <!-- NEO-WINAMP AUDIO PLAYER -->
    <div x-data="{
            isPlaying: false,
            audioUrl: '',
            trackTitle: '',
            bandName: '',
            playerVisible: false,
            audioElement: null,
            currentTime: 0,
            duration: 0,
            progress: 0,

            init() {
                this.audioElement = this.$refs.audio;
                this.audioElement.addEventListener('timeupdate', () => {
                    this.currentTime = this.audioElement.currentTime;
                    this.duration = this.audioElement.duration || 0;
                    this.progress = this.duration > 0 ? (this.currentTime / this.duration) * 100 : 0;
                });
                this.audioElement.addEventListener('ended', () => {
                    this.isPlaying = false;
                });
            },
            playTrack(url, title, band) {
                if (this.audioUrl === url) {
                    this.togglePlay();
                    return;
                }
                this.audioUrl = url;
                this.trackTitle = title;
                this.bandName = band;
                this.playerVisible = true;
                this.audioElement.src = url;
                this.audioElement.load();
                this.audioElement.play().then(() => {
                    this.isPlaying = true;
                }).catch(e => console.log('Audio error:', e));
            },
            togglePlay() {
                if (this.isPlaying) {
                    this.audioElement.pause();
                    this.isPlaying = false;
                } else {
                    this.audioElement.play().then(() => {
                        this.isPlaying = true;
                    }).catch(e => console.log(e));
                }
            },
            stopTrack() {
                this.audioElement.pause();
                this.audioElement.currentTime = 0;
                this.isPlaying = false;
            },
            seek(event) {
                const rect = this.$refs.progressBar.getBoundingClientRect();
                const clickX = event.clientX - rect.left;
                const percentage = clickX / rect.width;
                this.audioElement.currentTime = percentage * this.duration;
            },
            formatTime(seconds) {
                if (isNaN(seconds)) return '0:00';
                const m = Math.floor(seconds / 60);
                const s = Math.floor(seconds % 60).toString().padStart(2, '0');
                return `${m}:${s}`;
            }
        }"
        x-init="init()"
        @play-track.window="playTrack($event.detail.url, $event.detail.title, $event.detail.band)"
        x-show="playerVisible"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-300 transform"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="fixed bottom-0 left-0 right-0 z-50 bg-uw-card border-t-4 border-uw-border p-4 shadow-[0_-8px_0_0_var(--color-border)] select-none text-uw-text font-mono"
        style="display: none;">
        
        <audio x-ref="audio" class="hidden"></audio>
        
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            
            <!-- Spectrum & Branding -->
            <div class="flex items-center gap-4 w-full md:w-auto">
                <!-- Retro Winamp Equalizer Spectrum -->
                <div class="flex items-end gap-[2px] h-8 w-20 border-2 border-uw-border p-[2px] bg-black">
                    <template x-for="i in 8">
                        <div class="w-[8px] bg-uw-accent visualizer-bar" :style="isPlaying ? '' : 'animation: none; height: 4px;'"></div>
                    </template>
                </div>
                <div>
                    <h4 class="font-serif text-sm uppercase italic leading-none font-bold text-uw-accent">NEO_WINAMP // V1.0</h4>
                    <p class="text-[9px] uppercase tracking-tighter opacity-50 mt-1">[ DECK_ACTIVE // STATUS_OK ]</p>
                </div>
            </div>

            <!-- Song Info & Progress Slider -->
            <div class="flex-grow w-full md:w-auto max-w-2xl">
                <div class="flex justify-between text-xs font-bold mb-1">
                    <span class="truncate pr-4" x-text="isPlaying ? '🔊 NOW PLAYING: ' + trackTitle + ' (BY ' + bandName + ')' : '⏹️ DECK PAUSED / STOPPED'"></span>
                    <span x-text="formatTime(currentTime) + ' / ' + formatTime(duration)"></span>
                </div>
                
                <!-- Custom Brutalist Progress Bar -->
                <div x-ref="progressBar" @click="seek($event)" class="h-6 w-full bg-black border-2 border-uw-border cursor-pointer relative overflow-hidden">
                    <div class="h-full bg-uw-accent transition-all duration-100 ease-out" :style="'width: ' + progress + '%'"></div>
                    <!-- Diagonal warning pattern on background -->
                    <div class="absolute inset-0 pointer-events-none opacity-20 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSJ0cmFuc3BhcmVudCI+PC9yZWN0Pgo8cGF0aCBkPSJMMCBMOCA4Wk04IDBMMCA4WiIgc3Ryb2tlPSIjRkZGIiBzdHJva2Utd2lkdGg9IjEiPjwvcGF0aD48L3N2Zz4=')]"></div>
                </div>
            </div>

            <!-- Arcade Controls -->
            <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                <!-- Play/Pause Button -->
                <button @click="togglePlay()" 
                    class="bg-uw-accent border-2 border-uw-border hover:bg-uw-border hover:text-uw-bg px-4 py-2 font-bold transition-none shadow-brutal-sm active:translate-x-1 active:translate-y-1 w-14 text-center"
                    :title="isPlaying ? 'PAUSE' : 'PLAY'">
                    <span x-text="isPlaying ? '||' : '►'"></span>
                </button>

                <!-- Stop Button -->
                <button @click="stopTrack()" 
                    class="bg-uw-card border-2 border-uw-border hover:bg-uw-border hover:text-uw-bg px-4 py-2 font-bold transition-none shadow-brutal-sm active:translate-x-1 active:translate-y-1 w-14 text-center"
                    title="STOP">
                    ■
                </button>

                <!-- Close Button -->
                <button @click="stopTrack(); playerVisible = false;" 
                    class="bg-red-500 text-white border-2 border-uw-border hover:bg-uw-border hover:text-uw-bg px-4 py-2 font-bold transition-none shadow-brutal-sm active:translate-x-1 active:translate-y-1 w-14 text-center"
                    title="CLOSE PLAYER">
                    X
                </button>
            </div>

        </div>
    </div>
</body>

</html>