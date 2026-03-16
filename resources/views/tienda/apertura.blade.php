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
                    
                    <div class="carta-cara frontal {{ $carta->tipo }}">
                        <div class="carta-brillo"></div>
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
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        border-radius: 12px;
    }

    /* Clase que activa el giro con JavaScript */
    .carta-container.revelada .carta-inner {
        transform: rotateY(180deg) scale(1.05);
        box-shadow: 0 15px 30px rgba(0,0,0,0.4);
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
        overflow: hidden;
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

    /* Diseño del Frontal */
    .frontal {
        transform: rotateY(180deg);
        background: #fff;
        border: 8px solid #ddd;
    }
    
    .pokemon-art {
        width: 80%;
        height: 140px;
        object-fit: contain;
        margin-top: 1rem;
        filter: drop-shadow(0 5px 5px rgba(0,0,0,0.3));
    }

    .carta-info {
        margin-top: auto;
        width: 100%;
        padding: 15px;
        background: rgba(255,255,255,0.9);
        border-top: 2px solid #eee;
    }

    .carta-info h3 {
        margin: 0 0 5px 0;
        font-size: 1.2rem;
        color: #333;
    }

    .rareza-badge {
        font-size: 0.8rem;
        font-weight: bold;
        color: #666;
        text-transform: uppercase;
    }

    /* Colores dinámicos para los bordes según el tipo */
    .frontal.fuego { border-color: #e74c3c; background: linear-gradient(180deg, #fadbd8, #fff); }
    .frontal.agua { border-color: #3498db; background: linear-gradient(180deg, #d6eaf8, #fff); }
    .frontal.planta { border-color: #2ecc71; background: linear-gradient(180deg, #d5f5e3, #fff); }
    
    /* Botón de volver */
    .acciones-post-apertura {
        margin-top: 3rem;
    }
</style>
@endsection