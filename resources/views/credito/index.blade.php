@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Créditos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Número de Cuenta</th>
                <th>Valor del Crédito</th>
                <th>Número de Cuotas</th>
                <th>Valor de Cuota</th>
                <th>Cliente Solicitante</th>
                <th>Fecha de Aprobación</th>
                <th>Nombre Quien Aprueba</th>
                <th>Tipo de Crédito</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($creditos as $credito)
            <tr>
                <td>{{ $credito->numero_cuenta }}</td>
                <td>{{ $credito->valor_credito }}</td>
                <td>{{ $credito->numero_cuotas }}</td>
                <td>{{ $credito->valor_cuota }}</td>
                <td>{{ $credito->cliente_solicitante }}</td>
                <td>{{ $credito->fecha_aprobacion }}</td>
                <td>{{ $credito->aprobador }}</td>
                <td>{{ $credito->tipo_credito }}</td>
                <td>{{ $credito->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


