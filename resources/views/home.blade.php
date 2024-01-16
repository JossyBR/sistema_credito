@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido al Panel de Control') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>¡Hola, <strong>{{ Auth::user()->name }}</strong>! Has iniciado sesión correctamente.</p>
                    <p>Explora las funcionalidades del sistema de gestión de créditos y comienza a administrar tus procesos hoy mismo.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
