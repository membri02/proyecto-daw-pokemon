<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon TCG Project</title>
    <x-pokemon-styles />
</head>
<body>

    <x-header title="Pokémon Project DAW 2026" />
    
    <x-navbar />

    <main class="container">
        @yield('content')
    </main>

    <x-footer />

    </body>
</html>