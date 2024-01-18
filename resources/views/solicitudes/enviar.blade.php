@extends('layouts.app')


@section('content')
<div class="container d-flex flex-column align-items-center mt-5 vh-100">
    <h1>solicitud enviada.</h1>
    <form class="border p-5 rounded-4 w-50 mt-3">
        @csrf
        <input type="hidden" name="Id" value="{{ $Id }}"> 
        <p>Solicitud enviada con exito!!!</p>
        
    </form>
</div>
@endsection

