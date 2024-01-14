@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle de Solicitud</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h3>Información de la Solicitud</h3>
            <p><strong>Cliente Solicitante:</strong> {{ $solicitud->cliente_solicitante }}</p>
            <p><strong>Valor del Crédito Solicitado:</strong> {{ $solicitud->valor_credito }}</p>
            <p><strong>Cuotas:</strong> {{ $solicitud->cuotas }}</p>
            <p><strong>Descripción:</strong> {{ $solicitud->descripcion }}</p>
            <p><strong>Estado:</strong> {{ $solicitud->estado }}</p>
            <p><strong>Tipo de Crédito:</strong> {{ $solicitud->tipo_credito }}</p>
        </div>
    </div>

    <h3>Detalles del Crédito</h3>
    <form method="POST" action="{{ route('credito.store') }}">
        @csrf
        <!-- Campos del Crédito... -->
        <input type="hidden" name="solicitud_id" value="{{ $solicitud->id }}">
        <div class="form-group">
            <label for="numero_cuenta">Número de Cuenta</label>
            <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta">
        </div>
       
        <div class="form-group">
            <label for="valor_credito">Valor del Credito</label>
            <input type="hidden" class="form-control" id="valor_credito" name="valor_credito" value="{{ $solicitud->valor_credito }}">
            <p>{{ $solicitud->valor_credito }}</p>
        </div>
        <div class="form-group">
            <label for="numero_cuotas">Número de Cuotas</label>
            <input type="text" class="form-control" id="numero_cuotas" name=numero_cuotas">
        </div>
        <div class="form-group">
            <label for="valor_cuota">Valor de Cuotas</label>
            <input type="text" class="form-control" id="valor_cuota" name=valor_cuota">
        </div>
        <div class="form-group">
            <label for="cliente_solicitante">Cliente que solicita</label>
            <input type="hidden" class="form-control" id="cliente_solicitante" name="cliente_solicitante" value="{{ $solicitud->cliente_solicitante }}">
            <p>{{ $solicitud->cliente_solicitante }}</p>
        </div>
        <div class="form-group">
            <label for="fecha_aprobacion">Fecha</label>
            <input type="date" class="form-control" id="fecha_aprobacion" name="fecha_aprobacion" required>
        </div>
        <div class="form-group">
            <label for="aprobador">Nombre Quien aprueba</label>
            <input type="text" class="form-control" id="aprobador" name="aprobador" required>
        </div>

        <div class="form-group">
            <label for="tipo_credito">Tipo de credito</label>
            <input type="hidden" class="form-control" id="tipo_credito" name="tipo_credito" value="{{ $solicitud->tipo_credito }}">
            <p>{{ $solicitud->tipo_credito }}</p>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Crear credito</button>
        </div>
        

    </form>
  
</div>
@endsection

<!-- <div class="mt-4">
        <form method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Aprobado</button>
        </form>

        <form method="POST" >
            @csrf
            <button type="submit" class="btn btn-danger">No Aprobado</button>
        </form>
    </div> -->
