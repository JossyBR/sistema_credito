<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\CreditoController;

// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard']);
// Route::get('/dashboard', 'DashboardController::class)->name('dashboard');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
// Route::get('/solicitudes', [SolicitudController::class, 'index']);

//solicitudes
Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
Route::get('/solicitudes/create', [SolicitudController::class, 'create']);
// Route::get('/solicitudes/{id}', [SolicitudController::class, 'show'])->name('solicitudes.show');
Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');

//creditos
Route::get('/creditos', [CreditoController::class, 'index'])->name('credito.index');
Route::get('/solicitudes/{id}', [CreditoController::class, 'show'])->name('credito.show');
Route::post('/creditos', [CreditoController::class, 'store'])->name('credito.store');