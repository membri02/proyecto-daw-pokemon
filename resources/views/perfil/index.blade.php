@extends('layouts.app')

@section('content')
@vite(['resources/css/perfil.css'])

<div class="perfil-wrapper">
    <div class="legendary-card">
        <div class="legendary-header">
            <h1>Tarjeta de Entrenador</h1>
        </div>

        @if(session('success'))
            <div class="perfil-alert success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error') || $errors->any())
            <div class="perfil-alert error">
                ❌ {{ session('error') ?? 'Por favor, corrige los errores del formulario.' }}
                @if($errors->any())
                    <ul style="margin: 5px 0 0 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        <div class="legendary-content">
            <!-- Sección de Datos Personales -->
            <div class="datos-personales">
                <div class="perfil-form-group">
                    <label>Nombre de Entrenador</label>
                    <input type="text" class="perfil-input" value="{{ $user->name }}" disabled>
                </div>
                <div class="perfil-form-group">
                    <label>Correo Electrónico</label>
                    <input type="email" class="perfil-input" value="{{ $user->email }}" disabled>
                </div>

                <hr style="border:0; border-top: 1px solid #e2e8f0; margin: 2rem 0;">

                <form method="POST" action="{{ route('perfil.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <h3 style="color:#1e293b; font-weight:800; margin-bottom:1rem; text-transform:uppercase;">Cambiar Contraseña</h3>

                    <div class="perfil-form-group">
                        <label>Contraseña Actual</label>
                        <input type="password" name="current_password" class="perfil-input" required>
                    </div>
                    <div class="perfil-form-group">
                        <label>Nueva Contraseña</label>
                        <input type="password" name="new_password" class="perfil-input" required minlength="8">
                    </div>
                    <div class="perfil-form-group">
                        <label>Confirmar Nueva Contraseña</label>
                        <input type="password" name="new_password_confirmation" class="perfil-input" required minlength="8">
                    </div>

                    <button type="submit" class="btn-legendary">Actualizar Credenciales</button>
                </form>
            </div>

            <!-- Sección de Progreso (Chart.js) -->
            <div class="chart-container">
                <h3 class="chart-title">Progreso de Pokédex</h3>
                <div style="position: relative; height:250px; width:250px;">
                    <canvas id="pokedexChart"></canvas>
                </div>
                <p style="margin-top: 1.5rem; font-weight: 800; color: #334155; font-size: 1.2rem;">
                    {{ $cartas_unicas }} / {{ $total_cartas }} Cartas
                </p>
                <div style="background: #e2e8f0; border-radius: 999px; width: 100%; height: 12px; overflow: hidden; margin-top: 0.5rem;">
                    <div style="background: linear-gradient(90deg, #D5A100, #facc15); height: 100%; width: {{ $progreso }}%;"></div>
                </div>
                <p style="text-align:center; font-weight:700; color:#64748b; font-size: 0.9rem; margin-top:0.5rem;">
                    Completado al {{ $progreso }}%
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Solo para esta vista -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('pokedexChart').getContext('2d');
        const conseguidas = {{ $cartas_unicas }};
        const totales = {{ $total_cartas }};
        const faltantes = totales - conseguidas > 0 ? totales - conseguidas : 0;

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Conseguidas', 'Faltantes'],
                datasets: [{
                    data: [conseguidas, faltantes],
                    backgroundColor: [
                        '#D5A100', // Dorado
                        '#e2e8f0'  // Gris claro
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                family: "'Montserrat', sans-serif",
                                weight: 'bold'
                            },
                            color: '#334155'
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
