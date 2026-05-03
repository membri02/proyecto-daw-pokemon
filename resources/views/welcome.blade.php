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
            <div class="feature-icon">🛍️</div>
            <h3>Tienda Integrada</h3>
            <p>Economía virtual robusta. Compra sobres de diferentes rarezas, controla tu saldo y asegura tus transacciones.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🎴</div>
            <h3>Álbum Personalizado</h3>
            <p>Guarda tus descubrimientos en una tabla relacional segura. Las cartas repetidas se desencantan automáticamente por Pokémonedas.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📖</div>
            <h3>Pokédex Interactiva</h3>
            <p>Consumo en tiempo real de la PokeAPI oficial para traerte todos los datos, estadísticas y arte de los 151 originales.</p>
        </div>
    </div>
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
            <p>Arquitecto de la lógica de negocio, migraciones, modelos relacionales y el motor del sistema de sobres.</p>
        </div>
        <div class="team-card">
            <div class="team-avatar">Ad</div>
            <h3>Adrián</h3>
            <span class="team-role">Frontend & UI/UX</span>
            <p>Maestro de los componentes de Blade, estructuración visual y de que cada carta brille como debe.</p>
        </div>
        <div class="team-card">
            <div class="team-avatar">M</div>
            <h3>Miguel</h3>
            <span class="team-role">Systems & Game Logic</span>
            <p>Especialista en integración de sistemas, administración de rutas protegidas y mecánicas del minijuego.</p>
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
    });
</script>

@vite(['resources/css/welcome.css'])
@endsection