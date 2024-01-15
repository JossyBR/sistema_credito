<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        return view('usuarios.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Usuario creado correctamente.');
    }
    
    // public function show(){
    //     return view('usuario.index');
    // }
}
