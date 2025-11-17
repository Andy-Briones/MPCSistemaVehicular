<?php

namespace App\Http\Controllers;

use App\Models\mpcscaracteristica;
use App\Models\mpcsconductor;
use App\Models\mpcsvehiculo;
use Faker\Guesser\Name;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    //Mostrar vehiculos que estan activos
    public function index()
    {
        $vehiculo['mpcsvehiculos'] = mpcsvehiculo::where('Estado','activo')->paginate(5);
        return view('vehiculo.index', $vehiculo);
    }
    public function create()
    {
        $caracteristica = mpcscaracteristica::all();   // todas las categorías
        $conductor = mpcsconductor::all();   // todos los conductores

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
        return redirect('vehiculos');
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
        return redirect()->route('vehiculos');
    }
    public function destroy($id)
    {

    }
    // Mostrar los vehículos inactivos
    public function vistaEliminados()
    {
        $vehiculo['mpcsvehiculos'] = mpcsvehiculo::where('Estado', 'inactivo')->paginate(5);
        return view('vehiculo.eliminado', $vehiculo);
    }
    // Mover vehículo a inactivos
    public function eliminados($id)
    {
        $vehiculo = mpcsvehiculo::findOrFail($id);
        $vehiculo->Estado = 'inactivo';
        $vehiculo->save();

        return redirect()->route('vehiculos.index')->with('mensaje', 'Vehículo movido a eliminados correctamente.');
    }
    //Restaurar vehiculo inactivo a activo
    public function restaurar($id)
    {
        $vehiculo = mpcsvehiculo::findOrFail($id);
        $vehiculo->Estado = 'activo';
        $vehiculo->save();

        return redirect()->route('vehiculos.eliminado')->with('mensaje', 'Vehículo restaurado correctamente.');
    }
    

    //Mostrar los vehiculos que estan en mantenimiento
    public function vistaMantenidos()
    {
        $vehiculo['mpcsvehiculos'] = mpcsvehiculo::where('Estado', 'mantenimiento')->paginate(5);
        return view('vehiculo.mantenimiento', $vehiculo);
    }
    //Mover vehiculo a mantenimiento
    public function mantener($id)
    {
        $vehiculo = mpcsvehiculo::findOrFail($id);
        $vehiculo->Estado = 'mantenimiento';
        $vehiculo->save();

        return redirect()->route('vehiculos.index')->with('mensaje', 'Vehículo movido a mantenimiento correctamente.');
    }
    //Restaurar vehiculo de mantenimiento a activo
    public function restaurarM($id)
    {
        $vehiculo = mpcsvehiculo::findOrFail($id);
        $vehiculo->Estado = 'activo';
        $vehiculo->save();

        return redirect()->route('vehiculos.mantenimiento')->with('mensaje', 'Vehículo restaurado correctamente.');
    }
}

