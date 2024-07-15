<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\Egreso;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Facades\DB;

class EgresostWidget extends LineChartWidget
{
    protected static ?string $heading = 'Gasto por Fecha';

    protected function getData(): array
    {
        $egresos = Egreso::select(DB::raw('DATE(fecha_Egr) as date'), DB::raw('SUM(cantidad_Egr) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Egresos', 
                    'data' => $egresos->pluck('total')->toArray(),     
                ],
            ],
            'labels' => $egresos->pluck('date')->map(fn($date) => date('Y/m/d', strtotime($date)))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
