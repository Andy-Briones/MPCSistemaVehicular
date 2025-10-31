<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

it('mide el tiempo de respuesta del listado de vehículos', function () {
    $start = microtime(true);

    $response = $this->get(route('vehiculos.index'));
    $response->assertStatus(200);

    $duration = microtime(true) - $start;
    expect($duration)->toBeLessThan(1.5); // máximo 1.5 segundos
});

it('verifica que la consulta de vehículos no ejecute demasiadas queries', function () {
    DB::enableQueryLog();

    $this->get(route('vehiculos.index'))->assertStatus(200);

    $queryCount = count(DB::getQueryLog());
    expect($queryCount)->toBeLessThan(10); // puedes ajustar este valor
});
