<?php

namespace App\Http\Controllers;

use App\Models\mpcsconductor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConductorController extends Controller
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
        $mpcsconductors  = mpcsconductor::paginate(5);
        //Alertas
        $alerta = [];
        foreach($mpcsconductors  as $conducto)
        {
            $hoy = Carbon::now();

            //Alerta de 10 dias con antelacion
            $avisoLice = (int)$hoy->diffInDays(Carbon::parse($conducto->vencimientoLice), false);

            //Revisamos si faln 10 días
            if($avisoLice <= 10 && $avisoLice >= 0)
            {
                $alerta[]=[
                    'Licencia' => 'Licencia',
                    'conductor' => $conducto->nombre ?? 'Desconocido',
                    'vence' => $conducto->vencimientoLice,
                    'dias' => $avisoLice,
                ];
            }
        }
        return view('conductor.index', compact('mpcsconductors', 'alerta'));
    }
    
    public function create()
    {
        return view('conductor.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:120',
            'dni' => 'required|digits:8|unique:mpcsconductors,dni',
            'licencia' => 'required|string|max:20|unique:mpcsconductors,licencia',
            'vencimientoLice' => 'nullable|date|after:today',
            'telefono' => 'required|digits:9',
            'categoriaLicencia' => 'required|string|max:10',
            'area' => 'required|string|max:150',
        ]);

        $conductor = request()->except('_token');
        mpcsconductor::insert($conductor);
        return redirect('conductores');//->with('mensaje', 'Categoría agregada con éxito');
    }
    public function show()
    {
        //no se usa
    }
    public function edit($id)
    {
        $conductor = mpcsconductor::findOrFail($id);
        return view('conductor.edit', compact('conductor'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:120',
            'dni' => 'required|digits:8|unique:mpcsconductors,dni',
            'licencia' => 'required|string|max:20|unique:mpcsconductors,licencia',
            'vencimientoLice' => 'nullable|date|after:today',
            'telefono' => 'required|digits:9',
            'categoriaLicencia' => 'required|string|max:10',
            'area' => 'required|string|max:150',
        ]);
        $conductor = request()->except(['_token', '_method']);
        mpcsconductor::where('id', '=', $id)->update($conductor);
        return redirect('conductores');
    }
    public function destroy($id)
    {
        
    }
}
