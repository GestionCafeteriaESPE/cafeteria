<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\Egreso;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EgresostWidget extends ChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Egresos';

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
        return 'bar';
    }
}
