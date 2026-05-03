@extends('layouts.app')

@section('content')
@vite(['resources/css/admin.css'])

<div class="admin-wrapper">
    <header class="admin-header">
        <h1 class="admin-title">Panel de Control</h1>
        <a href="{{ route('admin.users.index') }}" class="btn-admin btn-admin-primary">Gestión de Usuarios</a>
    </header>

    @if(session('success'))
        <div class="admin-alert success">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="admin-alert error">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div class="admin-stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Usuarios">
            </div>
            <div class="stat-info">
                <h3>Usuarios Totales</h3>
                <div class="stat-value">{{ $totalUsers }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/tm-case.png" alt="Cartas">
            </div>
            <div class="stat-info">
                <h3>Cartas Descubiertas</h3>
                <div class="stat-value">{{ $totalCartas }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Monedas">
            </div>
            <div class="stat-info">
                <h3>Economía Global</h3>
                <div class="stat-value">{{ $totalMonedas }} <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" style="width:20px; vertical-align:middle;" alt="C"></div>
            </div>
        </div>
    </div>
</div>
@endsection
