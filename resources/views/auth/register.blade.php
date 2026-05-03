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

@vite(['resources/css/auth.css'])
@endsection
