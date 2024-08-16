<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Filament\Http\Controllers\Auth\LogoutController;
use Livewire\Livewire;
use App\Livewire\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\ReporteIngresosController;
use App\Http\Controllers\ReporteEgresosController;
use App\Http\Controllers\ReportePedidosController;

Route::get('/counter', Counter::class);

Route::get('/', function (Request $request) {
    return app(HomeController::class)($request);
});

Livewire::setUpdateRoute(function($handle){
    return Route::post('/cafeteria/public/livewire/update',$handle);
});

//PDF
Route::get('/reporte-ingresos/pdf', [ReporteIngresosController::class, 'generarPDF'])->name('reporte.ingresos.pdf');
Route::get('/reporte-egresos/pdf', [ReporteEgresosController::class, 'generarPDF'])->name('reporte.egresos.pdf');
Route::get('/reporte-pedidos/pdf', [ReportePedidosController::class, 'generarPDF'])->name('reporte.pedidos.pdf');
