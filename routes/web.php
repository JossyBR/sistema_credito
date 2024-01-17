<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\UserController;

// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard']);
// Route::get('/dashboard', 'DashboardController::class)->name('dashboard');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
// Route::get('/solicitudes', [SolicitudController::class, 'index']);

//solicitudes
Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
Route::get('/solicitudes/create', [SolicitudController::class, 'create'])->name('solicitudes.create');
Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
Route::get('/solicitudes/{id}/edit', [SolicitudController::class, 'edit'])->name('solicitudes.edit');
Route::put('/solicitudes/{id}', [SolicitudController::class, 'update'])->name('solicitudes.update');
Route::get('/solicitudes/{id}/delete', [SolicitudController::class, 'confirmDelete'])->name('solicitudes.delete');
Route::delete('/solicitudes/{id}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy');


//creditos
Route::get('/creditos', [CreditoController::class, 'index'])->name('credito.index');
Route::get('/solicitudes/{id}', [CreditoController::class, 'show'])->name('credito.show');
Route::post('/creditos', [CreditoController::class, 'store'])->name('credito.store');

//usuario asesor
Route::get('/users/create', [UserController::class, 'create'])->name('usuarios.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('usuarios.index');


// Rutas para el superadministrador
// Route::get('/admin/users/create', [UserController::class, 'createForAdmin']);
// Route::post('/admin/users', [UserController::class, 'storeForAdmin'])->name('admin.users.store');
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/admin/users/{id}/delete', [UserController::class, 'confirmDelete'])->name('usuarios.delete');

Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


