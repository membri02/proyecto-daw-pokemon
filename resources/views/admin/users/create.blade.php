@extends('layouts.app')

@section('content')
@vite(['resources/css/admin.css'])

<div class="admin-wrapper">
    <header class="admin-header">
        <h1 class="admin-title">Nuevo Usuario</h1>
        <a href="{{ route('admin.users.index') }}" class="btn-admin btn-admin-secondary">← Volver a Lista</a>
    </header>

    @if ($errors->any())
        <div class="admin-alert error">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-form-card">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="admin-form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" class="admin-form-control" value="{{ old('name') }}" required>
            </div>

            <div class="admin-form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="admin-form-control" value="{{ old('email') }}" required>
            </div>

            <div class="admin-form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="admin-form-control" required>
            </div>

            <div class="admin-form-group">
                <label for="monedas">Saldo Inicial (Pokémonedas)</label>
                <div style="position: relative;">
                    <input type="number" id="monedas" name="monedas" class="admin-form-control" value="{{ old('monedas', 200) }}" min="0" required>
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" style="position: absolute; right: 15px; top: 12px; width: 20px;">
                </div>
            </div>

            <div class="admin-form-actions">
                <button type="submit" class="btn-admin btn-admin-success">Crear Usuario</button>
                <a href="{{ route('admin.users.index') }}" class="btn-admin btn-admin-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
