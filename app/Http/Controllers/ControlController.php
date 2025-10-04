<?php

namespace App\Http\Controllers;

use App\Models\mpcscontrol;
use App\Models\mpcsvehiculo;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = MpcsControl::with(['vehiculo.conductor']);

        if ($request->filled('search')) {
        $search = $request->input('search');
        $query->whereHas('vehiculo', function($q) use ($search) {
            $q->where('placaActual', 'like', "%{$search}%");
        });
    }

    $mpcscontrols = $query->paginate(10);

    return view('control.index', compact('mpcscontrols'));
    }
    public function create()
    {
        $vehiculos = mpcsvehiculo::all();   // todos los vehiculos

        return view('control.create', [
            'Modo' => 'crearControl',
            'vehiculos' => $vehiculos
        ]);
    }
    public function store(Request $request)
    {
        $control = request()->except('_token');
        mpcscontrol::insert($control);
        return redirect('/');//->with('mensaje', 'Vehiculo agregado con éxito');
    }
    public function show()
    {
        
    }
    public function edit($id)
    {
        $control = mpcscontrol::findOrFail($id);
        $vehiculos = mpcsvehiculo::all();   // vehiculos
        
        return view('control.edit', [
        'control' => $control,
        'vehiculos' => $vehiculos,
        'Modo' => 'editarControl'
        ]);
    }
    public function update(Request $request, $id)
    {
        $control = request()->except(['_token', '_method']);
        mpcscontrol::where('id', '=', $id)->update($control);
        return redirect()->route('control.index');
    }
    public function destroy($id)
    {
        
    }
}
