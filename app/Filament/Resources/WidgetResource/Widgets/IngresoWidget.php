<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\Ingresos;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class IngresoWidget extends ChartWidget
{
    protected static ?string $heading = 'Ingresos';

    protected function getData(): array
    {
        $ingresos = Ingresos::select(DB::raw('DATE(fecha_Ing) as date'), DB::raw('SUM(cantidad_Ing) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        return [
            'datasets' => [
                [
                    'label' => 'Ingresos', 
                    'data' => $ingresos->pluck('total')->toArray(),     
                ],
            ],
            'labels' => $ingresos->pluck('date')->map(fn($date) => date('Y/m/d', strtotime($date)))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
