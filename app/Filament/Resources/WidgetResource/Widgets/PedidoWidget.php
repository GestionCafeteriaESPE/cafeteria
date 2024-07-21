<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\PeDetalle;
use App\Models\Pedido;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PedidoWidget extends ChartWidget
{
    protected static ?string $heading = 'Pedidos';

    protected function getData(): array
    {
        $totalPedido= PeDetalle::join('pedidos', 'pedidos.id', '=', 'pe_detalles.id_ped')
        ->select(DB::raw('DATE(pedidos.fecha_ped) as date'), DB::raw('SUM(pe_detalles.subtotal_pdet) as total'))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();
        return [
            'datasets' => [
                [
                    'label' => 'Total de Subtotales de Pedidos', 
                    'data' => $totalPedido->pluck('total')->toArray(),
                ],
            ],
            'labels' => $totalPedido->pluck('date')->map(fn($date) => date('Y/m/d', strtotime($date)))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
