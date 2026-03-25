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

<style>
    /* Estilos base de la mesa de apertura */
    .apertura-wrapper {
        padding: 3rem 5rem; /* Padding horizontal más generoso */
        max-width: 1400px;
        margin: 0 auto;
        text-align: center;
        min-height: 80vh;
        /* Se eliminó overflow: hidden para evitar que las cartas extremas se corten */
        background-color: #f8fafc;
    }

    .apertura-header { margin-bottom: 3rem; }
    .titulo-pokemon { color: #1e293b; font-size: 2.5rem; font-weight: 900; margin-bottom: 0.5rem; display: flex; justify-content: center; align-items: center; gap: 15px; }
    .subtitulo { color: #475569; font-size: 1.2rem; }

    /* --- EL MAZO Y LA MESA CENTRAL --- */
    .mesa-apertura {
        position: relative;
        height: 700px; /* Suficiente espacio extendido para el despliegue vertical */
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 2rem auto 4rem;
        max-width: 1200px;
        padding: 0 4rem; /* Espacio para respirar a los costados */
    }

    .deck-trigger {
        position: absolute;
        width: 250px;
        height: 350px;
        z-index: 100;
        cursor: pointer;
        top: calc(50% - 175px);
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Contenedor dinámico de la carta */
    .carta-container {
        position: absolute;
        width: 250px;
        height: 350px;
        perspective: 1000px;
        transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        transform-origin: center center;
    }

    .carta-container.en-mazo {
        /* Desalineamos para sensación física */
        transform: translate(calc(var(--i) * -2px + 5px), calc(var(--i) * -2px - 150px)) rotate(calc(var(--i) * 1.5deg - 3deg));
        box-shadow: -2px 2px 5px rgba(0,0,0,0.3);
    }

    .carta-container.posicion-final {
    /* Ese 190px las empujará un poco más hacia abajo alejándolas del mazo */
    transform: translate(calc((var(--i) - 2) * 260px), 190px) rotate(0deg);
    z-index: var(--i) !important;
}

    .carta-inner {
        width: 100%;
        height: 100%;
        position: relative;
        transition: transform 0.6s cubic-bezier(0.4, 0.2, 0.2, 1);
        transform-style: preserve-3d;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
    }

    .carta-container.revelada .carta-inner {
        transform: rotateY(180deg) scale(1.05);
        box-shadow: 0 15px 35px rgba(0,0,0,0.7);
    }

    /* Caras de la carta */
    .carta-cara {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Diseño del Reverso */
    .trasera {
        background: radial-gradient(circle, #2a75bb 0%, #1a4b77 100%);
        border: 10px solid #ffcb05;
    }
    .trasera img { width: 80px; opacity: 0.8; }

    /* Diseño del Frontal abstracto (Lo gestiona el componente x-pokemon-card interno) */
    .frontal {
        transform: rotateY(180deg);
        background: transparent;
        z-index: 2;
    }

    /* --- ESTILO DE LA PEGATINA DE REPETIDA --- */
    .badge-repetida {
        position: absolute;
        top: -15px;
        right: -15px;
        background: #e74c3c;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 900;
        font-size: 0.85rem;
        z-index: 100;
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        transform: rotate(15deg);
        border: 3px solid #fff;
        text-align: center;
        line-height: 1.2;
    }

    .mensaje-reembolso {
        background: #f8fafc;
        border: 2px solid #10b981;
        color: #1e293b;
        padding: 1rem 2rem;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin-top: 1rem;
        font-size: 1.1rem;
    }
    .mensaje-reembolso strong { color: #10b981; font-weight: 900; font-size: 1.3rem; }

    /* Botón de volver */
    .acciones-post-apertura {
        margin-top: 1rem;
    }

    .btn-primary-tcg {
        background: #e74c3c;
        color: #ffffff;
        padding: 15px 30px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 900;
        font-size: 1.2rem;
        border: 1px solid #b91c1c;
        transition: transform 0.2s, background 0.2s;
        display: inline-block;
    }
    .btn-primary-tcg:hover { transform: scale(1.05); background: #c0392b; }
</style>
@endsection