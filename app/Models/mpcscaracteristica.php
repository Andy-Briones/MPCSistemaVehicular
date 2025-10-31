<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mpcscaracteristica extends Model
{
    //
    use HasFactory;

    protected $table = 'mpcscaracteristicas';

    protected $fillable = [
        'nombre',
        'asientos',
        'pasajeros',
        'ruedas',
        'ejes',
        'cilindors',
        'longitud',
        'altura',
        'ancho',
        'cilindrada',
        'pesoBruto',
        'pesoNeto',
        'cargaUtil',
    ];

    public function vehiculo()
    {
        return $this->hasMany(mpcsvehiculo::class);
    }
}
