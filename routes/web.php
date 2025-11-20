<?php

use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ruta para ver vehículos de baja 
Route::get('/vehiculos/eliminado', [VehiculoController::class, 'vistaEliminados'])->name('vehiculos.eliminado');
Route::put('/vehiculos/{id}/eliminar', [VehiculoController::class, 'eliminados'])->name('vehiculos.eliminar');
Route::put('/vehiculos/restaurar/{id}', [VehiculoController::class, 'restaurar'])->name('vehiculos.restaurar');

// ruta para ver vehículos en mantenimiento 
Route::get('/vehiculos/mantenenido', [VehiculoController::class, 'vistaMantenidos'])->name('vehiculos.mantenidos');
Route::put('/vehiculos/{id}/mantener', [VehiculoController::class, 'mantener'])->name('vehiculos.mantener');
Route::put('/vehiculos/restaurar/{id}', [VehiculoController::class, 'restaurar'])->name('vehiculos.restaurar');


// ruta para descargar word y una vista previa
Route::get('/controles/{id}/descargar-word', [App\Http\Controllers\ControlController::class, 'descargarWord'])
-> name('controles.descargarword');
Route::get('controles/{id}/preview', [ControlController::class, 'previewWord'])->name('controles.preview');

Route::resource('vehiculos', 'App\Http\Controllers\VehiculoController');
Route::resource('conductores', 'App\Http\Controllers\ConductorController');
Route::resource('controles', 'App\Http\Controllers\ControlController');
Route::resource('caracteristicas', 'App\Http\Controllers\CaracteristicaController');

//Rutas Extras
Route::get('/contactanos', function () {
    return view('vistasextra.contactanos');
})->name('contactanos');
Route::get('/login', function () {
    return view('vistasextra.login');
})->name('login');
Route::get('/acceso-denegado', function () {
    return view('accesodenegado');
})->name('acceso.denegado');


//Inicio de sesion
// Login
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Usuarios (público)
// Registro público de clientes
Route::get('register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('register', [UserController::class, 'register'])->name('register.post');
