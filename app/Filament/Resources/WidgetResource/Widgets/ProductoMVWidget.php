<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\PeDetalle;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductoMVWidget extends ChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Productos Más Vendidos';

    protected function getData(): array
    {
        $productosMasVendidos = PeDetalle::join('productos', 'productos.id', '=', 'pe_detalles.id_pro')
            ->select('productos.nombre_pro', DB::raw('SUM(pe_detalles.cantidad_pdet) as total_vendido'))
            ->groupBy('productos.nombre_pro')
            ->orderBy('total_vendido', 'desc')
            ->take(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Cantidad Vendida',
                    'data' => $productosMasVendidos->pluck('total_vendido')->toArray(),
                ],
            ],
            'labels' => $productosMasVendidos->pluck('nombre_pro')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
