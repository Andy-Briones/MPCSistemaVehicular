<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpcscontrol extends Model
{
    //
    protected $table = 'mpcscontrols';
    public function vehiculo()
    {
        return $this->belongsTo(mpcsvehiculo::class, 'mpcsvehiculo_id', 'id');
    }
}
