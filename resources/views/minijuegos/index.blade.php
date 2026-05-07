@extends('layouts.app')

@section('content')
    @vite(['resources/css/minijuegos.css'])

    <div class="hub-background"></div>

    <div class="container mx-auto px-4">
        <h1 class="hub-title">Centro de Entretenimiento Pokémon</h1>
        
        <div class="games-grid grid items-stretch" id="hubCarousel">
            
            <!-- Tarjeta: Silueta Pokémon -->
            @guest
            <div class="game-card h-full flex flex-col" onclick="if(window.pikaGuide) window.pikaGuide.showGuestMessage('¡Pika-pika! ⚡ ¡Debes iniciar sesión para jugar a los minijuegos y ganar monedas!');">
            @else
            <div class="game-card h-full flex flex-col" onclick="window.location.href='{{ route('minijuego.silueta') }}'">
            @endguest
                <div class="card-image-wrapper">
                    <!-- Decoración usando una imagen representativa -->
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png" alt="Adivina el Pokémon" style="filter: brightness(0) invert(1); opacity: 0.8;">
                </div>
                <div class="card-content flex-grow flex flex-col justify-between p-6">
                    <div class="flex-grow">
                        <h2 class="card-title">¿Quién es ese Pokémon?</h2>
                        <p class="card-desc">Pon a prueba tu conocimiento adivinando la silueta del Pokémon misterioso. ¿Podrás acertar su nombre?</p>
                    </div>
                    <div class="card-stats">
                        <span class="cost">Coste: 0 <i class="fas fa-coins"></i></span>
                        <span class="reward">Premio: 50 <i class="fas fa-coins"></i></span>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Triler de Pokéballs -->
            @guest
            <div class="game-card h-full flex flex-col" onclick="if(window.pikaGuide) window.pikaGuide.showGuestMessage('¡Pika-pika! ⚡ ¡Debes iniciar sesión para jugar a los minijuegos y ganar monedas!');">
            @else
            <div class="game-card h-full flex flex-col" onclick="window.location.href='{{ route('minijuego.triler') }}'">
            @endguest
                <div class="card-image-wrapper">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Triler de Pokéballs" style="image-rendering: pixelated; transform: scale(2);">
                </div>
                <div class="card-content flex-grow flex flex-col justify-between p-6">
                    <div class="flex-grow">
                        <h2 class="card-title">El Triler Voltorb</h2>
                        <p class="card-desc">Sigue la Pokéball correcta que esconde a Pikachu. ¡Evita a toda costa elegir al peligroso Voltorb!</p>
                    </div>
                    <div class="card-stats">
                        <span class="cost">Coste: 10 <i class="fas fa-coins"></i></span>
                        <span class="reward">Premio: 30 <i class="fas fa-coins"></i></span>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Duelo de Tipos -->
            @guest
            <div class="game-card h-full flex flex-col" onclick="if(window.pikaGuide) window.pikaGuide.showGuestMessage('¡Pika-pika! ⚡ ¡Debes iniciar sesión para jugar a los minijuegos y ganar monedas!');">
            @else
            <div class="game-card h-full flex flex-col" onclick="window.location.href='{{ route('minijuego.duelo') }}'">
            @endguest
                <div class="card-image-wrapper">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/493.png" alt="Duelo Arceus" style="width: 100%; height: 130%; object-fit: cover; object-position: top center;">
                </div>
                <div class="card-content flex-grow flex flex-col justify-between p-6">
                    <div class="flex-grow">
                        <h2 class="card-title">Duelo de Tipos</h2>
                        <p class="card-desc">Demuestra que eres un maestro estratégico en este desafío. Elige el tipo súper efectivo correcto contra tu rival antes de que se agote el tiempo y hazte con la victoria.</p>
                    </div>
                    <div class="card-stats">
                        <span class="cost">Coste: 20 <i class="fas fa-coins"></i></span>
                        <span class="reward">Premio: 100 <i class="fas fa-coins"></i></span>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Memoria Pokémon -->
            @guest
            <div class="game-card h-full flex flex-col" onclick="if(window.pikaGuide) window.pikaGuide.showGuestMessage('¡Pika-pika! ⚡ ¡Debes iniciar sesión para jugar a los minijuegos y ganar monedas!');">
            @else
            <div class="game-card h-full flex flex-col" onclick="window.location.href='{{ route('minijuego.memoria') }}'">
            @endguest
                <div class="card-image-wrapper">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/54.png" alt="Psyduck Memoria">
                </div>
                <div class="card-content flex-grow flex flex-col justify-between p-6">
                    <div class="flex-grow">
                        <h2 class="card-title">Memoria de Psyduck</h2>
                        <p class="card-desc">Encuentra todas las parejas de cartas en este panel de 12 cartas antes de que se agoten tus intentos.</p>
                    </div>
                    <div class="card-stats">
                        <span class="cost">Coste: 15 <i class="fas fa-coins"></i></span>
                        <span class="reward">Premio: 80 <i class="fas fa-coins"></i></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
