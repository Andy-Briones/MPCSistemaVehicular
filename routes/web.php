<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('vehiculos', 'App\Http\Controllers\mpcsvehiculoController');
Route::resource('conductores', 'App\Http\Controllers\mpcsconductorController');
Route::resource('controles', 'App\Http\Controllers\mpcscontrolController');
Route::resource('caracteristicas', 'App\Http\Controllers\CaracteristicaController');