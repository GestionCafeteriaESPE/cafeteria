<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class pedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();

        if ($pedidos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron pedidos.',
                'status' => 200
            ];
            return response()->json($data, 404);
        }
        $data = [
            'pedidos' => $pedidos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
