<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpcscontrol extends Model
{
    //
    protected $table = 'mpcscontrols';
    protected $fillable = [
        'soatInicial',
        'soatFinal',
        'revisionTecIn',
        'revisionTecFin',
        'tarjetaP',
        'lugarD',
        'mpcsvehiculo_id',
        'imagenSoat', // también este
        'imagenRev', // y este
    ];
    public function vehiculo()
    {
        return $this->belongsTo(mpcsvehiculo::class, 'mpcsvehiculo_id', 'id');
    }
}
