<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Ingresos;
use Illuminate\Support\Facades\DB;

class ReporteIngresos extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Icono del menú
    protected static ?string $navigationLabel = 'Reporte de Ingresos'; // Etiqueta del menú
    protected static ?string $navigationGroup = 'Reportes'; // Grupo en el menú

    public $ingresos;

    public function mount()
    {
        // Obtener el año filtrado (o el año actual si no se selecciona)
        $year = request('year', now()->year);

        // Obtener los ingresos filtrados por año y agrupar por mes
        $this->ingresos = Ingresos::select(DB::raw('MONTH(fecha_ing) as mes'), DB::raw('SUM(cantidad_ing) as total'))
            ->whereYear('fecha_ing', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->mapWithKeys(function ($total, $mes) {
                return [date('F', mktime(0, 0, 0, $mes, 10)) => $total];
            });
    }

    protected static string $view = 'filament.pages.reporte-ingresos';
}
