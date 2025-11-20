<?php

namespace App\Http\Controllers;

use App\Models\mpcscaracteristica;
use Illuminate\Http\Request;

class CaracteristicaController extends Controller
{
    //Seguridad de acceso
    public function __construct()
    {
        // Debe estar logueado
        $this->middleware('auth');

        // Solo roles admin o trabajador
        $this->middleware('role:admin,trabajador');
    }

    public function index()
    {
        $caracteristica['mpcscaracteristicas'] = mpcscaracteristica::paginate(5);
        return view('caracteristica.index', $caracteristica);
    }
    
    public function create()
    {
        return view('caracteristica.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'asientos' => 'required|integer|min:1|max:100',
            'pasajeros' => 'required|integer|min:1|max:100',
            'ruedas' => 'required|integer|min:2|max:20',
            'ejes' => 'required|integer|min:1|max:10',
            'cilindros' => 'required|integer|min:1|max:16',

            'longitud' => 'required|numeric|min:0|max:99999.99',
            'altura' => 'required|numeric|min:0|max:99999.99',
            'ancho' => 'required|numeric|min:0|max:99999.99',
            'cilindrada' => 'required|numeric|min:0|max:99999.999',
            'pesoBruto' => 'required|numeric|min:0|max:99999.999',
            'pesoNeto' => 'required|numeric|min:0|max:99999.999',
            'cargaUtil' => 'required|numeric|min:0|max:99999.999',
        ]);
        
        $caracteristica = request()->except('_token');
        mpcscaracteristica::insert($caracteristica);
        // Si la petición es AJAX, devuelve JSON
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        // Por compatibilidad si alguien envía normal
        return redirect()->back()->with('mensaje', 'Característica agregada');
    }
    public function show()
    {
        
    }
    public function edit($id)
    {
        $caracteristica = mpcscaracteristica::findOrFail($id);
        return view('caracteristica.edit', compact('caracteristica'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'asientos' => 'required|integer|min:1|max:100',
            'pasajeros' => 'required|integer|min:1|max:100',
            'ruedas' => 'required|integer|min:2|max:20',
            'ejes' => 'required|integer|min:1|max:10',
            'cilindros' => 'required|integer|min:1|max:16',

            'longitud' => 'required|numeric|min:0|max:99999.99',
            'altura' => 'required|numeric|min:0|max:99999.99',
            'ancho' => 'required|numeric|min:0|max:99999.99',
            'cilindrada' => 'required|numeric|min:0|max:99999.999',
            'pesoBruto' => 'required|numeric|min:0|max:99999.999',
            'pesoNeto' => 'required|numeric|min:0|max:99999.999',
            'cargaUtil' => 'required|numeric|min:0|max:99999.999',
        ]);

        $caracteristica = request()->except(['_token', '_method']);
        mpcscaracteristica::where('id', '=', $id)->update($caracteristica);
        return redirect()->route('caracteristica.index');
    }
    public function destroy($id)
    {
        
    }
}
