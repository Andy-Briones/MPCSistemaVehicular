<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpcscontrol extends Model
{
    //
    public function vehiculo()
    {
        return $this->belongsTo(mpcsvehiculo::class);
    }
}
