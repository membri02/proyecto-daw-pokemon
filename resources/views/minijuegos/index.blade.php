@extends('layouts.app')

@section('content')
    @vite(['resources/css/minijuegos.css'])

    <div class="hub-background"></div>

    <div class="container mx-auto px-4">
        <h1 class="hub-title">Centro de Entretenimiento Pokémon</h1>
        
        <div class="games-grid" id="hubCarousel">
            
            <!-- Tarjeta: Silueta Pokémon -->
            <div class="game-card" onclick="window.location.href='{{ route('minijuego.silueta') }}'">
                <div class="card-image-wrapper">
                    <!-- Decoración usando una imagen representativa -->
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png" alt="Adivina el Pokémon" style="filter: brightness(0) invert(1); opacity: 0.8;">
                </div>
                <div class="card-content">
                    <div>
                        <h2 class="card-title">¿Quién es ese Pokémon?</h2>
                        <p class="card-desc">Pon a prueba tu conocimiento adivinando la silueta del Pokémon misterioso. Un clásico infalible.</p>
                    </div>
                    <div>
                        <div class="card-stats">
                            <span class="cost">Coste: 0 <i class="fas fa-coins"></i></span>
                            <span class="reward">Premio: 50 <i class="fas fa-coins"></i></span>
                        </div>
                        <a href="{{ route('minijuego.silueta') }}" class="btn-play">¡Jugar ahora!</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Triler de Pokéballs -->
            <div class="game-card" onclick="window.location.href='{{ route('minijuego.triler') }}'">
                <div class="card-image-wrapper">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Triler de Pokéballs" style="image-rendering: pixelated; transform: scale(2);">
                </div>
                <div class="card-content">
                    <div>
                        <h2 class="card-title">El Triler Voltorb</h2>
                        <p class="card-desc">Sigue la Pokéball correcta que esconde a Pikachu. ¡Cuidado con elegir la que tiene al Voltorb explosivo!</p>
                    </div>
                    <div>
                        <div class="card-stats">
                            <span class="cost">Coste: 10 <i class="fas fa-coins"></i></span>
                            <span class="reward">Premio: 30 <i class="fas fa-coins"></i></span>
                        </div>
                        <a href="{{ route('minijuego.triler') }}" class="btn-play">¡Jugar ahora!</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Duelo de Tipos -->
            <div class="game-card" onclick="window.location.href='{{ route('minijuego.duelo') }}'">
                <div class="card-image-wrapper">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/493.png" alt="Duelo Arceus">
                </div>
                <div class="card-content">
                    <div>
                        <h2 class="card-title">Duelo de Tipos</h2>
                        <p class="card-desc">Demuestra que eres un maestro estratégico. Elige el tipo súper efectivo antes de que se acabe el tiempo.</p>
                    </div>
                    <div>
                        <div class="card-stats">
                            <span class="cost">Coste: 20 <i class="fas fa-coins"></i></span>
                            <span class="reward">Premio: 100 <i class="fas fa-coins"></i></span>
                        </div>
                        <a href="{{ route('minijuego.duelo') }}" class="btn-play">¡Jugar ahora!</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Memoria Pokémon -->
            <div class="game-card" onclick="window.location.href='{{ route('minijuego.memoria') }}'">
                <div class="card-image-wrapper">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/54.png" alt="Psyduck Memoria">
                </div>
                <div class="card-content">
                    <div>
                        <h2 class="card-title">Memoria de Psyduck</h2>
                        <p class="card-desc">Encuentra todas las parejas de cartas en este panel de 12 cartas antes de quedarte sin intentos.</p>
                    </div>
                    <div>
                        <div class="card-stats">
                            <span class="cost">Coste: 15 <i class="fas fa-coins"></i></span>
                            <span class="reward">Premio: 80 <i class="fas fa-coins"></i></span>
                        </div>
                        <a href="{{ route('minijuego.memoria') }}" class="btn-play">¡Jugar ahora!</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
