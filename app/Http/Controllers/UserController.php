<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;



use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        
        // return view('solicitudes.index');
        $users = User::all(); // Obtener todas las solicitudes
        return view('usuarios.index', compact('users'));
       
    }
    public function create()
    {
 
        // return view('usuarios.create');
        // if (!Gate::authorize('crear-asesores')) {
        //     abort(403, 'No tienes permiso para crear asesores.');
        // }
        // Mostrar formulario para crear asesores
        return view('usuarios.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

         // Asignar rol basado en el usuario que crea el nuevo usuario
    // if (Auth::user()->hasRole('superadministrador')) {
    //     // Asignar el rol seleccionado en el formulario
    //     $user->assignRole($request->role);
    // } else {
    //     // Si no es superadministrador, asignar el rol de 'asesor' por defecto
    //     $user->assignRole('asesor');
    // }

    if ($request->input('is_superadmin') === 'true') {
        // Asignar el rol seleccionado en el formulario
        $user->assignRole($request->input('role'));
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    } else {
        $user->assignRole('asesor');
        return redirect()->route('solicitudes.index')->with('success', 'Usuario creado correctamente.');
    }
    }
    
    // public function show(){
    //     return view('usuario.index');
    // }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('usuarios.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    // Validación de los datos del formulario
    $request->validate([
        'name' => 'required', 
        'email' => 'required',
        'password' => 'required',
    
    ]);

    // Busca la solicitud por su ID y actualízala con los nuevos datos
    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password   
    ]);
    return redirect()->route('usuarios.index')->with('success', 'Usuario modificado correctamente.');
}

public function confirmDelete($id)
{
    $user = User::findOrFail($id);
    return view('usuarios.delete', ['Id' => $user->id]);
}


public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
}
   
}
