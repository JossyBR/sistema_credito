@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Usuario</h2>
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

            @role('super administrador') 
            <div class="form-group">
                <label for="role">Rol</label>
                <select class="form-control" id="role" name="role">
                    <option>Seleccione</option>
                    <option value="asesor">Asesor</option>
                    <option value="gerente general">Gerente General</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>
            <input type="hidden" name="is_superadmin" value="true">
            @else
            <input type="hidden" name="is_superadmin" value="false">
            @endrole

            <button type="submit" class="btn btn-primary">Crear Usuario</button>
        </form>
    </div>
@endsection
