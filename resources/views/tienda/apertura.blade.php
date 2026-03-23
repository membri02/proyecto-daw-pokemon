@extends('layouts.app')

@section('content')
<div class="apertura-wrapper" style="background-color: var(--bg-color); max-width: 1400px; margin: 0 auto; text-align: center; min-height: 100vh; display: block; overflow: hidden; padding: 3rem 5rem;">
    <div id="flash-overlay"></div>

    <header class="apertura-header">
        <h1 class="titulo-pokemon"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" class="icono-moneda-inline" alt="Title"> Tus nuevas cartas de {{ ucfirst($tipo) }} <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" class="icono-moneda-inline" alt="Title"></h1>
        <p class="subtitulo">Haz clic en el mazo central para robar y revelar cada carta</p>
    </header>

    <div class="mesa-apertura" id="mesaApertura">
        <div id="deck-trigger" class="deck-trigger"></div>
        @foreach($cartas as $index => $carta)
            <div class="carta-container en-mazo" data-index="{{ $index }}" style="--i: {{ $index }}; z-index: {{ 10 - $index }};">
                <div class="carta-inner">
                    <div class="carta-cara trasera">
                        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Reverso">
                    </div>
                    
                    <div class="carta-cara frontal {{ $carta->tipo }} {{ Str::slug($carta->rareza) }}">
                        
                        @if($carta->es_repetida)
                            <div class="badge-repetida">
                                REPETIDA<br>+{{ $carta->reembolso }} <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" style="width: 14px; vertical-align: middle; margin-top: -2px;" alt="Moneda">
                            </div>
                        @endif

                        <img src="{{ $carta->imagen_url }}" alt="{{ $carta->nombre }}" class="pokemon-art">
                        <div class="carta-info">
                            <h3>{{ $carta->nombre }}</h3>
                            <span class="rareza-badge">{{ $carta->rareza }}</span>
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

        deckTrigger.addEventListener('click', () => {
            if (isAnimating || cartasReveladas >= cartas.length) return;
            
            isAnimating = true;
            // Robar la carta de arriba (la de índice actual basado en el progreso)
            const cartaActual = cartas[cartasReveladas];
            
            // 1. Mover la carta a su posición en la fila
            cartaActual.classList.remove('en-mazo');
            cartaActual.classList.add('posicion-final');

            // Efecto de sonido (opcional mental, reemplazado por la kinestésica de la animación)

            // 2. Esperar a que la traslación termine (600ms) y voltearla
            setTimeout(() => {
                cartaActual.classList.add('revelada');

                cartasReveladas++;
                isAnimating = false;

                // 3. Comprobar si hemos terminado el mazo
                if (cartasReveladas === cartas.length) {
                    deckTrigger.style.display = 'none';
                    if (mensajeReembolso) {
                        mensajeReembolso.style.display = 'inline-block';
                        setTimeout(() => mensajeReembolso.style.opacity = '1', 100);
                    }
                    accionesPost.style.display = 'block';
                    setTimeout(() => accionesPost.style.opacity = '1', 100);
                }
            }, 600); 
        });
    });
</script>

