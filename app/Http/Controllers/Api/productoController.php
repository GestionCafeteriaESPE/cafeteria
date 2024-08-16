<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class productoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        if ($productos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron productos.',
                'status' => 200
            ];
            return response()->json($data, 404);
        }
        $data = [
            'productos' => $productos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
