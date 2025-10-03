<?php

namespace App\Http\Controllers;

use App\Models\mpcsconductor;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    //
    public function index()
    {
        $conductor['mpcsconductors'] = mpcsconductor::paginate(5);
        return view('conductor.index', $conductor);
    }
    
    public function create()
    {
        return view('conductor.create');
    }
    public function store(Request $request)
    {
        $conductor = request()->except('_token');
        mpcsconductor::insert($conductor);
        return redirect('conductores');//->with('mensaje', 'Categoría agregada con éxito');
    }
    public function show()
    {
        
    }
    public function edit($id)
    {
        $conductor = mpcsconductor::findOrFail($id);
        return view('conductor.edit', compact('conductor'));
    }
    public function update(Request $request, $id)
    {
        $conductor = request()->except(['_token', '_method']);
        mpcsconductor::where('id', '=', $id)->update($conductor);
        return redirect()->route('conductor.index');
    }
    public function destroy($id)
    {
        
    }
}
