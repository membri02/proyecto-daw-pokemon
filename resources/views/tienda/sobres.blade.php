@extends('layouts.app')

@section('content')
    @vite(['resources/css/sobres.css'])
    
    <div class="tienda-wrapper">
        <header class="tienda-header">
            <h1 class="titulo-pokemon">Poké-Tienda Oficial</h1>
            <p class="subtitulo">Adquiere potenciadores y expande tu colección de cartas digitales</p>
        </header>

        <section class="introduccion-section">
            <div class="intro-card">
                <h2>Guía de Adquisición de Potenciadores</h2>
                <div class="intro-grid">
                    <div class="intro-item">
                        <div class="intro-marker">1</div>
                        <div>
                            <strong>Divisa del Juego</strong>
                            <p>Utiliza las Pokémonedas obtenidas en combate para adquirir nuevos sobres. El coste estándar es de 100 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" class="icono-moneda-inline" alt="Moneda"> por unidad.</p>
                        </div>
                    </div>
                    <div class="intro-item">
                        <div class="intro-marker">2</div>
                        <div>
                            <strong>Contenido del Paquete</strong>
                            <p>Cada sobre de mejora contiene 5 cartas aleatorias. Se garantiza al menos una carta de rareza 'Infrecuente' o superior por paquete.</p>
                        </div>
                    </div>
                    <div class="intro-item">
                        <div class="intro-marker">3</div>
                        <div>
                            <strong>Gestión de Mazo</strong>
                            <p>Las cartas adquiridas se añadirán automáticamente a tu colección. Visita el editor de mazos para integrar tus nuevas adquisiciones.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="sobres-grid">
            @php
                $tipos = [
                    ['fuego', 'Set Fuego', 'Llamas Eternas', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png'], 
                    ['agua', 'Set Agua', 'Mareas Profundas', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png'], 
                    ['planta', 'Set Planta', 'Selva Ancestral', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png'], 
                    ['electrico', 'Set Eléctrico', 'Tormenta Voltio', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png'], 
                    ['hielo', 'Set Hielo', 'Cero Absoluto', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/144.png'], 
                    ['lucha', 'Set Lucha', 'Puño K.O.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/68.png'], 
                    ['veneno', 'Set Veneno', 'Espora Tóxica', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/94.png'], 
                    ['tierra', 'Set Tierra', 'Falla Sísmica', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/112.png'], 
                    ['volador', 'Set Volador', 'Cielo raudo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/18.png'], 
                    ['psiquico', 'Set Psíquico', 'Mente Maestra', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png'], 
                    ['bicho', 'Set Bicho', 'Enjambre Voraz', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/123.png'], 
                    ['roca', 'Set Roca', 'Muro Épico', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/76.png'], 
                    ['fantasma', 'Set Fantasma', 'Alma Espectral', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/93.png'], 
                    ['dragon', 'Set Dragón', 'Ira Dracónica', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/149.png'], 
                    ['siniestro', 'Set Siniestro', 'Luna Negra', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/197.png'], 
                    ['acero', 'Set Acero', 'Metal Blindado', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/208.png'], 
                    ['hada', 'Set Hada', 'Luz Mágica', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/36.png'], 
                    ['normal', 'Set Normal', 'Impacto Base', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/143.png'] 
                ];
            @endphp

            @foreach($tipos as $tipo)
                <div class="booster-pack-wrapper {{ $tipo[0] }}">
                    <div class="pack-crimp top"></div>
                    
                    <div class="pack-inner">
                        <div class="pack-foil-texture"></div>
                        <div class="pack-shine"></div>
                        
                        <img src="{{ $tipo[3] }}" alt="Representación de {{ $tipo[1] }}" class="pack-art-image">
                        
                        <div class="pack-footer-info">
                            <span class="pack-set-name">{{ $tipo[1] }}</span>
                            <small class="pack-expansion-name">{{ $tipo[2] }}</small>
                            <span class="pack-card-count">5 CARTAS</span>
                        </div>
                    </div>
                    
                    <div class="pack-crimp bottom"></div>
                </div>
            @endforeach
        </div>

        <div class="tienda-action-bar">
            <button class="btn-primary-tcg">
                SOLICITAR APERTURA (100 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" class="icono-moneda-btn" alt="Moneda">)
            </button>
            <br>
            <a class="link-back-tcg" href="/">← Regresar a la pantalla principal</a>
        </div>
    </div>
@endsection