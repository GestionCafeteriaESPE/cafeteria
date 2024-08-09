<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class clienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        if ($clientes->isEmpty()) {
            $data = [
                'message' => 'No se encontraron clientes.',
                'status' => 200
            ];
            return response()->json($data, 404);
        }
        $data = [
            'clientes' => $clientes,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function guardar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_cli' => 'required',
            'cedula_cli' => 'required|max:10',
            'email_cli' => 'required|email',
            'telefono_cli' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $cliente = Cliente::create([
            'nombre_cli' => $request->nombre_cli,
            'cedula_cli' => $request->cedula_cli,
            'email_cli' => $request->email_cli,
            'telefono_cli' => $request->telefono_cli
        ]);

        if (!$cliente) {
            $data = [
                'message' => 'Error al crear el cliente',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'cliente' => $cliente,
            'status' => 201
        ];
        return response()->json($cliente, 201);
    }

    public function buscar($cedula_cli){
        $cliente = Cliente::where('cedula_cli', $cedula_cli)->first();

        if(!$cliente){
            $data = [
                'message' => 'Cliente no encontrado.',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'cliente' => $cliente,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
