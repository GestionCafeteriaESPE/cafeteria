<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingresos;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteIngresosController extends Controller
{
    public function generarPDF(Request $request)
    {
        // Obtener el año filtrado (o el año actual si no se selecciona)
        $year = $request->input('year', now()->year);

        // Obtener los ingresos filtrados por año y agrupar por mes
        $ingresos = Ingresos::select(DB::raw('MONTH(fecha_ing) as mes'), DB::raw('SUM(cantidad_ing) as total'))
            ->whereYear('fecha_ing', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->mapWithKeys(function ($total, $mes) {
                return [date('F', mktime(0, 0, 0, $mes, 10)) => $total];
            });

        // Datos para pasar a la vista PDF
        $data = [
            'year' => $year,
            'ingresos' => $ingresos,
            'logo' => asset('imagenes/Logo.png'), // Ruta del logo
            'titulo' => 'Reporte de Ingresos',
            'empresa' => 'Elias Cafeteria'
        ];

        // Generar el PDF desde una vista
        $pdf = PDF::loadView('pdf.reporte-ingresos', $data);

        // Retornar el PDF para descargar
        return $pdf->download('reporte-ingresos.pdf');
    }
}
