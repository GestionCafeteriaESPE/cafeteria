<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\Egreso;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EgresosStat extends BaseWidget
{
    protected function getStats(): array
    {
        $totalEgresos = Egreso::sum('cantidad_Egr');
        return[
            Stat::make('Total de Gastos', "$" . number_format($totalEgresos, 2)),
        ];

    }
}
