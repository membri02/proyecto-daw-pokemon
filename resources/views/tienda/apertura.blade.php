@extends('layouts.app')

@section('content')
<div class="apertura-wrapper">
    <header class="apertura-header">
        <h1 class="titulo-pokemon">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" style="width: 38px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.4));" alt=""> 
            Tus nuevas cartas de {{ ucfirst($tipo) }} 
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" style="width: 38px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.4));" alt="">
        </h1>
        <p class="subtitulo">Haz clic en el mazo central para robar y revelar cada carta</p>
    </header>

    <div class="mesa-apertura" id="mesaApertura">
        <div id="deck-trigger" class="deck-trigger"></div>
        @foreach($cartas as $index => $carta)
            <div class="carta-container en-mazo" data-index="{{ $index }}" style="--i: {{ $index }}; z-index: {{ 10 - $index }};">
                <div class="carta-inner">
                    <!-- Reverso del sobre -->
                    <div class="carta-cara trasera">
                        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Reverso">
                    </div>
                    
                    <!-- Cara Frontal (Contiene el componente real) -->
                    <div class="carta-cara frontal">
                        @if($carta->es_repetida)
                            <div class="badge-repetida">
                                REPETIDA<br>+{{ $carta->reembolso }} <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" style="width: 14px; vertical-align: middle; margin-top: -2px;" alt="Moneda">
                            </div>
                        @endif
                        
                        <!-- Forzamos dimensiones flex limpias para el componente -->
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                            <x-pokemon-card :carta="$carta" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(isset($monedasReembolso) && $monedasReembolso > 0)
        <div class="mensaje-reembolso" id="mensajeReembolso" style="display: none; opacity: 0; transition: opacity 1s;">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" style="width: 24px; vertical-align: middle; margin-top: -4px;" alt="Reembolso"> Has recuperado <strong>{{ $monedasReembolso }}</strong> Pokémonedas por repetidas.
        </div>
    @endif

    <div class="acciones-post-apertura" id="accionesPostApertura" style="display: none; opacity: 0; transition: opacity 1s;">
        <a href="/sobres" class="btn-primary-tcg">ABRIR OTRO SOBRE</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cartas = document.querySelectorAll('.carta-container');
        const deckTrigger = document.getElementById('deck-trigger');
        const accionesPost = document.getElementById('accionesPostApertura');
        const mensajeReembolso = document.getElementById('mensajeReembolso');
        
        let cartasReveladas = 0;
        let isAnimating = false;

        if(!deckTrigger) return;

        deckTrigger.addEventListener('click', () => {
            if (isAnimating || cartasReveladas >= cartas.length) return;
            
            isAnimating = true;
            const cartaActual = cartas[cartasReveladas];
            
            cartaActual.classList.remove('en-mazo');
            cartaActual.classList.add('posicion-final');

            setTimeout(() => {
                cartaActual.classList.add('revelada');
                cartasReveladas++;
                isAnimating = false;

                if (cartasReveladas === cartas.length) {
                    deckTrigger.style.display = 'none';
                    if (mensajeReembolso) {
                        mensajeReembolso.style.display = 'inline-flex';
                        setTimeout(() => mensajeReembolso.style.opacity = '1', 100);
                    }
                    if (accionesPost) {
                        accionesPost.style.display = 'block';
                        setTimeout(() => accionesPost.style.opacity = '1', 100);
                    }
                }
            }, 600); 
        });
    });
</script>

@vite(['resources/css/apertura.css'])
@endsection