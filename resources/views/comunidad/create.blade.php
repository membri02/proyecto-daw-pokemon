@extends('layouts.app')

@section('content')
@vite(['resources/css/comunidad.css'])

<div class="comunidad-wrapper">
    <div class="comunidad-header">
        <h1>Crear Nuevo Hilo</h1>
        <a href="{{ route('comunidad.index') }}" class="btn-comunidad" style="background: #e2e8f0; color: #334155;">Cancelar</a>
    </div>

    <form action="{{ route('comunidad.store') }}" method="POST" class="form-comunidad">
        @csrf
        <div class="form-group">
            <label for="titulo">Título del Hilo</label>
            <input type="text" id="titulo" name="titulo" required placeholder="Ej: Busco intercambiar un Charizard">
        </div>
        
        <div class="form-group">
            <label for="contenido">Mensaje</label>
            <textarea id="contenido" name="contenido" rows="6" required placeholder="Escribe tu mensaje aquí..."></textarea>
        </div>

        <button type="submit" class="btn-comunidad" style="align-self: flex-start; font-size: 1.1rem; padding: 0.8rem 2rem;">Publicar Hilo</button>
    </form>
</div>
@endsection
