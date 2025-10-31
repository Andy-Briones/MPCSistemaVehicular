<?php

use App\Models\mpcsconductor;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('puede crear un nuevo conductor', function () {
    $data = [
        'nombre' => 'Juan Perez',
        'licencia' => 'A-123456',
        'telefono' => '999999999',
        'categoriaLicencia' => 'A1',
        'area' => 'Transporte'
    ];


    $response = $this->post('/conductores', $data);
    $response->assertRedirect('conductores');

    expect(mpcsconductor::count())->toBe(1);
});
