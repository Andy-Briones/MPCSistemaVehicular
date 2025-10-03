<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpcsvehiculo extends Model
{
    //
    protected $table = 'mpcsvehiculos';
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
