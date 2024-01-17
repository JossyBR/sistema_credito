@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Solicitudes de Credito</h1>
    <a href="/solicitudes/create" class="btn btn-success">Crear Solicitud</a>
    <a href="/creditos" class="btn btn-success">Ver Creditos</a>
    @if ($solicitudes->isEmpty())
        <p>No tienes solicitudes.</p>
    @else
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
                @hasanyrole('asesor|gerente general')
                <th>Acciones</th>
                @endhasanyrole
            </tr>
        </thead>
        <tbody>
            @foreach ($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->cliente_solicitante }}</td>
                <td>{{ $solicitud->valor_credito }}</td>
                <td>{{ $solicitud->cuotas_solicitadas }}</td>
                <td>{{ $solicitud->descripcion }}</td>
                <td>{{ $solicitud->estado_solicitud }}</td>
                <td>{{ $solicitud->fecha_solicitud }}</td>
                <td>{{ $solicitud->tipo_credito }}</td>
                <td>
                    @role('gerente general')
                    <a href="{{ route('credito.show', $solicitud->id) }}" class="btn btn-success">Estudiar Solicitud</a>
                    @endrole
                    @if(Auth::user()->hasRole('cliente') && $solicitud->user_id == Auth::id() && $solicitud->estado_solicitud === 'pendiente')
                            <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class="btn btn-success">Editar</a>
                            <a href="{{ route('solicitudes.delete', $solicitud->id) }}" class="btn btn-success">Eliminar</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
