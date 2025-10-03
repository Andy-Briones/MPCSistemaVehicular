<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('vehiculos', 'App\Http\Controllers\VehiculoController');
Route::resource('conductores', 'App\Http\Controllers\ConductorController');
Route::resource('controles', 'App\Http\Controllers\ControlController');
Route::resource('caracteristicas', 'App\Http\Controllers\CaracteristicaController');