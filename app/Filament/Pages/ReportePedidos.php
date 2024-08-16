<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class ReportePedidos extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Icono del menú
    protected static ?string $navigationLabel = 'Reporte de Pedidos'; // Etiqueta del menú
    protected static ?string $navigationGroup = 'Reportes'; // Grupo en el menú
    protected static ?int $sort = 12;
    
    public $pedidos;

    public function mount()
    {
        // Obtener el año filtrado (o el año actual si no se selecciona)
        $year = request('year', now()->year);

        // Obtener los pedidos filtrados por año y agrupar por mes
        $this->pedidos = Pedido::select(DB::raw('MONTH(fecha_ped) as mes'), DB::raw('COUNT(*) as total'))
            ->whereYear('fecha_ped', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->mapWithKeys(function ($total, $mes) {
                return [date('F', mktime(0, 0, 0, $mes, 10)) => $total];
            });
    }

    protected static string $view = 'filament.pages.reporte-pedidos';
}
