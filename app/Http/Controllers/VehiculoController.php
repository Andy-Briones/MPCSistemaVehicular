<?php

namespace App\Http\Controllers;

use App\Models\mpcscaracteristica;
use App\Models\mpcsconductor;
use App\Models\mpcsvehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    //
    public function index()
    {
        $vehiculo['mpcsvehiculos'] = mpcsvehiculo::paginate(5);
        return view('vehiculo.index', $vehiculo);
    }
    public function create()
    {
        $caracteristica = mpcscaracteristica::all();   // todas las categorías
        $conductor = mpcsconductor::all();   // todos los proveedores

        return view('vehiculo.create', [
            'Modo' => 'crearV',
            'caracteristica' => $caracteristica,
            'conductor' => $conductor
        ]);
    }
    public function store(Request $request)
    {
        $vehiculo = request()->except('_token');
        mpcsvehiculo::insert($vehiculo);
        return redirect('vehiculos');//->with('mensaje', 'Categoría agregada con éxito');
    }
    public function show()
    {
        
    }
    public function edit($id)
    {
        $vehiculo = mpcsvehiculo::findOrFail($id);
        $caracteristica = mpcscaracteristica::all();   // categorías
        $conductor = mpcsconductor::all();           // proveedores
        
        return view('vehiculo.edit', [
        'vehiculo' => $vehiculo,
        'caracteristica' => $caracteristica,
        'conductor' => $conductor,
        'Modo' => 'editarV'
        ]);
    }
    public function update(Request $request, $id)
    {
        $vehiculo = request()->except(['_token', '_method']);
        mpcsvehiculo::where('id', '=', $id)->update($vehiculo);
        return redirect()->route('vehiculo.index');
    }
    public function destroy($id)
    {
        
    }
}
