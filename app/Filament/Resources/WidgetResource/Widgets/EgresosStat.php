<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\Egreso;
use App\Models\Ingresos;
use App\Models\Pedido;
use App\Models\PeDetalle;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EgresosStat extends BaseWidget
{
    protected function getStats(): array
    {
        $totalEgresos = Egreso::sum('cantidad_Egr');
        $totalIngresos = Ingresos::sum('cantidad_Ing');
        $totalPedidos = PeDetalle::sum('subtotal_pdet');

        return[
            Stat::make('Total de Egresos', "$" . number_format($totalEgresos, 2)),
            Stat::make('Total de Ingresos', "$" . number_format($totalIngresos, 2)),
            Stat::make('Total de Subtotales de Pedidos', "$" . number_format($totalPedidos, 2)),
        ];

    }
}
