@extends('layouts.app')

@section('content')
    @role('super administrador')
    <div class="container">
        <h2>Editar Usuario</h2>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}" required>
            </div>
            <div class="form-group">
        <label for="role">Rol</label>
        <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}" readonly>
    </div> 

            <button type="submit" class="btn btn-primary">Editar Usuario</button>
        </form>
    </div>
    @else
    <p>No tienes permiso para acceder a esta página.</p>
    @endrole
@endsection
