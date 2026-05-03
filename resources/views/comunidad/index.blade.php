@extends('layouts.app')

@section('content')
@vite(['resources/css/comunidad.css'])

<div class="comunidad-wrapper">
    <div class="comunidad-header">
        <h1>Foro de Entrenadores</h1>
        <a href="{{ route('comunidad.create') }}" class="btn-comunidad">+ Nuevo Hilo</a>
    </div>

    @if(session('success'))
        <div style="background: #4ade80; color: #064e3b; padding: 1rem; border-radius: 10px; margin-bottom: 1rem; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <div class="threads-list">
        @forelse($posts as $post)
            <div class="thread-card">
                <div class="thread-avatar">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Avatar">
                </div>
                <div class="thread-content">
                    <a href="{{ route('comunidad.show', $post->id) }}" class="thread-title">{{ $post->titulo }}</a>
                    <div class="thread-meta">
                        <span>Por <strong style="color:white;">{{ $post->user->name }}</strong></span>
                        @if($post->user->email === 'admin@pokemon.com')
                            <span class="badge-admin">Admin</span>
                        @endif
                        <span><i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}</span>
                        <span><i class="fas fa-comments"></i> {{ $post->comments_count }} Respuestas</span>
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align: center; color: #cbd5e1; padding: 2rem; background: rgba(0,0,0,0.3); border-radius: 10px;">Aún no hay hilos creados. ¡Sé el primero en publicar algo!</p>
        @endforelse
    </div>

    <!-- SECCIÓN DE RANKING INTEGRADA -->
    <div class="comunidad-header" style="margin-top: 3rem; justify-content: center; border-bottom: none; padding-bottom: 0;">
        <h2>Ranking Global</h2>
    </div>

    <div class="ranking-grid">
        <!-- Top Monedas -->
        <div class="ranking-box">
            <h3 style="color: #FFCB05; text-align: center; margin-bottom: 1rem;">💰 Top Riqueza</h3>
            <table class="ranking-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Entrenador</th>
                        <th>Monedas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topMonedas as $index => $user)
                        <tr>
                            <td class="rank-{{ $index + 1 }}">{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $user->name }}</strong>
                                @if($user->email === 'admin@pokemon.com')
                                    <span class="badge-admin" style="font-size:0.6rem; margin-left:5px;">Admin</span>
                                @endif
                            </td>
                            <td style="font-weight: bold; color: #4ade80;">{{ $user->monedas }} <i class="fas fa-coins"></i></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Top Colección -->
        <div class="ranking-box">
            <h3 style="color: #FFCB05; text-align: center; margin-bottom: 1rem;">🃏 Top Coleccionistas</h3>
            <table class="ranking-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Entrenador</th>
                        <th>Cartas Únicas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topColeccion as $index => $user)
                        <tr>
                            <td class="rank-{{ $index + 1 }}">{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $user->name }}</strong>
                                @if($user->email === 'admin@pokemon.com')
                                    <span class="badge-admin" style="font-size:0.6rem; margin-left:5px;">Admin</span>
                                @endif
                            </td>
                            <td style="font-weight: bold; color: #60a5fa;">{{ $user->cartas_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
