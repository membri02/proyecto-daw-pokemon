@extends('layouts.app')

@section('content')
    @vite(['resources/css/sobres.css'])
    
    <!-- Prevención de FOUC: Estilos base críticos inline para que renderice instantáneamente centrado y oscuro -->
    <div class="tienda-wrapper" style="background-color: #f8fafc; max-width: 1200px; margin: 0 auto; display: block; min-height: 100vh;">
        <header class="tienda-header">
            <h1 class="titulo-pokemon">Poké-Tienda Oficial</h1>
            <p class="subtitulo">Adquiere potenciadores y expande tu colección de cartas digitales</p>
        </header>

        <div style="text-align: center; margin-bottom: 2rem;">
            @auth
                <div style="display: inline-block; background: #FFCB05; color: #000000; padding: 10px 25px; border-radius: 50px; border: 1px solid #111827; font-weight: 800; font-size: 1.2rem;">
                    Saldo actual: {{ Auth::user()->monedas }} <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" style="width: 24px; vertical-align: middle; margin-top: -4px;">
                </div>
            @else
                <a href="{{ route('register') }}" style="display: inline-block; background: linear-gradient(135deg, #FFCB05, #f39c12); color: #000; padding: 10px 28px; border-radius: 50px; border: 2px solid #111827; font-weight: 800; font-size: 1rem; text-decoration: none; box-shadow: 0 4px 15px rgba(255,203,5,0.4); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform=''">
                    ⚡ ¡Regístrate para obtener 1.000 🪙 gratis!
                </a>
            @endauth
        </div>

        @if(session('error'))
            <div style="background: #e74c3c; color: white; padding: 15px; text-align: center; font-weight: bold; border-radius: 8px; max-width: 600px; margin: 0 auto 2rem; box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/master-ball.png" style="width: 20px; vertical-align: middle; margin-top: -2px;" alt="Error"> {{ session('error') }}
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
        
        <h2 class="titulo-seccion-tienda"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" class="intro-icon" alt="Pokeball"> Ediciones Básicas <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" class="intro-icon" style="margin-right:0; margin-left:8px;" alt="Pokeball"></h2>
        <div class="sobres-grid">
            @php
                $basicos = [
                    ['fuego', 'Set Fuego', 'Llamas Eternas', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png', 100], 
                    ['agua', 'Set Agua', 'Mareas Profundas', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png', 100], 
                    ['planta', 'Set Planta', 'Selva Ancestral', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png', 100], 
                ];
            @endphp

            @foreach($basicos as $tipo)
                <div class="sobre-card {{ $tipo[0] }}" data-tipo="{{ $tipo[0] }}" data-precio="{{ $tipo[4] }}">
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

        <h2 class="titulo-seccion-tienda premium-title"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/master-ball.png" class="intro-icon" alt="Masterball"> Colecciones Premium <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/master-ball.png" class="intro-icon" style="margin-right:0; margin-left:8px;" alt="Masterball"></h2>
        <div class="sobres-grid">
            @php
                $premium = [
                    ['holo', 'Set Holo', 'Destellos Raros', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/151.png', 500, 'Asegura 1 Carta Rara'], 
                    ['legendario', 'Set Mito', 'Poder Legendario', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png', 1000, 'Asegura 1 Legendaria'], 
                ];
            @endphp

            @foreach($premium as $tipo)
                <div class="sobre-card premium-pack {{ $tipo[0] }}" data-tipo="{{ $tipo[0] }}" data-precio="{{ $tipo[4] }}">
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

    <!-- Modal Confirmación -->
    <div class="modal-tienda-backdrop" id="modalConfirmacion">
        <div class="modal-tienda-content">
            <h3>Confirmar Adquisición de Sobre</h3>
            <p class="modal-text-detail" id="modalTextoConfirmacion">
                <!-- Se inyecta por JS -->
            </p>
            <div class="modal-actions">
                <button class="btn-modal btn-cancelar" id="btnCancelarModal">Cancelar</button>
                <button class="btn-modal btn-confirmar" id="btnConfirmarModal">Confirmar Transacción</button>
            </div>
        </div>
    </div>

    <!-- Spinner Transición -->
    <div class="spinner-overlay" id="spinnerOverlay">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/master-ball.png" alt="Cargando" class="pokeball-spinner">
        <div class="spinner-text">ABRIENDO SOBRE...</div>
    </div>

    <script>
        let sobreSeleccionado = null;
        let precioSeleccionado = 0;
        let nombreSobreSeleccionado = '';
        const saldoActual = @auth {{ Auth::user()->monedas }} @else 0 @endauth;
        const esInvitado = {{ Auth::guest() ? 'true' : 'false' }};
        
        const btnAbrir = document.getElementById('btn-abrir');
        const sobres = document.querySelectorAll('.sobre-card');
        
        const modal = document.getElementById('modalConfirmacion');
        const modalText = document.getElementById('modalTextoConfirmacion');
        const btnCancelar = document.getElementById('btnCancelarModal');
        const btnConfirmar = document.getElementById('btnConfirmarModal');
        const spinner = document.getElementById('spinnerOverlay');

        sobres.forEach(sobre => {
            sobre.addEventListener('click', function() {
                sobres.forEach(s => s.classList.remove('selected'));

                this.classList.add('selected');
                sobreSeleccionado = this.dataset.tipo;
                precioSeleccionado = this.dataset.precio; 
                nombreSobreSeleccionado = this.querySelector('.pack-set-name').innerText;

                btnAbrir.innerHTML = `ABRIR SOBRE ${sobreSeleccionado.toUpperCase()} (${precioSeleccionado} <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" class="icono-moneda-btn" alt="Moneda">)`;
                btnAbrir.disabled = false;
            });
        });

        btnAbrir.addEventListener('click', () => {
            if (!sobreSeleccionado) return;

            // Guest check — handled entirely by Pikachu, no redirect
            if (esInvitado) {
                if (window.pikaGuide) {
                    window.pikaGuide.guestCheck();
                } else {
                    window.location.href = '{{ route("register") }}';
                }
                return;
            }

            // Authenticated: show confirmation modal
            modalText.innerHTML = `Estás a punto de adquirir un sobre de <strong class="resaltado">${nombreSobreSeleccionado}</strong>.<br><br>Se deducirán <strong class="resaltado">${precioSeleccionado}</strong> Pokémonedas de tu saldo actual de <strong class="resaltado">${saldoActual}</strong>.<br><br>¿Deseas confirmar la transacción?`;
            modal.classList.add('active');
        });

        // Lógica de Cancelar
        btnCancelar.addEventListener('click', () => {
            modal.classList.remove('active');
        });

        // Lógica de Confirmar
        btnConfirmar.addEventListener('click', () => {
            // Ocultar modal
            modal.classList.remove('active');
            // Mostrar spinner de carga inmersivo
            spinner.classList.add('active');

            // Desactivar el botón original y aplicar la animación al sobre visualmente
            btnAbrir.disabled = true;
            btnAbrir.innerHTML = '¡ABRIENDO... <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/premier-ball.png" class="icono-moneda-btn" alt="Opening">!';
            
            const sobreActivo = document.querySelector('.sobre-card.selected');
            if (sobreActivo) {
                sobreActivo.classList.add('opening-animation');
            }

            // Enviar formulario POST a la ruta protegida (laravel 11: no GET para acciones)
            setTimeout(() => {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/tienda/abrir/${sobreSeleccionado}`;

                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);

                document.body.appendChild(form);
                form.submit();
            }, 1200);
        });
    </script>
@endsection