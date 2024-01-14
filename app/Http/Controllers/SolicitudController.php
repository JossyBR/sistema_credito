<?php

namespace App\Http\Controllers;
use App\Models\Solicitudes;

use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        // return view('solicitudes.index');
        $solicitudes = Solicitudes::all(); // Obtener todas las solicitudes
        return view('solicitudes.index', compact('solicitudes'));
       
    }
    public function create()
    {
        return view('solicitudes.create');
    }

    public function store(Request $request)
    {
      // Validar campos
      $request->validate([
        'cliente_solicitante' => 'required',
        'valor_credito' => 'required|numeric',
        'cuotas_solicitadas' => 'required',
        'descripcion' => 'required',
        'fecha_solicitud' => 'required|date',
        'tipo_credito' => 'required',
       
      ]);
    
      // Crear nueva solicitud
      $solicitud = new Solicitudes;
      $solicitud->cliente_solicitante = $request->cliente_solicitante;
      $solicitud->valor_credito = $request->valor_credito;
      $solicitud->cuotas_solicitadas = $request->cuotas_solicitadas;
      $solicitud->descripcion = $request->descripcion;
      $solicitud->estado_solicitud = $request->estado_solicitud;
      $solicitud->fecha_solicitud = $request->fecha_solicitud;
      $solicitud->tipo_credito = $request->tipo_credito;
      $solicitud->observaciones_asesor = $request->observaciones_asesor;
   
      $solicitud->save();
    
      // Redireccionar  
      return redirect()->route('solicitudes.index')->with('status', 'Solicitud creada exitosamente!');
    }

//     public function show($id)
// {
//     $solicitud = Solicitudes::findOrFail($id); // Reemplaza 'Solicitud' con tu modelo de solicitud
//     return view('solicitudes.detail', compact('solicitud'));
// }

}
