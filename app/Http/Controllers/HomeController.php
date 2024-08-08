<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
//use App\Models\Producto;  COMENTAR
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categorias = Categoria::with('productos')->get(); // Cargar categorías con sus productos
        return view('home', [
            'categorias' => $categorias
        ]);
    }
}