<style>
    /* --- DESTELLO INICIAL --- */
    #flash-overlay {
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        background: #fff;
        z-index: 9999;
        pointer-events: none;
        animation: fadeOutFlash 1.5s ease-out forwards;
    }

    @keyframes fadeOutFlash {
        0% { opacity: 1; }
        100% { opacity: 0; visibility: hidden; }
    }

    /* Estilos base de la mesa de apertura */
    .apertura-wrapper {
        padding: 3rem 5rem; /* Margen limpio horizontal para que respiren */
        max-width: 1400px;
        margin: 0 auto;
        text-align: center;
        min-height: 80vh;
        overflow: hidden; /* Evita scroll inútil con la animación */
    }

    .apertura-header {
        margin-bottom: 3rem;
        position: relative;
        z-index: 100;
    }

    .titulo-pokemon {
        color: var(--text-main);
        text-shadow: 2px 2px 0px var(--shadow-color);
        font-size: 2.5rem;
        text-transform: uppercase;
        font-weight: 900;
        margin-bottom: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
    }

    .icono-moneda-inline {
        width: 38px;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.4));
    }

    .subtitulo {
        color: var(--text-muted);
        font-size: 1.2rem;
    }

    /* --- EL MAZO Y LA MESA CENTRAL --- */
    .mesa-apertura {
        position: relative;
        height: 660px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 2rem auto 4rem;
        max-width: 1400px;
    }

    .deck-trigger {
        position: absolute;
        width: 220px;
        height: 310px;
        z-index: 100;
        cursor: pointer;
        border-radius: 12px;
        top: calc(50% - 140px);
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .deck-trigger:hover ~ .carta-container.en-mazo {
        filter: drop-shadow(0 0 15px rgba(255, 203, 5, 0.4));
    }

    .deck-trigger:active ~ .carta-container.en-mazo {
        transform: translate(calc(var(--i) * -1.5px + 3px), calc(var(--i) * -2px - 136px)) scale(0.98);
    }

    /* Contenedor y efecto dinámico de la carta */
    .carta-container {
        position: absolute;
        width: 220px;
        height: 310px;
        perspective: 1000px;
        transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), filter 0.3s;
        transform-origin: center center;
    }

    .carta-container.en-mazo {
        /* Desalineamos el mazo ligeramente para hacerlo físico */
        transform: translate(calc(var(--i) * -1.5px + 3px), calc(var(--i) * -2px - 140px)) rotate(calc(var(--i) * 1.5deg - 3deg));
        box-shadow: -2px 2px 5px rgba(0,0,0,0.3);
    }

    .carta-container.posicion-final {
        /* Abanico en fila recortado a 210px para evitar que choquen con el borde */
        transform: translate(calc((var(--i) - 2) * 210px), 180px) rotate(0deg);
        z-index: var(--i) !important;
    }

    .carta-inner {
        width: 100%;
        height: 100%;
        position: relative;
        /* Reducimos el tiempo del tirón para que sea ágil */
        transition: transform 0.6s cubic-bezier(0.4, 0.2, 0.2, 1);
        transform-style: preserve-3d;
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        border-radius: 12px;
    }

    /* Clase que activa el giro con JavaScript UNA VEZ EN SU POSICION */
    .carta-container.revelada .carta-inner {
        transform: rotateY(180deg) scale(1.08);
        box-shadow: 0 15px 35px rgba(0,0,0,0.7);
    }

    /* --- NUEVO: MENSAJE DE REEMBOLSO TOTALMENTE REFORMADO (AAA CONTRAST) --- */
    .mensaje-reembolso {
        background: var(--bg-color); /* Fondo emparejado con exterior del tapete */
        border: 2px solid #10b981; /* Borde firme esmeralda */
        color: var(--text-main); /* Texto Principal Dinamico */
        padding: 1rem 2rem;
        border-radius: 8px;
        box-shadow: none; /* Prohibido usar sombras difuminadas */
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin-top: 1rem;
        font-size: 1.1rem;
    }
    .mensaje-reembolso strong {
        color: #10b981; /* Verde Esmeralda intenso sobre fondo oscuro = AAA */
        font-weight: 900;
        font-size: 1.3rem;
    }

    /* --- RESPONSIVE ESCALADO DEL MAZO --- */
    /* Garantiza que no se corten las cartas en laptops o móviles */
    @media (max-width: 1200px) {
        .apertura-wrapper { padding: 3rem 2rem; }
        .mesa-apertura { transform: scale(0.85); transform-origin: top center; height: 500px; }
    }
    @media (max-width: 900px) {
        .apertura-wrapper { padding: 3rem 1rem; }
        .mesa-apertura { transform: scale(0.65); transform-origin: top center; height: 400px; }
    }
    @media (max-width: 600px) {
        .apertura-wrapper { padding: 2rem 0.5rem; }
        .mesa-apertura { transform: scale(0.45); transform-origin: top center; height: 300px; margin-bottom: 2rem; }
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
        overflow: hidden; /* Muy importante para que los brillos no se salgan */
    }

    /* Diseño del Reverso */
    .trasera {
        background: radial-gradient(circle, #2a75bb 0%, #1a4b77 100%);
        border: 10px solid #ffcb05;
    }
    .trasera img {
        width: 60px;
        opacity: 0.8;
    }

    /* Diseño del Frontal (Borde amarillo clásico) */
    .frontal {
        transform: rotateY(180deg);
        background: #fff;
        border: 8px solid #fbdc15; /* EL AMARILLO TCG */
        position: relative;
    }
    
    .pokemon-art {
        width: 80%;
        height: 140px;
        object-fit: contain;
        margin-top: 1rem;
        filter: drop-shadow(0 5px 5px rgba(0,0,0,0.3));
        position: relative;
        z-index: 2; /* Para que quede por encima de los brillos */
    }

    .carta-info {
        margin-top: auto;
        width: 100%;
        padding: 15px;
        background: rgba(255,255,255,0.95);
        border-top: 2px solid #ddd;
        position: relative;
        z-index: 2; /* Para que quede por encima de los brillos */
    }

    .carta-info h3 {
        margin: 0 0 5px 0;
        font-size: 1.2rem;
        color: #333;
        font-weight: 800;
    }

    .rareza-badge {
        font-size: 0.8rem;
        font-weight: bold;
        color: #666;
        text-transform: uppercase;
    }

    /* --- NUEVO: ESTILO DE LA PEGATINA DE REPETIDA --- */
    .badge-repetida {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #e74c3c;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 900;
        font-size: 0.9rem;
        z-index: 10; /* Para que quede por encima de todo */
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        transform: rotate(15deg);
        border: 3px solid #fff;
        text-align: center;
        line-height: 1.2;
        text-shadow: 1px 1px 0 rgba(0,0,0,0.3);
    }

    /* SUPRIMIDO: CLASE DUPLICADA MENSAJE DE REEMBOLSO CON TEXTO AMARILLO */

    /* --- EFECTOS MÁGICOS (Holo y Legendaria) --- */

    /* Rara Holo: Brillo diagonal cruzando la carta */
    .frontal.rara-holo::before {
        content: '';
        position: absolute;
        top: -100%;
        left: -100%;
        width: 50%;
        height: 300%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(72, 219, 251, 0.4) 50%, rgba(255,255,255,0) 100%);
        transform: rotate(45deg);
        animation: brillo-holo 2s infinite linear;
        pointer-events: none;
        z-index: 1; /* Detrás del Pokémon pero encima del fondo */
    }

    @keyframes brillo-holo {
        0% { top: -100%; left: -100%; }
        100% { top: 100%; left: 100%; }
    }

    /* Legendaria: Pulso dorado y borde especial */
    .frontal.legendaria {
        border-color: #ffd700;
        box-shadow: inset 0 0 30px rgba(255, 215, 0, 0.5); /* Brillo interior */
    }

    .frontal.legendaria::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,215,0,0.6) 0%, rgba(255,255,255,0) 50%, rgba(255,0,128,0.3) 100%);
        z-index: 1;
        pointer-events: none;
        mix-blend-mode: color-burn;
        animation: pulso-dorado 2s infinite alternate;
    }

    @keyframes pulso-dorado {
        0% { opacity: 0.3; }
        100% { opacity: 0.8; }
    }

    /* Colores dinámicos para los fondos según el tipo (Suavizados para que destaquen las cartas) */
    .frontal.fuego { background: linear-gradient(180deg, #fdedec, #fff); }
    .frontal.agua { background: linear-gradient(180deg, #ebf5fb, #fff); }
    .frontal.planta { background: linear-gradient(180deg, #eafaf1, #fff); }
    .frontal.electrico { background: linear-gradient(180deg, #fef9e7, #fff); }
    .frontal.psiquico { background: linear-gradient(180deg, #f5eef8, #fff); }
    .frontal.normal { background: linear-gradient(180deg, #f2f3f4, #fff); }
    .frontal.lucha { background: linear-gradient(180deg, #f5b041, #fff); }
    .frontal.veneno { background: linear-gradient(180deg, #d2b4de, #fff); }
    .frontal.tierra { background: linear-gradient(180deg, #edbb99, #fff); }
    .frontal.roca { background: linear-gradient(180deg, #d5d8dc, #fff); }
    .frontal.bicho { background: linear-gradient(180deg, #a9dfbf, #fff); }
    .frontal.fantasma { background: linear-gradient(180deg, #aeb6bf, #fff); }
    .frontal.dragon { background: linear-gradient(180deg, #f5cba7, #fff); }
    .frontal.hielo { background: linear-gradient(180deg, #d6eaf8, #fff); }

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
        border: 1px solid #b91c1c; /* Removida sombra blanda, añadido contorno recio */
        box-shadow: none; /* Regla de Oro implementada */
        transition: transform 0.2s, background 0.2s;
        display: inline-block;
    }

    .btn-primary-tcg:hover {
        transform: scale(1.05);
        background: #c0392b;
    }
</style>
@endsection