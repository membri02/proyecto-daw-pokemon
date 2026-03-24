@extends('layouts.app')

@section('content')
<div class="album-wrapper">
    <header class="album-header">
        <h1 class="titulo-pokemon">Mi Colección</h1>
        <p class="subtitulo">Cartas obtenidas: <span class="badge-count">{{ $cartas->count() }}</span> <strong style="color: #1e293b; font-weight: 900;">/ 151</strong></p>
    </header>

    @if($cartas->isEmpty())
        <div class="empty-state">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokeball vacía">
            <h2>Tu álbum está vacío</h2>
            <p>Parece que aún no has abierto ningún sobre.</p>
            <a href="/sobres" class="btn-primary-tcg">IR A LA TIENDA</a>
        </div>
    @else
        <div class="binder-grid">
            @foreach($cartas as $carta)
                <div class="card-slot {{ Str::slug($carta->rareza) }}" style="cursor: pointer;" onclick="abrirPokemonModal({{ $carta->pokemon_id ?? $carta->id }}, { owned: true })">
                    <div class="card-inner">
                        <div class="card-type-badge type-{{ $carta->tipo }}">
                            {{ strtoupper($carta->tipo) }}
                        </div>
                        <img src="{{ $carta->imagen_url }}" alt="{{ $carta->nombre }}" class="pokemon-art">
                        <div class="card-info">
                            <span class="pokemon-name">{{ $carta->nombre }}</span>
                            <span class="pokemon-rarity">{{ $carta->rareza }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
    <x-pokemon-modal />
</div>

<style>
    .album-wrapper {
        padding: 3rem 1.5rem;
        max-width: 1400px; 
        margin: 0 auto;
        font-family: 'Montserrat', sans-serif;
        background: #f8fafc;
        min-height: calc(100vh - 70px);
        color: #1e293b;
        border-radius: 12px;
    }

    .album-header {
        text-align: center;
        margin-bottom: 3rem;
        border-bottom: 2px solid #3c5aa6;
        padding-bottom: 2rem;
        color: var(--text-main);
    }

    .subtitulo {
        color: #1e293b;
        font-size: 1.2rem;
        font-weight: 700;
        margin-top: 0.5rem;
    }

    .titulo-pokemon {
        font-size: 3rem;
        color: var(--text-main);
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 0.5rem;
        font-weight: 900;
        text-shadow: 2px 2px 0 var(--shadow-color);
    }

    .badge-count {
        background: #e74c3c;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        color: white;
    }

    /* Estado Vacío */
    .empty-state {
        text-align: center;
        margin-top: 5rem;
        background: var(--bg-card);
        padding: 4rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }

    .empty-state img {
        width: 100px;
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .empty-state .btn-primary-tcg {
        display: inline-block;
        margin-top: 2rem;
        text-decoration: none;
        background: #e74c3c;
        color: white;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: bold;
    }

    /* Grid del Archivador */
    .binder-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        padding: 20px;
        background: var(--bg-color);
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }

    /* 1. BASE DE LA CARTA: Borde amarillo clásico TCG */
    .card-slot {
        background: var(--bg-card);
        border-radius: 12px;
        padding: 10px;
        position: relative;
        box-shadow: 0 4px 10px var(--shadow-color);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 8px solid #fbdc15; /* EL AMARILLO MÍTICO */
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: hidden; /* Fundamental para que el brillo no se salga por los bordes */
    }

    .card-slot:hover {
        transform: translateY(-10px) scale(1.05);
        z-index: 10;
    }

    /* 2. EFECTO RARA HOLO (Brillo diagonal continuo) */
    .rara-holo {
        box-shadow: 0 0 15px rgba(72, 219, 251, 0.6);
    }
    
    .rara-holo::before {
        content: '';
        position: absolute;
        top: -100%;
        left: -100%;
        width: 50%;
        height: 300%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.6) 50%, rgba(255,255,255,0) 100%);
        transform: rotate(45deg);
        animation: brillo-holo 2.5s infinite linear;
        pointer-events: none;
        z-index: 5;
    }

    @keyframes brillo-holo {
        0% { top: -100%; left: -100%; }
        100% { top: 100%; left: 100%; }
    }

    /* 3. EFECTO LEGENDARIA (Flotación mística y aura dorada animada) */
    .legendaria {
        border-color: #ffd700;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.8), 0 0 30px rgba(255, 0, 128, 0.4);
        animation: flotar-legendaria 3s ease-in-out infinite;
    }

    .legendaria::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,215,0,0.5) 0%, rgba(255,255,255,0) 50%, rgba(255,215,0,0.5) 100%);
        z-index: 1;
        pointer-events: none;
        mix-blend-mode: overlay;
        animation: pulso-dorado 2s infinite alternate;
    }

    @keyframes flotar-legendaria {
        0%, 100% { transform: translateY(0); }
        50% { 
            transform: translateY(-12px); 
            box-shadow: 0 10px 25px rgba(255, 215, 0, 1), 0 15px 35px rgba(255, 0, 128, 0.6); 
        }
    }

    @keyframes pulso-dorado {
        0% { opacity: 0.4; }
        100% { opacity: 1; }
    }

    /* Imagen e Info de la carta */
    .pokemon-art {
        width: 120px;
        height: 120px;
        object-fit: contain;
        margin: 15px 0;
        filter: drop-shadow(0 5px 5px rgba(0,0,0,0.5));
        position: relative;
        z-index: 2;
    }
    
    .card-info {
        text-align: center;
        width: 100%;
        border-top: 1px solid var(--border-color);
        padding-top: 10px;
        position: relative;
        z-index: 2;
    }

    .pokemon-name {
        display: block;
        font-weight: 800;
        font-size: 1.1rem;
        letter-spacing: 1px;
        color: var(--text-main);
    }

    .pokemon-rarity {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-style: italic;
    }

    .card-type-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 0.7rem;
        font-weight: 900;
        padding: 3px 8px;
        border-radius: 4px;
        color: white;
        text-shadow: 1px 1px 0 rgba(0,0,0,0.5);
        text-transform: uppercase;
        z-index: 2;
    }

    /* Mini etiquetas de tipo */
    .type-fuego { background: #e74c3c; }
    .type-agua { background: #3498db; }
    .type-planta { background: #2ecc71; }
    .type-electrico { background: #f1c40f; color: black; text-shadow: none; }
    .type-psiquico { background: #9b59b6; }
    .type-normal { background: #95a5a6; }
    .type-lucha { background: #c0392b; }
    .type-veneno { background: #8e44ad; }
    .type-tierra { background: #d35400; }
    .type-roca { background: #7f8c8d; }
    .type-bicho { background: #27ae60; }
    .type-fantasma { background: #2c3e50; }
    .type-dragon { background: #e67e22; }
    .type-hielo { background: #bdc3c7; color: black; text-shadow: none; }
</style>
@endsection