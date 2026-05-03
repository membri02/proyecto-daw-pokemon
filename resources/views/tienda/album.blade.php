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
                <div style="cursor: pointer; display: flex; justify-content: center;" onclick="abrirPokemonModal({{ $carta->pokemon_id ?? $carta->id }}, { owned: true })">
                    <x-pokemon-card :carta="$carta" />
                </div>
            @endforeach
        </div>
    @endif
    
    <x-pokemon-modal />
</div>

@vite(['resources/css/album.css'])
@endsection