@extends('layouts.app')

@section('content')
<section class="hero-section reveal">
    <div class="hero-content">
        <span class="badge-tech">Laravel 11 • MVC • API REST</span>
        <h1 class="hero-title">Coleccionismo Web <span class="text-gradient">Evolucionado</span></h1>
        <p class="hero-subtitle">Descubre, compra y gestiona tu propio álbum de los 151 Pokémon originales. Una plataforma moderna construida con la robustez de Laravel y la magia de las bases de datos relacionales.</p>
        <div class="hero-cta">
            <a href="/sobres" class="btn-primary-modern">Explorar Tienda TCG</a>
            <a href="/pokedex" class="btn-secondary-modern">Ver Pokédex</a>
        </div>
    </div>
    <div class="hero-visual">
        <div class="glow-circle"></div>
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png" alt="Charizard" class="floating-pokemon">
    </div>
</section>

<section class="features-section reveal">
    <div class="section-header">
        <h2>La experiencia completa TCG</h2>
        <p>Un sistema económico y de colección diseñado al milímetro.</p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/nugget.png" alt="Tienda" style="width: 48px; height: 48px; image-rendering: pixelated; margin: 0 auto; display: block;"></div>
            <h3>Tienda Integrada</h3>
            <p>Economía virtual robusta. Compra sobres de diferentes rarezas, controla tu saldo y asegura tus transacciones.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/exp-share.png" alt="Álbum" style="width: 48px; height: 48px; image-rendering: pixelated; margin: 0 auto; display: block;"></div>
            <h3>Álbum Personalizado</h3>
            <p>Guarda tus descubrimientos en una tabla relacional segura. Las cartas repetidas se desencantan automáticamente por Pokémonedas.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokédex" style="width: 48px; height: 48px; image-rendering: pixelated; margin: 0 auto; display: block;"></div>
            <h3>Pokédex Interactiva</h3>
            <p>Consumo en tiempo real de la PokeAPI oficial para traerte todos los datos, estadísticas y arte de los 151 originales.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/vs-seeker.png" alt="Minijuegos" style="width: 48px; height: 48px; image-rendering: pixelated; margin: 0 auto; display: block;"></div>
            <h3>Minijuegos</h3>
            <p>Prueba tu suerte y habilidad en nuestros minijuegos para ganar recompensas exclusivas y ampliar tu colección.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/town-map.png" alt="Comunidad" style="width: 48px; height: 48px; image-rendering: pixelated; margin: 0 auto; display: block;"></div>
            <h3>Comunidad</h3>
            <p>Interactúa con otros entrenadores, comparte tus logros y compite para ser el mejor.</p>
        </div>
    </div>
</section>

