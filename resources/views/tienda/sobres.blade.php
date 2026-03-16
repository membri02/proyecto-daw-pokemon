@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/sobres.css') }}">

    <div class="tienda-header" style="text-align: center; margin-bottom: 2rem;">
        <h1>Tienda de Cartas Pokémon</h1>
        <p>¡Compra tu sobre y descubre qué Pokémon te toca!</p>
    </div>
    
    <div class="sobres-container">
        <div class="sobre fuego">
            Sobre Fuego<br>
            <small>Apasionado y ardiente</small>
        </div>
        <div class="sobre agua">
            Sobre Agua<br>
            <small>Calma y fluidez</small>
        </div>
        <div class="sobre planta">
            Sobre Planta<br>
            <small>Natural y renovador</small>
        </div>
        <div class="sobre electrico">
            Sobre Eléctrico<br>
            <small>Vibrante y energético</small>
        </div>
        <div class="sobre hielo">
            Sobre Hielo<br>
            <small>Frío y preciso</small>
        </div>
        <div class="sobre dark">
            Sobre Oscuro<br>
            <small>Misterioso y profundo</small>
        </div>
        <div class="sobre psycho">
            Sobre Psíquico<br>
            <small>Enigmático y sabio</small>
        </div>
    </div>

    <div style="text-align: center; margin-top: 2rem;">
        <button class="primary">Abrir sobre (Próximamente)</button>
        <br><br>
        <a class="back-link" href="/">Volver al inicio</a>
    </div>
@endsection