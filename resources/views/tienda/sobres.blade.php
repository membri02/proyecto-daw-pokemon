@extends('layouts.app')

@section('content')
    @vite(['resources/css/sobres.css'])
    
    <div class="tienda-wrapper">
        <header class="tienda-header">
            <h1 class="titulo-pokemon">Poké-Tienda Oficial</h1>
            <p class="subtitulo">Adquiere potenciadores y expande tu colección de cartas digitales</p>
        </header>

        <div style="text-align: center; margin-bottom: 2rem;">
            @auth
                <div style="display: inline-block; background: #fff; padding: 10px 25px; border-radius: 50px; border: 3px solid #FFCB05; font-weight: bold; font-size: 1.2rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    Saldo actual: {{ Auth::user()->monedas }} <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" style="width: 24px; vertical-align: middle; margin-top: -4px;">
                </div>
            @endauth
        </div>

        @if(session('error'))
            <div style="background: #e74c3c; color: white; padding: 15px; text-align: center; font-weight: bold; border-radius: 8px; max-width: 600px; margin: 0 auto 2rem; box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);">
                ⚠️ {{ session('error') }}
            </div>
        @endif
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
        
        <h2 class="titulo-seccion-tienda">Ediciones Básicas</h2>
        <div class="sobres-grid">
            @php
                $basicos = [
                    ['fuego', 'Set Fuego', 'Llamas Eternas', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png', 100], 
                    ['agua', 'Set Agua', 'Mareas Profundas', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png', 100], 
                    ['planta', 'Set Planta', 'Selva Ancestral', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png', 100], 
                ];
            @endphp

            @foreach($basicos as $tipo)
                <div class="booster-pack-wrapper {{ $tipo[0] }}" data-tipo="{{ $tipo[0] }}" data-precio="{{ $tipo[4] }}">
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

        <h2 class="titulo-seccion-tienda premium-title">Colecciones Premium</h2>
        <div class="sobres-grid">
            @php
                $premium = [
                    ['holo', 'Set Holo', 'Destellos Raros', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/151.png', 500, 'Asegura 1 Carta Rara'], 
                    ['legendario', 'Set Mito', 'Poder Legendario', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png', 1000, 'Asegura 1 Legendaria'], 
                ];
            @endphp

            @foreach($premium as $tipo)
                <div class="booster-pack-wrapper premium-pack {{ $tipo[0] }}" data-tipo="{{ $tipo[0] }}" data-precio="{{ $tipo[4] }}">
                    <div class="aura-epica"></div> <div class="pack-crimp top"></div>
                    <div class="pack-inner">
                        <div class="pack-foil-texture"></div>
                        <div class="pack-shine"></div>
                        <img src="{{ $tipo[3] }}" alt="Representación de {{ $tipo[1] }}" class="pack-art-image">
                        <div class="pack-footer-info">
                            <span class="pack-set-name">{{ $tipo[1] }}</span>
                            <small class="pack-expansion-name" style="color:#FFCB05; font-weight:bold;">{{ $tipo[5] }}</small>
                            <span class="pack-card-count">5 CARTAS</span>
                        </div>
                    </div>
                    <div class="pack-crimp bottom"></div>
                </div>
            @endforeach
        </div>

        <div class="tienda-action-bar">
            <button id="btn-abrir" class="btn-primary-tcg" disabled>
                SELECCIONA UN SOBRE
            </button>
            <br>
            <a class="link-back-tcg" href="/">← Regresar a la pantalla principal</a>
        </div>
    </div>

    <script>
        let sobreSeleccionado = null;
        let precioSeleccionado = 0;
        const btnAbrir = document.getElementById('btn-abrir');
        const sobres = document.querySelectorAll('.booster-pack-wrapper');

        sobres.forEach(sobre => {
            sobre.addEventListener('click', function() {
                sobres.forEach(s => s.classList.remove('selected'));

                this.classList.add('selected');
                sobreSeleccionado = this.dataset.tipo;
                precioSeleccionado = this.dataset.precio; 

                btnAbrir.innerHTML = `ABRIR SOBRE ${sobreSeleccionado.toUpperCase()} (${precioSeleccionado} <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" class="icono-moneda-btn" alt="Moneda">)`;
                btnAbrir.disabled = false;
            });
        });

        btnAbrir.addEventListener('click', () => {
            if (sobreSeleccionado) {
                btnAbrir.disabled = true;
                btnAbrir.innerHTML = '¡ABRIENDO... ✨!';

                const sobreActivo = document.querySelector('.booster-pack-wrapper.selected');
                sobreActivo.classList.add('opening-animation');

                setTimeout(() => {
                    window.location.href = `/sobres/abrir/${sobreSeleccionado}`;
                }, 1500);
            }
        });
    </script>
@endsection