<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mpcsvehiculo extends Model
{
    Use HasFactory;
    //
    protected $table = 'mpcsvehiculos';

    protected $fillable=[
        'categoria',
        'marca',
        'modelo',
        'color',
        'numeroVin',
        'numeroMotor',
        'carroceria',
        'potencia',
        'formrod',
        'combustible',
        'añoFabricacion',
        'añoModelo',
        'version',
        'placaActual',
        'placaAnterior',
        'condicion',
        'Estado',
        'mpcscaracteristica_id',
        'mpcsconductor_id',
    ];
    public function conductor()
    {
        return $this->belongsTo(mpcsconductor::class, 'mpcsconductor_id', 'id');
    }
    public function caracteristica()
    {
        return $this->belongsTo(mpcscaracteristica::class, 'mpcscaracteristica_id', 'id');
    }
    public function control()
    {
        return $this->hasMany(mpcscontrol::class);
    }
}
