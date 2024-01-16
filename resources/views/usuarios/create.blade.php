@extends('layouts.app')

@section('content')
    @role('gerente general')
    <div class="container">
        <h2>Crear asesores</h2>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>    

            <button type="submit" class="btn btn-primary">Crear asesor</button>
        </form>
    </div>
    @else
    <p>No tienes permiso para acceder a esta página.</p>
    @endrole
@endsection
