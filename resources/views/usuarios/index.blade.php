@extends('layouts.app')

@section('content')
@role('super administrador')  
    <div class="container">
        <h1>Usuarios</h1>
        <a href="{{ route('usuarios.create') }}" class="btn btn-success">Crear Usuario</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>
                        
                        <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-success">Editar</a>
                        <a href="{{ route('usuarios.delete', $user->id) }}" class="btn btn-danger">Eliminar</a>

                     </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
<p>No tienes permiso para acceder a esta página.</p>
@endrole
@endsection
