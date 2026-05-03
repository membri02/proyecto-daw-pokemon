@extends('layouts.app')

@section('content')
@vite(['resources/css/admin.css'])

<div class="admin-wrapper">
    <header class="admin-header">
        <h1 class="admin-title">Gestión de Usuarios</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn-admin btn-admin-secondary">← Volver al Panel</a>
            <a href="{{ route('admin.users.create') }}" class="btn-admin btn-admin-success">+ Nuevo Usuario</a>
        </div>
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

    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Monedas</th>
                    <th>Cartas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td><strong>#{{ $user->id }}</strong></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{ $user->monedas }} 
                        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" style="width:16px; vertical-align:middle;">
                    </td>
                    <td>{{ $user->cartas_count }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-admin btn-admin-primary" style="padding: 6px 12px; font-size: 0.85rem;">Editar</a>
                        
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario? Todo su progreso y cartas se perderán.');" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-admin btn-admin-danger" style="padding: 6px 12px; font-size: 0.85rem;" {{ $user->email === 'admin@pokemon.com' ? 'disabled' : '' }}>
                                Borrar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
