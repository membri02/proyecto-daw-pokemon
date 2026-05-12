<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Proyecto TCG DAW</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <x-pokemon-styles />
</head>
<body style="background-color: var(--bg-color); color: var(--text-main); margin: 0; padding: 0;">

    <x-header title="Pokémon TFG Proyecto DAW 2026" />
    
    <x-navbar />

    <x-pika-guide />

    <main class="container">
        @yield('content')
    </main>

    <x-footer />

    </body>
</html>