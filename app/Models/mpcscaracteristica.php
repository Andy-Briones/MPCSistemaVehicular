<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpcscaracteristica extends Model
{
    //
    protected $table = 'mpcscaracteristicas';
    public function vehiculo()
    {
        return $this->hasMany(mpcsvehiculo::class);
    }
}
