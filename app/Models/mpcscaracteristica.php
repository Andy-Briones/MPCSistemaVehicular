<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mpcscaracteristica extends Model
{
    //
    use HasFactory;

    protected $table = 'mpcscaracteristicas';

    public function vehiculo()
    {
        return $this->hasMany(mpcsvehiculo::class);
    }
}
