<nav class="nav-pokemon">
    <div class="nav-logo">
        <a href="/">Inicio</a>
        <a href="/pokedex">Pokédex</a>
        <a href="/sobres">Tienda TCG</a>
        <a href="/minijuego">Minijuegos</a>
        <a href="{{ route('comunidad.index') }}"><i class="fas fa-users" style="margin-right: 5px;"></i> Comunidad</a>
        @if(Auth::check() && Auth::user()->email === 'admin@pokemon.com')
            <a href="/admin">Panel Admin</a>
        @endif
        
        @auth
            <a href="/album" class="nav-album">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/tm-case.png" class="pika-sprite-icon" alt="Álbum" style="width:30px;"> Mi Álbum
            </a>        
        @endauth
    </div>

    <div class="nav-auth">

        @auth
            <a href="{{ route('tienda.recargar') }}" class="monedero-nav" style="text-decoration:none;">
                <span class="monedas-text" id="wallet">{{ Auth::user()->monedas }}</span>
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" class="amulet-coin-icon pika-sprite-icon" alt="Monedas">
            </a>
            
            <a href="{{ route('perfil.index') }}" class="user-badge" style="text-decoration:none; display:flex; align-items:center; gap:8px;">
                Entrenador: {{ Auth::user()->name }}
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Perfil" style="width:20px;">
            </a>
            
            <form method="POST" action="{{ route('logout') }}" style="display:flex; align-items:center; margin:0;">
                @csrf
                <button type="submit" class="btn-logout">
                    Salir <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/escape-rope.png" class="pika-sprite-icon" alt="Escape" style="width:30px; margin-left:6px;">
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-auth btn-login">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn-auth btn-register">Registrarse</a>
        @endauth
    </div>
</nav>



<style>
    /* ... (MANTÉN TODO TU CSS EXACTAMENTE IGUAL AQUÍ, ESTÁ PERFECTO) ... */
    .nav-pokemon {
        position: sticky;
        top: 0;
        z-index: 1000;
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        font-family: 'Montserrat', sans-serif;
        flex-wrap: wrap;
        gap: 12px;
    }

    .nav-logo {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        align-items: center;
    }

    .nav-logo a {
        color: #334155;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.1rem;
        text-transform: uppercase;
        position: relative;
        transition: color 0.3s ease;
    }
    .nav-logo a:not(.nav-album):hover {
        color: #020617;
    }
    .nav-logo a:not(.nav-album)::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -4px;
        left: 50%;
        background-color: #020617;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    .nav-logo a:not(.nav-album):hover::after {
        width: 100%;
    }

    .nav-album {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #ffcb05;
        color: #0f172a !important;
        padding: 2px 16px;
        border-radius: 999px;
        font-weight: 900 !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .nav-album:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .nav-auth {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .btn-auth {
        text-decoration: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.85rem;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .btn-login {
        background-color: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
    }

    .btn-register {
        background-color: #ffcb05; /* Amarillo Pokémon */
        color: #2a75bb; /* Azul Pokémon */
        border: 2px solid #3c5aa6;
    }

    .btn-register:hover {
        background-color: #e6b800;
        color: #1f2d3b;
        border-color: #2a75bb;
    }

    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }

    .user-badge {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
        padding: 5px 15px;
        border-radius: 15px;
        font-weight: bold;
    }

    /* Logout button — adapt for light glass navbar */
    .btn-logout {
        display: flex;
        align-items: center;
        background: transparent;
        border: 1px solid #cbd5e1;
        color: #334155;
        padding: 4px 14px;
        border-radius: 20px;
        cursor: pointer;
        margin-left: 5px;
        font-family: inherit;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-logout:hover {
        background: #f1f5f9;
        color: #0f172a;
        border-color: #94a3b8;
    }

    .monedero-nav {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 4px 12px;
        border-radius: 20px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        cursor: pointer;
        transition: transform 0.2s, background 0.2s;
    }
    .monedero-nav:hover {
        background: #f8fafc;
        transform: translateY(-2px);
    }
    .monedas-text {
        color: #0f172a; /* slate-900 */
        font-weight: 900;
        font-size: 0.95rem;
    }
    .amulet-coin-icon {
        width: 30px;
        animation: shine-coin 5s infinite;
        filter: drop-shadow(0 2px 2px rgba(0,0,0,0.1));
    }
    @keyframes shine-coin {
        0%, 90% { filter: brightness(1) drop-shadow(0 2px 2px rgba(0,0,0,0.1)); transform: scale(1); }
        95% { filter: brightness(1.4) drop-shadow(0 0 6px rgba(255,203,5,0.8)); transform: scale(1.15); }
        100% { filter: brightness(1) drop-shadow(0 2px 2px rgba(0,0,0,0.1)); transform: scale(1); }
    }
</style>
