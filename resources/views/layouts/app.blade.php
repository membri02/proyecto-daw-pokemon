<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon TCG Project</title>
    <!-- CORE THEME SCRIPT (Evita FOUC Tema Claro/Oscuro al instante) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('pokemon-theme');
            const prefersLight = window.matchMedia('(prefers-color-scheme: light)').matches;
            if (savedTheme === 'light' || (!savedTheme && prefersLight)) {
                document.documentElement.classList.add('light-theme');
            }
        })();
    </script>
    <x-pokemon-styles />
</head>
<body style="background-color: var(--bg-color); color: var(--text-main); transition: background-color 0.3s ease, color 0.3s ease; margin: 0; padding: 0;">

    <x-header title="Pokémon Project DAW 2026" />
    
    <x-navbar />

    {{-- Pika-Guide must be before @yield so window.pikaGuide is defined before page scripts --}}
    <x-pika-guide />

    <main class="container">
        @yield('content')
    </main>

    <x-footer />

    </body>
</html>