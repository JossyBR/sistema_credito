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
    //   $solicitud->estado_solicitud = $request->estado_solicitud;
      $solicitud->estado_solicitud = 'pendiente';
      $solicitud->fecha_solicitud = $request->fecha_solicitud;
      $solicitud->tipo_credito = $request->tipo_credito;
      $solicitud->observaciones_asesor = $request->observaciones_asesor;
   
      $solicitud->save();
    
      // Redireccionar  
      return redirect()->route('solicitudes.index')->with('status', 'Solicitud creada exitosamente!');
    }

    public function edit($id)
{
    $solicitud = Solicitudes::findOrFail($id);
    return view('solicitudes.edit', compact('solicitud'));
}

public function update(Request $request, $id)
{
    // Validación de los datos del formulario
    $request->validate([
        'cliente_solicitante' => 'required', // Ajusta las reglas según tus necesidades
        'valor_credito' => 'required|numeric',
        'cuotas_solicitadas' => 'required|numeric',
        'descripcion' => 'required',
        'estado_solicitud' => 'required',
        'fecha_solicitud' => 'required|date',
        'tipo_credito' => 'required',
        'observaciones_asesor' => 'nullable' // 'nullable' si el campo puede estar vacío
    ]);

    // Busca la solicitud por su ID y actualízala con los nuevos datos
    $solicitud = Solicitudes::findOrFail($id);
    $solicitud->update([
        'cliente_solicitante' => $request->cliente_solicitante,
        'valor_credito' => $request->valor_credito,
        'cuotas' => $request->cuotas_solicitadas, // Asegúrate de que el campo en la base de datos coincida
        'descripcion' => $request->descripcion,
        'estado' => $request->estado_solicitud, // Asegúrate de que el campo en la base de datos coincida
        'fecha_solicitud' => $request->fecha_solicitud,
        'tipo_credito' => $request->tipo_credito,
        'observaciones' => $request->observaciones_asesor // Asegúrate de que el campo en la base de datos coincida
    ]);

    // Redireccionar al usuario a la lista de solicitudes con un mensaje de éxito
    return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente.');
}


public function confirmDelete($id)
{
    $solicitud = Solicitudes::findOrFail($id);
    // return view('solicitudes.delete', compact('solicitud'));
    // Pasar la solicitud a la vista
    return view('solicitudes.delete', ['Id' => $solicitud->id]);
}

public function destroy($id)
{
    $solicitud = Solicitudes::findOrFail($id);
    $solicitud->delete();

    return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada correctamente.');
}




//     public function show($id)
// {
//     $solicitud = Solicitudes::findOrFail($id); // Reemplaza 'Solicitud' con tu modelo de solicitud
//     return view('solicitudes.detail', compact('solicitud'));
// }

}
