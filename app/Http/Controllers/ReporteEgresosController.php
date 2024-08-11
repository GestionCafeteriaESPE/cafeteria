<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Egreso;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteEgresosController extends Controller
{
    public function generarPDF(Request $request)
    {
        // Obtener el año filtrado (o el año actual si no se selecciona)
        $year = $request->input('year', now()->year);

        // Obtener los egresos filtrados por año y agrupar por mes
        $egresos = Egreso::select(DB::raw('MONTH(fecha_Egr) as mes'), DB::raw('SUM(cantidad_Egr) as total'))
            ->whereYear('fecha_Egr', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->mapWithKeys(function ($total, $mes) {
                return [date('F', mktime(0, 0, 0, $mes, 10)) => $total];
            });

        // Datos para pasar a la vista PDF
        $data = [
            'year' => $year,
            'egresos' => $egresos,
            'logo' => asset('imagenes/Logo.png'), // Ruta del logo
            'titulo' => 'Reporte de Egresos',
            'empresa' => 'Elias Cafeteria'
        ];

        // Generar el PDF desde una vista
        $pdf = PDF::loadView('pdf.reporte-egresos', $data);

        // Retornar el PDF para descargar
        return $pdf->download('reporte-egresos.pdf');
    }
}
