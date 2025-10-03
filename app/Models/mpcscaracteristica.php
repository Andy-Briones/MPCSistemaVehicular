<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpcscaracteristica extends Model
{
    //
    public function Vehiculo()
    {
        return $this->hasMany(mpcsvehiculo::class);
    }
}
