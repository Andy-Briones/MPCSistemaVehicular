<?php

use App\Models\mpcsvehiculo;
use App\Models\mpcsconductor;
use App\Models\mpcscaracteristica;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('puede listar vehículos activos', function () {
    // Crear un conductor
    $conductor = mpcsconductor::create([
        'nombre' => 'Juan Pérez',
        'licencia' => 'A-123456',
        'telefono' => '999999999',
        'categoriaLicencia' => 'A1',
        'area' => 'Transporte'
    ]);

    // Crear una característica
    $caracteristica = mpcscaracteristica::create([
        'nombre' => 'Sedán',
        'asientos' => 5,
        'pasajeros' => 5,
        'ruedas' => 4,
        'ejes' => 2,
        'cilindros' => 4,
        'longitud' => 4.50,
        'altura' => 1.40,
        'ancho' => 1.75,
        'cilindrada' => 1.600,
        'pesoBruto' => 1500.000,
        'pesoNeto' => 1200.000,
        'cargaUtil' => 300.000,
    ]);

    // Crear 3 vehículos activos manualmente
    for ($i = 1; $i <= 3; $i++) {
        mpcsvehiculo::create([
            'categoria' => 'Automóvil',
            'marca' => 'Toyota',
            'modelo' => 'Corolla ' . $i,
            'color' => 'Blanco',
            'numeroVin' => 'VIN123456789' . $i,
            'numeroMotor' => 'MOT987654321' . $i,
            'carroceria' => 'Sedán',
            'potencia' => '120HP',
            'formrod' => '4x2',
            'combustible' => 'Gasolina',
            'añoFabricacion' => '2020-01-01',
            'añoModelo' => '2021-01-01',
            'version' => 'LE',
            'placaActual' => 'ABC-12' . $i,
            'placaAnterior' => 'XYZ-45' . $i,
            'condicion' => 'Bueno',
            'Estado' => 'activo',
            'mpcscaracteristica_id' => $caracteristica->id,
            'mpcsconductor_id' => $conductor->id,
        ]);
    }

    // Hacer la petición a la ruta index
    $response = $this->get(route('vehiculos.index'));

    // Validar la respuesta
    $response->assertStatus(200);
    $response->assertSee('Vehículo'); // texto que esperas ver en la vista
});
