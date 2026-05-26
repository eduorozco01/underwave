<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UnderWave - El Sonido Underground</title>

    <!-- Theme Initialization to prevent flash of unstyled content -->
    <script>
        const theme = localStorage.getItem('theme') || 'fanzine';
        if (theme !== 'fanzine') {
            document.documentElement.setAttribute('data-theme', theme);
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Syne:wght@400..800&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-mono antialiased bg-uw-bg text-uw-text overflow-hidden selection:bg-uw-accent selection:text-black">
    
    <!-- Decorative Grid Background -->
    <div class="fixed inset-0 z-0 pointer-events-none opacity-20" style="background-image: radial-gradient(var(--color-border) 2px, transparent 2px); background-size: 30px 30px;"></div>

    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center p-6">
        
        <!-- Main Logo / Title -->
        <div class="mb-12 relative group cursor-default">
            <h1 class="font-serif font-black text-6xl md:text-8xl lg:text-[10rem] uppercase tracking-tighter text-uw-text bg-uw-accent px-6 py-2 border-8 border-uw-border shadow-[12px_12px_0px_0px_var(--color-border)] transform -rotate-3 transition-transform duration-300 group-hover:rotate-0 group-hover:scale-105">
                UnderWave
            </h1>
            <div class="absolute -bottom-6 -right-6 bg-uw-card border-4 border-uw-border px-4 py-2 text-xl font-bold transform rotate-6 shadow-brutal-sm">
                BETA_V1
            </div>
        </div>

        <p class="font-bold text-xl md:text-2xl text-center max-w-2xl bg-uw-card border-4 border-uw-border p-6 shadow-brutal mb-12">
            El ecosistema definitivo para bandas emergentes, fanzines autoeditados y el sonido que no suena en la radio. 
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-8 w-full max-w-xl justify-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto text-center font-black text-2xl bg-uw-accent text-black border-4 border-uw-border py-4 px-8 shadow-[8px_8px_0px_0px_var(--color-border)] hover:bg-uw-border hover:text-uw-accent hover:translate-x-2 hover:translate-y-2 hover:shadow-none transition-all">
                        >>> IR AL RADAR
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto text-center font-black text-2xl bg-uw-card text-uw-text border-4 border-uw-border py-4 px-8 shadow-[8px_8px_0px_0px_var(--color-border)] hover:bg-uw-border hover:text-uw-bg hover:translate-x-2 hover:translate-y-2 hover:shadow-none transition-all">
                        [ LOGIN ]
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full sm:w-auto text-center font-black text-2xl bg-uw-accent text-black border-4 border-uw-border py-4 px-8 shadow-[8px_8px_0px_0px_var(--color-border)] hover:bg-uw-border hover:text-uw-accent hover:translate-x-2 hover:translate-y-2 hover:shadow-none transition-all">
                            REGISTRO ->
                        </a>
                    @endif
                @endauth
            @endif
        </div>

        <!-- Decorative Footer -->
        <div class="absolute bottom-6 left-6 font-bold text-xs opacity-50">
            SYS_CORE: ONLINE // SEVILLA_NODE
        </div>
        <div class="absolute bottom-6 right-6 font-bold text-xs opacity-50">
            [ EST. 2026 ]
        </div>
    </div>
</body>
</html>
