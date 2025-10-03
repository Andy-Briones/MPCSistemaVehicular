<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpcscontrol extends Model
{
    //
    public function Vehiculo()
    {
        return $this->belongsTo(mpcsvehiculo::class);
    }
}
