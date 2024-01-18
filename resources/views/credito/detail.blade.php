@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle de Solicitud</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h3>Información de la Solicitud</h3>
            <p><strong>Cliente Solicitante:</strong> {{ $solicitud->cliente_solicitante }}</p>
            <p><strong>Valor del Crédito Solicitado:</strong> {{ $solicitud->valor_credito }}</p>
            <p><strong>Cuotas:</strong> {{ $solicitud->cuotas_solicitadas }}</p>
            <p><strong>Descripción:</strong> {{ $solicitud->descripcion }}</p>
            <p><strong>Estado:</strong> {{ $solicitud->estado_solicitud }}</p>
            <p><strong>Tipo de Crédito:</strong> {{ $solicitud->tipo_credito }}</p>
            
            @if (Auth::user()->roles->contains('name', 'asesor') && $solicitud->estado_solicitud == 'pendiente')
                <form action="{{ route('solicitudes.actualizarObservaciones', $solicitud->id) }}" method="POST">
                    @csrf
                    <p><strong>Observaciones:</strong>
                        <textarea class="form-control" id="observaciones_asesor" name="observaciones_asesor">{{ $solicitud->observaciones_asesor }}</textarea>
                    </p>
                    <button type="submit" class="btn btn-success">Enviar al Gerente General</button>
                </form>
            @else
                {{-- Mostrar observaciones para el Gerente General y Asesor si la solicitud no está pendiente --}}
                <p><strong>Observaciones del Asesor:</strong> {{ $solicitud->observaciones_asesor }}</p>
            @endif

        </div>
    </div>
    <!-- @if (Auth::user()->roles->contains('name', 'asesor') && $solicitud->estado_solicitud == 'pendiente')
        <form action="{{ route('solicitudes.enviar', $solicitud->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Enviar al Gerente General</button>
        </form>
    @endif -->


    @role('gerente general')
    <h3>Detalles del Crédito</h3>
    <form method="POST" action="{{ route('credito.store') }}" id="formularioCredito">
        @csrf
        <!-- Campos del Crédito... -->
        <!-- <input type="hidden" name="solicitud_id" value="{{ $solicitud->id }}"> -->
        <div class="form-group">
            <label for="numero_cuenta">Número de Cuenta</label>
            <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta">
        </div>
       
        <div class="form-group">
            <label for="valor_credito">Valor del Credito</label>
            <input type="number" class="form-control" id="valor_credito" name="valor_credito" value="{{ $solicitud->valor_credito }}">
        </div>
        <div class="form-group">
            <label for="numero_cuotas">Número de Cuotas</label>
            <select class="form-control" id="numero_cuotas" name="numero_cuotas" onchange="calcularValorCuota()">
                <option >Seleccione</option>
                <option value="6">6</option>
                <option value="12">12</option>
                <option value="24">24</option>
                <option value="36">36</option>
            </select>
        </div>
        <div class="form-group">
            <label for="valor_cuota">Valor de Cuotas</label>
            <input type="text" class="form-control" id="valor_cuota" name="valor_cuota" readonly>
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
            <select class="form-control" id="tipo_credito" name="tipo_credito" onchange="calcularValorCuota()">
                <option value="Libre inversión">Libre inversión</option>
                <option value="Vivienda">Vivienda</option>
            </select>
            <!-- <input type="hidden" class="form-control" id="tipo_credito" name="tipo_credito" value="{{ $solicitud->tipo_credito }}">
            <p>{{ $solicitud->tipo_credito }}</p> -->
        </div>
        <input type="hidden" name="solicitud_id" value="{{ $solicitud->id }}">
        <input type="hidden" name="accion" id="accion" value="">
        <div>
            <!-- <button type="submit" class="btn btn-success">Crear credito</button> -->
            <button type="submit" class="btn btn-success" onclick="setAccion('aprobar')">Aprobado</button>
            <button type="submit" class="btn btn-success" onclick="setAccion('rechazar')">No Aprobado</button>
        </div>
       
        
        <!-- <script>
            function setAccion(accion) {
                document.getElementById('accion').value = accion;
            }
        </script> -->
        
        <script>
            function setAccion(accion) {
            document.getElementById('accion').value = accion;
            document.getElementById('formularioCredito').submit();
            }
    </script>

    <script>
        // function setAccion(accion) {
        //     document.getElementById('accion').value = accion;
        //     document.getElementById('formularioCredito').submit();
        // }

        function setAccion(accion) {
        document.getElementById('accion').value = accion;
        if (accion === 'rechazar') {
            // Deshabilitar los campos que no son necesarios para la acción 'rechazar'
            deshabilitarCamposAprobacion();
            // Enviar el formulario
            document.getElementById('formularioCredito').submit();
        }
    }

    function deshabilitarCamposAprobacion() {
        document.getElementById('numero_cuenta').disabled = true;
        document.getElementById('numero_cuotas').disabled = true;
        document.getElementById('valor_cuota').disabled = true;
        document.getElementById('fecha_aprobacion').disabled = true;
        document.getElementById('aprobador').disabled = true;
        document.getElementById('tipo_credito').disabled = true;
    }

        function calcularValorCuota() {
        var valorCredito = parseFloat(document.getElementById('valor_credito').value);
        var numeroCuotas = parseInt(document.getElementById('numero_cuotas').value);
        var tipoCredito = document.getElementById('tipo_credito').value;
        var interes = tipoCredito === 'Libre inversión' ? 0.025 : 0.013;

        if (!isNaN(valorCredito) && !isNaN(numeroCuotas) && tipoCredito) {
            var valorCuota = (valorCredito / numeroCuotas) * (1 + interes);
            document.getElementById('valor_cuota').value = valorCuota.toFixed(2);
        }
    }
    </script>

    </form>
    @endrole
  
</div>
@endsection


