{{-- 1. Indica qué layout va a usar --}}
@extends('layouts.app')

{{-- 2. Define qué poner dentro del @yield('content') --}}
@section('content')
    <section id="inicio" class="section active">
            <div class="admin-card" style="text-align: center;">
                <h2>Planificación del Proyecto</h2>
                <p style="margin: 20px 0;">Estado actual: <strong>Sprint 3 (Funcionalidad del Núcleo)</strong></p>
                <div class="stat-grid">
                    <div class="stat-box">
                        <h4>Andrés</h4>
                        <p>Lógica de Tienda y BBDD MySQL</p>
                    </div>
                    <div class="stat-box">
                        <h4>Adrián</h4>
                        <p>Consumo de PokéAPI y Vistas</p>
                    </div>
                    <div class="stat-box">
                        <h4>Miguel</h4>
                        <p>Admin Panel y Autenticación</p>
                    </div>
                </div>
                <button class="btn-main">Ver Pokédex</button>
            </div>
        </section>
@endsection