<section class="announcement-board reveal" style="max-width: 900px; margin: 4rem auto; border: none; border-radius: 24px; padding: 3rem 2rem; background: linear-gradient(135deg, rgba(59,76,202,0.03) 0%, rgba(59,76,202,0.08) 100%); text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.04); overflow: hidden; position: relative;">
    <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255,203,5,0.15); border-radius: 50%; filter: blur(30px);"></div>
    <div style="position: absolute; bottom: -50px; left: -50px; width: 200px; height: 200px; background: rgba(59,76,202,0.1); border-radius: 50%; filter: blur(40px);"></div>
    
    <h2 style="margin-bottom: 15px; font-size: 2.2rem; color: #1a202c; position: relative; z-index: 2;">¡Nuevos Minijuegos Disponibles!</h2>
    <p style="font-size: 1.15rem; margin-bottom: 35px; color: #4a5568; position: relative; z-index: 2; max-width: 600px; margin-left: auto; margin-right: auto;">🌟 Desafía tu suerte, adivina el Pokémon y compite en emocionantes duelos para ganar recompensas exclusivas.</p>
    
    <div class="carousel-container" style="position: relative; width: 100%; max-width: 600px; height: 280px; margin: 0 auto 35px auto; z-index: 2; border-radius: 16px;">
        <div class="carousel-track" style="position: relative; width: 100%; height: 100%; perspective: 1000px;">
            
            <div class="carousel-card active" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1); opacity: 1; transform: translateX(0) scale(1);">
                <div style="background: radial-gradient(circle, rgba(255,203,5,0.15) 0%, rgba(255,255,255,0) 70%); width: 130px; height: 130px; display: flex; align-items: center; justify-content: center; border-radius: 50%; margin-bottom: 15px;">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png" alt="Silueta" style="height: 100px; filter: brightness(0) invert(1) drop-shadow(0px 8px 10px rgba(0,0,0,0.3)); transform: translateY(-5px);">
                </div>
                <h3 style="color: #2d3748; font-size: 1.3rem; font-weight: 700; margin: 0;">¿Quién es ese Pokémon?</h3>
                <span style="display: inline-block; margin-top: 10px; padding: 5px 15px; background: rgba(59,76,202,0.1); color: #3b4cca; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Acertijos Visuales</span>
            </div>
            
            <div class="carousel-card" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0; transform: translateX(50px) scale(0.9); pointer-events: none;">
                <div style="background: radial-gradient(circle, rgba(230,57,70,0.1) 0%, rgba(255,255,255,0) 70%); width: 130px; height: 130px; display: flex; align-items: center; justify-content: center; border-radius: 50%; margin-bottom: 15px;">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Triler" style="height: 80px; image-rendering: pixelated; filter: drop-shadow(0px 8px 10px rgba(0,0,0,0.2));">
                </div>
                <h3 style="color: #2d3748; font-size: 1.3rem; font-weight: 700; margin: 0;">El Triler Voltorb</h3>
                <span style="display: inline-block; margin-top: 10px; padding: 5px 15px; background: rgba(230,57,70,0.1); color: #e63946; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Juego de Suerte</span>
            </div>

            <div class="carousel-card" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0; transform: translateX(50px) scale(0.9); pointer-events: none;">
                <div style="background: radial-gradient(circle, rgba(155,89,182,0.1) 0%, rgba(255,255,255,0) 70%); width: 130px; height: 130px; display: flex; align-items: center; justify-content: center; border-radius: 50%; margin-bottom: 15px;">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/493.png" alt="Duelo" style="height: 110px; object-fit: contain; filter: drop-shadow(0px 8px 10px rgba(0,0,0,0.15));">
                </div>
                <h3 style="color: #2d3748; font-size: 1.3rem; font-weight: 700; margin: 0;">Duelo de Tipos</h3>
                <span style="display: inline-block; margin-top: 10px; padding: 5px 15px; background: rgba(155,89,182,0.1); color: #8e44ad; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Estrategia</span>
            </div>

            <div class="carousel-card" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0; transform: translateX(50px) scale(0.9); pointer-events: none;">
                <div style="background: radial-gradient(circle, rgba(46,204,113,0.1) 0%, rgba(255,255,255,0) 70%); width: 130px; height: 130px; display: flex; align-items: center; justify-content: center; border-radius: 50%; margin-bottom: 15px;">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/54.png" alt="Memoria" style="height: 100px; object-fit: contain; filter: drop-shadow(0px 8px 10px rgba(0,0,0,0.15));">
                </div>
                <h3 style="color: #2d3748; font-size: 1.3rem; font-weight: 700; margin: 0;">Memoria de Psyduck</h3>
                <span style="display: inline-block; margin-top: 10px; padding: 5px 15px; background: rgba(46,204,113,0.1); color: #27ae60; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Agilidad Mental</span>
            </div>
        </div>
        
        <div class="carousel-indicators" style="position: absolute; bottom: 20px; left: 0; width: 100%; display: flex; justify-content: center; gap: 8px; z-index: 10;">
            <div class="dot active" style="width: 24px; height: 6px; border-radius: 3px; background: #3b4cca; transition: all 0.3s ease;"></div>
            <div class="dot" style="width: 8px; height: 6px; border-radius: 3px; background: rgba(59,76,202,0.2); transition: all 0.3s ease;"></div>
            <div class="dot" style="width: 8px; height: 6px; border-radius: 3px; background: rgba(59,76,202,0.2); transition: all 0.3s ease;"></div>
            <div class="dot" style="width: 8px; height: 6px; border-radius: 3px; background: rgba(59,76,202,0.2); transition: all 0.3s ease;"></div>
        </div>
    </div>

    <a href="/minijuego" class="btn-primary-modern" style="position: relative; z-index: 2; padding: 0.9rem 2.5rem; font-size: 1.1rem; border-radius: 30px; box-shadow: 0 4px 15px rgba(59,76,202,0.3); transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59,76,202,0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59,76,202,0.3)';">¡Jugar Ahora!</a>
