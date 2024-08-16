<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\clienteController;
use App\Http\Controllers\Api\productoController;
use App\Http\Controllers\Api\pedidoController;


Route::get('/clientes', [clienteController::class,'index']);
Route::post('/clientes', [clienteController::class,'guardar']);
Route::get('/clientes/{cedula_cli}', [clienteController::class,'buscar']);

Route::get('/productos', [productoController::class,'index']);

Route::get('/pedidos', [pedidoController::class,'index']);




