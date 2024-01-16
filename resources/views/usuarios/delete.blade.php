@extends('layouts.app')

@section('content')
@role('super administrador') 
<div class="container d-flex flex-column align-items-center mt-5 vh-100">
    <h1>Eliminar Usuario</h1>
    <form method="POST" action="{{ route('users.destroy', $Id) }}" class="border p-5 rounded-4 w-50 mt-3">
        @csrf
        @method('DELETE')
        <input type="hidden" name="Id" value="{{ $Id }}"> 
        <p>¿Estás seguro que deseas eliminar este usuario?</p>
        <div class="text-center">
            <button type="submit" class="btn btn-dark w-25">Eliminar</button>
        </div>
    </form>
</div>
@else
<p>No tienes permiso para acceder a esta página.</p>
@endrole
@endsection
