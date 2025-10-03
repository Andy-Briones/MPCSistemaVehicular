<?php

namespace App\Http\Controllers;

use App\Models\mpcscaracteristica;
use Illuminate\Http\Request;

class CaracteristicaController extends Controller
{
    //
    public function index()
    {
        $categories['product__categories'] = mpcscaracteristica::paginate(5);
        return view('caracteristica.index', $categories);
    }
    
    public function create()
    {
        return view('caracteristica.create');
    }
    public function store(Request $request)
    {
        $caracteristica = request()->except('_token');
        mpcscaracteristica::insert($caracteristica);
        return redirect('caracteristicas');//->with('mensaje', 'Categoría agregada con éxito');
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
        $caracteristica = request()->except(['_token', '_method']);
        mpcscaracteristica::where('id', '=', $id)->update($caracteristica);
        return redirect()->route('caracteristica.index');
    }
    public function destroy($id)
    {
        
    }
}
