<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view ('home', [
            'categorias'=>Categoria::all(),
            'productos'=>Producto::all()
        ]);
    }
}
