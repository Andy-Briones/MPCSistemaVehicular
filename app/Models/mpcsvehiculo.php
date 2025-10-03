<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpcsvehiculo extends Model
{
    //
    public function Conductor()
    {
        return $this->belongsTo(mpcsconductor::class);
    }
    public function Caracteristica()
    {
        return $this->belongsTo(mpcscaracteristica::class);
    }
    public function Control()
    {
        return $this->hasMany(mpcscontrol::class);
    }
}
