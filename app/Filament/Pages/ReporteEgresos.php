<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Egreso;
use Illuminate\Support\Facades\DB;

class ReporteEgresos extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Icono del menú
    protected static ?string $navigationLabel = 'Reporte de Egresos'; // Etiqueta del menú
    protected static ?string $navigationGroup = 'Reportes'; // Grupo en el menú
    protected static ?int $sort = 11;

    public $egresos;

    public function mount()
    {
        // Obtener el año filtrado (o el año actual si no se selecciona)
        $year = request('year', now()->year);

        // Obtener los egresos filtrados por año y agrupar por mes
        $this->egresos = Egreso::select(DB::raw('MONTH(fecha_Egr) as mes'), DB::raw('SUM(cantidad_Egr) as total'))
            ->whereYear('fecha_Egr', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->mapWithKeys(function ($total, $mes) {
                return [date('F', mktime(0, 0, 0, $mes, 10)) => $total];
            });
    }

    protected static string $view = 'filament.pages.reporte-egresos';
}
