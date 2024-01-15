@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Usuarios</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td> 
                <td>{{ $user->role }}</td> 
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