</section>

<section class="context-section reveal">
    
    <div class="context-visual">
        <img src="{{ asset('images/instituto.jpg') }}" alt="Alumnos del IES Virgen de la Paz" class="context-img" style="object-position: center;">
        <div class="location-badge"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/town-map.png" class="pika-sprite-icon" alt="Mapa" style="width:30px;"> Alcobendas, Madrid</div>
    </div>
    <div class="context-content">
        <h2>Del aula al servidor</h2>
        <p>Nacido en las aulas del <strong>IES Virgen de la Paz</strong>, este proyecto final de Desarrollo de Aplicaciones Web (DAW) representa el puente perfecto entre la teoría académica y el desarrollo Full-Stack profesional.</p>
        <p>Nos enfrentamos al reto de construir no solo una interfaz atractiva, sino un backend seguro, un sistema de autenticación completo y una lógica de negocio compleja que maneja compras, inventarios y probabilidades matemáticas.</p>
    </div>
</section>

<section class="team-section reveal">
    <div class="section-header">
        <h2>Conoce al equipo</h2>
        <p>Los desarrolladores detrás del código fuente.</p>
    </div>
    <div class="team-grid">
        <div class="team-card">
            <div class="team-avatar">A</div>
            <h3>Andrés</h3>
            <span class="team-role">Lead Backend & Database</span>
            <p>Arquitecto de la lógica de negocio, migraciones, modelos relacionales y el motor del sistema de sobres. Especialista en integración de sistemas y administración de rutas protegidas.</p>
        </div>
        <div class="team-card">
            <div class="team-avatar">Ad</div>
            <h3>Adrián</h3>
            <span class="team-role">Frontend & UI/UX</span>
            <p>Maestro de los componentes de Blade, estructuración visual y de que cada carta brille como debe. Encargado de las mecánicas del minijuego.</p>
        </div>
        <div class="team-card">
            <div class="team-avatar">M</div>
            <h3>Miguel</h3>
            <span class="team-role">Documentation Specialist</span>
            <p>Especialista en documentación del proyecto.</p>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal').forEach((element) => {
            observer.observe(element);
        });

        // Advanced Carousel Logic
        const cards = document.querySelectorAll('.carousel-card');
        const dots = document.querySelectorAll('.dot');
        let currentIdx = 0;

        if (cards.length > 0) {
            setInterval(() => {
                // Exit current card to the left
                cards[currentIdx].style.opacity = '0';
                cards[currentIdx].style.transform = 'translateX(-30px) scale(0.95)';
                cards[currentIdx].style.pointerEvents = 'none';
                cards[currentIdx].classList.remove('active');
                
                dots[currentIdx].style.width = '8px';
                dots[currentIdx].style.background = 'rgba(59,76,202,0.2)';
                dots[currentIdx].classList.remove('active');

                // Move to next card
                currentIdx = (currentIdx + 1) % cards.length;

                // Reset position of new card to come from right
                cards[currentIdx].style.transition = 'none';
                cards[currentIdx].style.transform = 'translateX(30px) scale(0.95)';
                
                // Force reflow
                void cards[currentIdx].offsetWidth;

                // Enter new card
                cards[currentIdx].style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                cards[currentIdx].style.opacity = '1';
                cards[currentIdx].style.transform = 'translateX(0) scale(1)';
                cards[currentIdx].style.pointerEvents = 'auto';
                cards[currentIdx].classList.add('active');

                dots[currentIdx].style.width = '24px';
                dots[currentIdx].style.background = '#3b4cca';
                dots[currentIdx].classList.add('active');
            }, 4000);
        }
    });
</script>

@vite(['resources/css/welcome.css'])
@endsection