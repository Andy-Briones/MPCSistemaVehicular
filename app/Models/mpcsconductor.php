<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpcsconductor extends Model
{
    //
    protected $table = 'mpcsconductors';
    public function vehiculo()
    {
        return $this->hasMany(mpcsvehiculo::class);
    }
}
