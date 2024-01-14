@extends('layouts.app')


@section('content')
<div class="container d-flex flex-column align-items-center mt-5 vh-100">
    <h1>Eliminar Solicitud</h1>
    <form method="POST" action="{{ route('solicitudes.destroy', $Id) }}"   class="border p-5 rounded-4 w-50 mt-3">
        @csrf
        @method('DELETE')
        <input type="hidden" name="Id" value="{{ $Id }}"> 
        <p>¿Estás seguro que deseas eliminar esta solicitud?</p>
        <div class="text-center">
            <button type="submit" class="btn btn-dark w-25">Eliminar</button>
        </div>
    </form>
</div>
@endsection

