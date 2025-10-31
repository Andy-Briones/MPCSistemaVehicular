<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mpcsconductor extends Model
{
    //
    use HasFactory;
    protected $table = 'mpcsconductors';

    protected $fillable = [
        'nombre',
        'licencia',
        'telefono',
        'categoriaLicencia',
        'area',
    ];

    public function vehiculo()
    {
        return $this->hasMany(mpcsvehiculo::class);
    }
}
