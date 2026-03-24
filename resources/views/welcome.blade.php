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

<style>
    /* Welcome page uses the global theme variables.
       Local palette for colors NOT covered by globals: */
    :root {
        --wp-primary: #3c5aa6;  /* Azul Pokémon */
        --wp-accent:  #ffcb05;  /* Amarillo Pokémon */
    }

    /* Clases de Animación Scroll (Intersection Observer) */
    .reveal {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
    }
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Tipografía Global */
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    .section-header h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    .section-header p {
        color: var(--text-muted);
        font-size: 1.1rem;
    }

    /* --- HERO SECTION --- */
    .hero-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 4rem 5%;
        max-width: 1400px;
        margin: 0 auto;
        gap: 3rem;
    }

    .hero-content {
        flex: 1;
        max-width: 600px;
    }

    .badge-tech {
        background: rgba(255, 203, 5, 0.1);
        color: var(--accent);
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: bold;
        border: 1px solid rgba(255, 203, 5, 0.3);
        display: inline-block;
        margin-bottom: 1.5rem;
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 1.5rem;
    }

    .text-gradient {
        background: linear-gradient(135deg, #ffcb05, #ff9900);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: #334155;
        line-height: 1.6;
        margin-bottom: 2.5rem;
        font-weight: 500;
    }

    .hero-cta {
        display: flex;
        gap: 1.5rem;
    }

    .btn-primary-modern, .btn-secondary-modern {
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1.1rem;
    }

    .btn-primary-modern {
        background: #ffcb05; 
        color: #1e293b;
        border: 2px solid #ffcb05;
        box-shadow: 0 4px 15px rgba(255, 203, 5, 0.4);
    }
    .btn-primary-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 203, 5, 0.6);
        background: #f5b000;
        border-color: #f5b000;
    }

    .btn-secondary-modern {
        background: transparent;
        color: #1e293b;
        border: 2px solid #cbd5e1;
    }
    .btn-secondary-modern:hover {
        border-color: #94a3b8;
        background: rgba(0,0,0,0.05);
    }

    .hero-visual {
        flex: 1;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .glow-circle {
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(229,57,53,0.15) 0%, rgba(0,0,0,0) 70%);
        border-radius: 50%;
        z-index: 0;
    }

    .floating-pokemon {
        width: 100%;
        max-width: 450px;
        position: relative;
        z-index: 1;
        animation: float 6s ease-in-out infinite;
        filter: drop-shadow(0 20px 30px rgba(0,0,0,0.5));
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    /* --- FEATURES SECTION --- */
    .features-section {
        padding: 6rem 5%;
        background: #f1f5f9;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .feature-card {
        background: #ffffff;
        padding: 2.5rem;
        border-radius: 16px;
        border: 1px solid #cbd5e1;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        transition: transform 0.3s, border-color 0.3s;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        border-color: rgba(255,203,5,0.3);
    }

    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
    }
    .feature-card h3 {
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }
    .feature-card p {
        color: var(--text-muted);
        line-height: 1.5;
    }

    /* --- CONTEXT SECTION --- */
    .context-section {
        display: flex;
        align-items: center;
        gap: 4rem;
        padding: 8rem 5%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .context-visual {
        flex: 1;
        position: relative;
    }

    .context-img {
        width: 100%;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        border: 1px solid var(--border-color);
    }

    .location-badge {
        position: absolute;
        bottom: -15px;
        right: -15px;
        background: #ffffff;
        color: #0f172a;
        border: 1px solid #cbd5e1;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: bold;
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .context-content {
        flex: 1;
    }
    .context-content h2 {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
    }
    .context-content p {
        color: var(--text-muted);
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    /* --- TEAM SECTION --- */
    .team-section {
        padding: 6rem 5%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }

    .team-card {
        background: var(--card-bg);
        padding: 3rem 2rem;
        border-radius: 16px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .team-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
    }

    .team-avatar {
        width: 80px;
        height: 80px;
        background: #f1f5f9;
        color: #1e293b;
        font-size: 2rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        border: 3px solid #cbd5e1;
    }

    .team-card h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .team-role {
        display: block;
        color: var(--accent);
        font-size: 0.9rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .team-card p {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* --- RESPONSIVE DESIGN --- */
    @media (max-width: 992px) {
        .hero-section, .context-section {
            flex-direction: column;
            text-align: center;
        }
        .hero-title { font-size: 3rem; }
        .hero-cta { justify-content: center; }
        .location-badge { bottom: 20px; right: 20px; }
    }

    @media (max-width: 480px) {
        .hero-cta { flex-direction: column; }
        .hero-title { font-size: 2.5rem; }
    }


    /* --- CONTRASTE HERO Y SECCIONES (modo claro permanente) --- */
    .hero-title {
        color: #1e293b;
    }
    .hero-subtitle {
        color: #475569;
    }
    .badge-tech {
        background: #f1f5f9;
        color: #f59e0b;
        border-color: #f59e0b;
    }
    .section-header h2,
    .context-content h2,
    .feature-card h3,
    .team-card h3 {
        color: #1e293b;
    }
    .section-header p,
    .context-content p,
    .feature-card p,
    .team-card p {
        color: #475569;
    }
    .team-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        border: 1px solid #cbd5e1;
    }
</style>
@endsection