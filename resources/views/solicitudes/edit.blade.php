@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar solicitud</h2>
    <form method="POST" action="{{ route('solicitudes.update', $solicitud->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cliente_solicitante">Cliente que solicita</label>
            <input type="text" class="form-control" id="cliente_solicitante" name="cliente_solicitante" value="{{ $solicitud->cliente_solicitante }}" required>
        </div>

        <div class="form-group">
            <label for="valor_credito">Valor de crédito que solicita</label>
            <input type="number" class="form-control" id="valor_credito" name="valor_credito" value="{{ $solicitud->valor_credito }}" required>
        </div>
        <div class="form-group">
            <label for="cuotas_solicitadas">Cuotas que solicita</label>
            <input type="number" class="form-control" id="cuotas_solicitadas" name="cuotas_solicitadas" value="{{ $solicitud->cuotas_solicitadas }}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" value="{{ $solicitud->descripcion }}" required></textarea>
        </div>
        <div class="form-group">
            <label for="estado_solicitud">Estado de la solicitud</label>
            <select class="form-control" id="estado_solicitud" name="estado_solicitud" value="{{ $solicitud->estado }}">
                <option value="pendiente">Pendiente</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_solicitud">Fecha de solicitud</label>
            <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" value="{{ $solicitud->fecha_solicitud }}" required>
        </div>
        <div class="form-group">
    <label for="tipo_credito">Tipo de crédito</label>
    <select class="form-control" id="tipo_credito" name="tipo_credito" value="{{ $solicitud->tipo_credito }}" required>
        <option value="">Selecciona</option>
        <option value="Libre Inversión">Libre Inversión</option>
        <option value="Vivienda">Vivienda</option>
    </select>
</div>
        <button type="submit" class="btn btn-primary">Editar Solicitud</button>
    </form>
</div>
@endsection