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
        return view('productsGeneral.productCategorys.index', $categories);
    }
}
