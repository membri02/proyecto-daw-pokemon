@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="trainer-card" style="max-width: 550px;">
        <div class="card-header" style="background: #2a75bb; text-shadow: 2px 2px 0 #1c4b7a;">
            <h2>Nueva Licencia</h2>
            <p>Regístrate y recibe 1000 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" style="width: 16px; vertical-align: middle;"> de bienvenida</p>
        </div>

        <form method="POST" action="/registro" class="auth-form">
            @csrf

            @if ($errors->any())
                <div class="auth-errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="input-group">
                <label for="name">Nombre de Entrenador (Alias)</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ej: Red" required autofocus>
            </div>

            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="tu@correo.com" required>
            </div>

            <div class="input-group">
                <label for="password">Contraseña Secreta</label>
                <input type="password" id="password" name="password" placeholder="Crea una contraseña segura" required>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña" required>
            </div>

            <button type="submit" class="btn-submit" style="background: #2ecc71; color: white; border-color: #27ae60;">
                OBTENER LICENCIA
            </button>

            <div class="auth-links">
                <a href="{{ route('login') }}" style="color: #2a75bb;">¿Ya tienes licencia? Inicia Sesión</a>
            </div>
        </form>
    </div>
</div>

<style>
    /* Estilos compartidos para Login y Registro */
    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 70px); /* Restamos la altura del nav */
        background: url('https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png') no-repeat center center;
        background-size: 500px;
        background-blend-mode: overlay;
        background-color: #f4f7f6;
    }

    .trainer-card {
        background: white;
        width: 100%;
        max-width: 450px;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        border: 4px solid #333;
        position: relative;
    }

    .card-header {
        background: #e53935; /* Rojo Pokédex */
        color: white;
        padding: 30px 20px;
        text-align: center;
        border-bottom: 6px solid #333;
    }

    .card-header h2 {
        margin: 0;
        font-size: 2rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 2px 2px 0 #c62828;
    }

    .card-header p {
        margin: 5px 0 0;
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .auth-form {
        padding: 30px;
    }

    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        font-weight: 800;
        color: #555;
        margin-bottom: 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .input-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.3s;
        box-sizing: border-box;
    }

    .input-group input:focus {
        border-color: #2a75bb; /* Azul Pokémon */
        outline: none;
        box-shadow: 0 0 0 3px rgba(42, 117, 187, 0.2);
    }

    .btn-submit {
        width: 100%;
        background: #ffcb05; /* Amarillo Pokémon */
        color: #2a75bb;
        border: 3px solid #3c5aa6;
        padding: 15px;
        font-size: 1.2rem;
        font-weight: 900;
        border-radius: 8px;
        cursor: pointer;
        text-transform: uppercase;
        transition: all 0.2s;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: #f1c40f;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(241, 196, 15, 0.4);
    }

    .auth-links {
        text-align: center;
        margin-top: 20px;
    }

    .auth-links a {
        color: #e53935;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .auth-links a:hover {
        text-decoration: underline;
    }

    .auth-errors {
        background: rgba(46, 204, 113, 0.12);
        border: 1px solid rgba(46, 204, 113, 0.3);
        padding: 12px 14px;
        border-radius: 8px;
        margin-bottom: 16px;
        color: #27ae60;
    }

    .auth-errors ul {
        margin: 0;
        padding-left: 18px;
    }

    .auth-errors li {
        margin-bottom: 4px;
    }
</style>
@endsection
