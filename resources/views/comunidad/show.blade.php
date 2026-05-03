@extends('layouts.app')

@section('content')
@vite(['resources/css/comunidad.css'])

<div class="comunidad-wrapper">
    <a href="{{ route('comunidad.index') }}" class="btn-comunidad" style="background: #e2e8f0; color: #334155; margin-bottom: 1rem;">&larr; Volver al Foro</a>
    
    <div class="thread-card" style="margin-top: 1rem; border-color: #FFCB05;">
        <div class="thread-avatar" style="width: 80px; height: 80px;">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Avatar">
        </div>
        <div class="thread-content">
            <h1 style="color: white; font-size: 2rem; margin-bottom: 0.5rem; margin-top: 0;">{{ $post->titulo }}</h1>
            <div class="thread-meta">
                <span>Por <strong style="color:white;">{{ $post->user->name }}</strong></span>
                @if($post->user->email === 'admin@pokemon.com')
                    <span class="badge-admin">Admin</span>
                @endif
                <span><i class="fas fa-clock"></i> {{ $post->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div class="post-body">
                {!! nl2br(e($post->contenido)) !!}
            </div>
        </div>
    </div>

    <h2 style="color: #FFCB05; margin-top: 2rem; margin-bottom: 1rem;">Comentarios ({{ $post->comments->count() }})</h2>

    @if(session('success'))
        <div style="background: #4ade80; color: #064e3b; padding: 1rem; border-radius: 10px; margin-bottom: 1rem; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <div class="comments-list">
        @forelse($post->comments as $comment)
            <div class="comment-card">
                <div class="thread-avatar" style="width: 40px; height: 40px; border-width: 1px;">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Avatar">
                </div>
                <div class="thread-content">
                    <div class="thread-meta" style="margin-bottom: 0.5rem;">
                        <strong style="color: white;">{{ $comment->user->name }}</strong>
                        @if($comment->user->email === 'admin@pokemon.com')
                            <span class="badge-admin">Admin</span>
                        @endif
                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div style="color: #f1f5f9; line-height: 1.4;">
                        {!! nl2br(e($comment->contenido)) !!}
                    </div>
                </div>
            </div>
        @empty
            <p style="color: #cbd5e1; font-style: italic;">No hay comentarios todavía.</p>
        @endforelse
    </div>

    <form action="{{ route('comunidad.comments.store', $post->id) }}" method="POST" class="form-comunidad" style="margin-top: 2rem;">
        @csrf
        <div class="form-group">
            <label for="contenido">Añadir un comentario</label>
            <textarea id="contenido" name="contenido" rows="3" required placeholder="Opina sobre este hilo..."></textarea>
        </div>
        <button type="submit" class="btn-comunidad" style="align-self: flex-start;">Enviar Comentario</button>
    </form>
</div>
@endsection
