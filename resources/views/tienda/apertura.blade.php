@extends('layouts.app')

@section('content')
<div class="apertura-wrapper">
    <header class="apertura-header">
        <h1 class="titulo-pokemon">Tus nuevas cartas de {{ ucfirst($tipo) }}</h1>
        <p class="subtitulo">Haz clic en cada carta para revelarla</p>
    </header>

    <div class="tapete-grid">
        @foreach($cartas as $carta)
            <div class="carta-container" onclick="this.classList.toggle('revelada')">
                <div class="carta-inner">
                    <div class="carta-cara trasera">
                        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Reverso">
                    </div>
                    
                    <div class="carta-cara frontal {{ $carta->tipo }} {{ Str::slug($carta->rareza) }}">
                        
                        @if($carta->es_repetida)
                            <div class="badge-repetida">
                                REPETIDA<br>+{{ $carta->reembolso }} 🪙
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
        <div class="mensaje-reembolso">
            ♻️ Has recuperado <strong>{{ $monedasReembolso }}</strong> Pokémonedas por cartas repetidas en este sobre.
        </div>
    @endif

    <div class="acciones-post-apertura">
        <a href="/sobres" class="btn-primary-tcg">ABRIR OTRO SOBRE</a>
    </div>
</div>

<style>
    /* Estilos base de la mesa de apertura */
    .apertura-wrapper {
        padding: 3rem 1.5rem;
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
        min-height: 80vh;
    }

    .apertura-header {
        margin-bottom: 3rem;
    }

    .titulo-pokemon {
        color: #ffcb05;
        text-shadow: 2px 2px 0 #3c5aa6;
        font-size: 2.5rem;
        text-transform: uppercase;
        font-weight: 900;
        margin-bottom: 0.5rem;
    }

    .subtitulo {
        color: white;
        font-size: 1.2rem;
    }

    .tapete-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
        margin: 4rem 0;
    }

    /* Contenedor y efecto 3D de la carta */
    .carta-container {
        width: 220px;
        height: 310px;
        perspective: 1000px;
        cursor: pointer;
    }

    .carta-inner {
        width: 100%;
        height: 100%;
        position: relative;
        transition: transform 0.6s cubic-bezier(0.4, 0.2, 0.2, 1);
        transform-style: preserve-3d;
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        border-radius: 12px;
    }

    /* Clase que activa el giro con JavaScript */
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

    /* --- NUEVO: MENSAJE DE REEMBOLSO TOTAL --- */
    .mensaje-reembolso {
        background: rgba(231, 76, 60, 0.15);
        border: 2px solid #e74c3c;
        color: #ffcb05;
        display: inline-block;
        padding: 15px 30px;
        border-radius: 12px;
        margin-bottom: 2rem;
        font-size: 1.2rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

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
        color: white;
        padding: 15px 30px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 900;
        font-size: 1.2rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        transition: transform 0.2s;
        display: inline-block;
    }

    .btn-primary-tcg:hover {
        transform: scale(1.05);
        background: #c0392b;
    }
</style>
@endsection