<?php

namespace App\Http\Controllers;
use App\Models\Solicitudes;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        $user = Auth::user();

    // // Verifica si el usuario es gerente general o asesor
    // if ($user->roles->pluck('name')->contains('gerente general') || $user->roles->pluck('name')->contains('asesor')) {
    //     // Obtener todas las solicitudes
    //     $solicitudes = Solicitudes::all();
    // } else {
    //     // Obtener solo las solicitudes del usuario
    //     $solicitudes = Solicitudes::where('user_id', $user->id)->get();
    // }

    if ($user->roles->contains('name', 'asesor')) {
        // Para asesor, mostrar todas las solicitudes
        $solicitudes = Solicitudes::all();
    } elseif ($user->roles->contains('name', 'gerente general')) {
        // Para gerente general, mostrar las solicitudes 'enviadas'
        $solicitudes = Solicitudes::where('estado_solicitud', 'enviada')->get();
    } else {
        // Para otros usuarios, mostrar solo sus solicitudes
        $solicitudes = Solicitudes::where('user_id', $user->id)->get();
    }

    return view('solicitudes.index', compact('solicitudes'));
        // $solicitudes = Solicitudes::all(); // Obtener todas las solicitudes
        // return view('solicitudes.index', compact('solicitudes'));

        // Obtiene el ID del usuario autenticado
        // $userId = Auth::id();

        // // Obtiene solo las solicitudes que pertenecen al usuario autenticado
        // $solicitudes = Solicitudes::where('user_id', $userId)->get();

        // return view('solicitudes.index', compact('solicitudes'));
       
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

      // Preparar datos para la nueva solicitud
        $data = $request->all();
        $data['user_id'] = Auth::id(); // Asigna el ID del usuario autenticado
        $data['estado_solicitud'] = 'pendiente'; // Valor por defecto para el estado
    
    // Crear nueva solicitud esto es hacerlo manualmente
    //   $solicitud = new Solicitudes;
    //   $solicitud->cliente_solicitante = $request->cliente_solicitante;
    //   $solicitud->valor_credito = $request->valor_credito;
    //   $solicitud->cuotas_solicitadas = $request->cuotas_solicitadas;
    //   $solicitud->descripcion = $request->descripcion;
    //   $solicitud->estado_solicitud = 'pendiente';
    //   $solicitud->fecha_solicitud = $request->fecha_solicitud;
    //   $solicitud->tipo_credito = $request->tipo_credito;
    //   $solicitud->observaciones_asesor = $request->observaciones_asesor;

    // Crear nueva solicitud //Laravel automáticamente crea una nueva instancia de Solicitudes
    $solicitud = Solicitudes::create($data);
   
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
        'cuotas' => $request->cuotas_solicitadas, 
        'descripcion' => $request->descripcion,
        'estado' => $request->estado_solicitud, 
        'fecha_solicitud' => $request->fecha_solicitud,
        'tipo_credito' => $request->tipo_credito,
        'observaciones' => $request->observaciones_asesor 
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

public function enviar($id)
{
    $solicitud = Solicitudes::find($id);
    $solicitud->estado_solicitud = 'enviada';
    $solicitud->save();

    return redirect()->back()->with('status', 'Solicitud enviada al Gerente General');
}

public function actualizarObservaciones(Request $request, $solicitudId)
{
    $solicitud = Solicitudes::findOrFail($solicitudId);
    $solicitud->observaciones_asesor = $request->observaciones_asesor;
    $solicitud->estado_solicitud = 'enviada'; // Cambia el estado a 'enviada'
    $solicitud->save();

    // Redirige al índice con un mensaje
    return redirect()->route('solicitudes.index')->with('success', 'Observaciones guardadas y solicitud enviada al gerente general.');
}


//     public function show($id)
// {
//     $solicitud = Solicitudes::findOrFail($id); // Reemplaza 'Solicitud' con tu modelo de solicitud
//     return view('solicitudes.detail', compact('solicitud'));
// }

}
