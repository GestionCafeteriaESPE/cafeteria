<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf; 
use Illuminate\Support\Facades\DB;

class ReportePedidosController extends Controller
{
    public function generarPDF(Request $request)
    {
        // Obtener el año filtrado (o el año actual si no se selecciona)
        $year = $request->input('year', now()->year);

        // Obtener los pedidos filtrados por año y agrupar por mes
        $pedidos = Pedido::select(DB::raw('MONTH(fecha_ped) as mes'), DB::raw('COUNT(*) as total'))
            ->whereYear('fecha_ped', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->mapWithKeys(function ($total, $mes) {
                return [date('F', mktime(0, 0, 0, $mes, 10)) => $total];
            });

        // Datos para pasar a la vista PDF
        $data = [
            'year' => $year,
            'pedidos' => $pedidos,
            'logo' => public_path('imagenes/Logo.png'), // Ruta completa al logo
            'titulo' => 'Reporte de Pedidos',
            'empresa' => 'ELIAS CAFETERIA'
        ];

        // Generar el PDF desde una vista
        $pdf = Pdf::loadView('pdf.reporte-pedidos', $data);

        // Retornar el PDF para descargar
        return $pdf->download('reporte-pedidos.pdf');
    }
}
