<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Aquí puedes pasar datos a tu vista, como información del usuario, estadísticas, etc.
        return view('dashboard.index');
    }
}
