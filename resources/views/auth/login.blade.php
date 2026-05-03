@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="trainer-card">
        <div class="card-header">
            <h2>Acceso a la Tienda</h2>
            <p>Identifícate con tu ID de Entrenador</p>
        </div>

        <form method="POST" action="/login" class="auth-form">
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
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ash@pueblopaleta.com" required autofocus>
            </div>

            <div class="input-group">
                <label for="password">Contraseña Secreta</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">ENTRAR A LA TIENDA</button>

            <div class="auth-links">
                <a href="{{ route('register') }}">¿No tienes licencia? Regístrate aquí</a>
            </div>
        </form>
    </div>
</div>

@vite(['resources/css/auth.css'])
@endsection
