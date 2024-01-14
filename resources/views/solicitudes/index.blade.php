@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Solicitudes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Valor de Crédito</th>
                <th>Cuotas</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de Solicitud</th>
                <th>Tipo de Crédito</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->cliente_solicitante }}</td>
                <td>{{ $solicitud->valor_credito }}</td>
                <td>{{ $solicitud->cuotas_solicitadas }}</td>
                <td>{{ $solicitud->descripcion }}</td>
                <td>{{ $solicitud->estado }}</td>
                <td>{{ $solicitud->fecha_solicitud }}</td>
                <td>{{ $solicitud->tipo_credito }}</td>
                <td>
                    <a href="{{ route('credito.show', $solicitud->id) }}" class="btn btn-success">Detalle</a>
                    <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class="btn btn-success">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
