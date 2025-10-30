<?php

use App\Http\Controllers\ControlController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ruta para ver vehículos eliminados 
Route::get('/vehiculos/eliminado', [VehiculoController::class, 'vistaEliminados'])->name('vehiculos.eliminado');
Route::put('/vehiculos/{id}/eliminar', [VehiculoController::class, 'eliminados'])->name('vehiculos.eliminar');
Route::put('/vehiculos/restaurar/{id}', [VehiculoController::class, 'restaurar'])->name('vehiculos.restaurar');

// ruta para descargar word y una vista previa
Route::get('/controles/{id}/descargar-word', [App\Http\Controllers\ControlController::class, 'descargarWord'])
-> name('controles.descargarword');
Route::get('controles/{id}/preview', [ControlController::class, 'previewWord'])->name('controles.preview');

Route::resource('vehiculos', 'App\Http\Controllers\VehiculoController');
Route::resource('conductores', 'App\Http\Controllers\ConductorController');
Route::resource('controles', 'App\Http\Controllers\ControlController');
Route::resource('caracteristicas', 'App\Http\Controllers\CaracteristicaController');
