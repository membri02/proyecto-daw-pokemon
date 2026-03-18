<nav class="nav-pokemon">
    <div class="nav-logo">
        <a href="/">Inicio</a>
        <a href="/pokedex">Pokédex</a>
        <a href="/sobres">Tienda TCG</a>
        <a href="/minijuego">Minijuego</a>
        <a href="/admin">Panel Admin</a>
        <a href="/album" class="nav-album">Mi Álbum</a>
    </div>

    <div class="nav-auth">
        @auth
            <span class="user-badge">Entrenador: {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Salir</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-auth btn-login">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn-auth btn-register">Registrarse</a>
        @endauth
    </div>
</nav>

<div class="coins-bar">
    @auth
        💰 MONEDAS: {{ Auth::user()->monedas }} | 🏷️ COSTE SOBRE: 100
    @else
        💡 Inicia sesión para ver tu monedero y abrir sobres.
    @endauth
</div>

<style>
    .nav-pokemon {
        background-color: #e53935; /* Rojo Pokédex */
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        border-bottom: 4px solid #c62828;
        color: white;
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
        color: white;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.1rem;
        text-transform: uppercase;
    }

    .nav-album {
        background: var(--pokemon-yellow);
        color: #2d3436;
        padding: 4px 10px;
        border-radius: 999px;
        font-weight: 700;
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
    }

    .btn-login {
        background-color: white;
        color: #e53935;
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
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .user-badge {
        background: rgba(0,0,0,0.2);
        padding: 5px 15px;
        border-radius: 15px;
        font-weight: bold;
    }

    .coins-bar {
        background: #f1c40f;
        padding: 10px;
        text-align: center;
        font-weight: bold;
        color: #2d3436;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.2);
        margin-top: 8px;
        border-radius: 8px;
    }
</style>