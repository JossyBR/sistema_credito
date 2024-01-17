<?php

namespace App\Http\Controllers;
use App\Models\Credito;
use App\Models\Solicitudes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CreditoController extends Controller
{
    public function index() {
        $creditos = Credito::all();
        return view('credito.index', compact ('creditos'));


    }

    public function store(Request $request)
{
    // Validación de los datos comunes
    $request->validate([
        'numero_cuenta' => 'required',
        'numero_cuotas' => 'required|numeric',
        'valor_cuota' => 'required|numeric',
        'fecha_aprobacion' => 'required|date',
        'aprobador' => 'required',
        'tipo_credito' => 'required',
        'accion' => 'required|in:aprobar,rechazar',
        'solicitud_id' => 'required|exists:solicitudes,id'
    ]);

    // Dependiendo de la acción, se aprueba o rechaza el crédito
    if ($request->accion == 'aprobar') {
        // Crear el crédito
        $credito = new Credito([
            'numero_cuenta' => $request->numero_cuenta,
            'valor_credito' => $request->valor_credito,
            'numero_cuotas' => $request->numero_cuotas,
            'valor_cuota' => $request->valor_cuota,
            'cliente_solicitante' => $request->cliente_solicitante,
            'fecha_aprobacion' => $request->fecha_aprobacion,
            'aprobador' => $request->aprobador,
            'tipo_credito' => $request->tipo_credito,
            'solicitud_id' => $request->solicitud_id,
            'estado' => 'aprobado',
            
        ]);
        $credito->save();
        $mensaje = 'Crédito aprobado y creado con éxito';

        // Actualizar la solicitud correspondiente
        $solicitud = Solicitudes::find($request->solicitud_id);
        $solicitud->estado_solicitud = 'aprobado';
        $solicitud->save();

    } elseif ($request->accion == 'rechazar') {
        $solicitud = Solicitudes::find($request->solicitud_id);
        $solicitud->estado_solicitud = 'rechazado';
        $solicitud->save();
        $mensaje = 'Solicitud rechazada';
    }

    // Redireccionar 
    return redirect()->route('credito.index')->with('status', $mensaje);
}


//     public function store(Request $request)
// {
//     Log::info($request->all());
//     // Validación de los datos
//     $request->validate([
//         'numero_cuenta' => 'required',
//         'numero_cuotas' => 'required|numeric',
//         'valor_cuota' => 'required|numeric',
//         'fecha_aprobacion' => 'required|date',
//         'aprobador' => 'required',
//     ]);

//     // Crear el crédito
//     $credito = new Credito;
//     $credito->numero_cuenta = $request->numero_cuenta;
//     $credito->valor_credito = $request->valor_credito; 
//     $credito->numero_cuotas = $request->numero_cuotas;
//     $credito->valor_cuota = $request->valor_cuota;
//     $credito->cliente_solicitante = $request->cliente_solicitante;
//     $credito->fecha_aprobacion = $request->fecha_aprobacion;
//     $credito->aprobador = $request->aprobador;
//     $credito->tipo_credito = $request->tipo_credito;
                
//     $credito->save();

//     // Actualizar estado de la solicitud 
//     // $solicitud = Solicitudes::find($request->solicitud_id);
//     // $solicitud->estado = 'Procesado'; // Cambia el estado según tus necesidades
//     // $solicitud->save();

//     // Redireccionar 
//     return redirect()->route('credito.index')->with('status', 'Crédito creado con éxito');
// }

    public function show($id)
{
    $solicitud = Solicitudes::findOrFail($id); // Reemplaza 'Solicitud' con tu modelo de solicitud
    return view('credito.detail', compact('solicitud'));
}
  
}
