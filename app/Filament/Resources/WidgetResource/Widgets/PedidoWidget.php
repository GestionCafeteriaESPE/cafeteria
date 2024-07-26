<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\PeDetalle;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PedidoWidget extends ChartWidget
{
    protected static ?string $heading = 'Pedidos por Día';

    protected function getData(): array
    {
        $totalPedido = PeDetalle::join('pedidos', 'pedidos.id', '=', 'pe_detalles.id_ped')
            ->select(DB::raw('DAYNAME(pedidos.fecha_ped) as day'), DB::raw('SUM(pe_detalles.cantidad_pdet * pe_detalles.precio_pdet) as total'))
            ->groupBy('day')
            ->orderBy(DB::raw('FIELD(day, "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday")'), 'asc')
            ->get();
            
        $daysInSpanish = $totalPedido->pluck('day')->map(function ($day) {
            $days = [
                'Sunday' => 'Domingo',
                'Monday' => 'Lunes',
                'Tuesday' => 'Martes',
                'Wednesday' => 'Miércoles',
                'Thursday' => 'Jueves',
                'Friday' => 'Viernes',
                'Saturday' => 'Sábado',
            ];
            return $days[$day] ?? $day;
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total de Pedidos',
                    'data' => $totalPedido->pluck('total')->toArray(),
                ],
            ],
            'labels' => $daysInSpanish,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

