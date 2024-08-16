<?php
namespace App\Filament\Resources\WidgetResource\Widgets;
use App\Models\PeDetalle;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductoHWidget extends ChartWidget
{
    protected static ?string $heading = 'Productos más vendidos';

    protected function getData(): array
    {
        $productosMasVendidos = PeDetalle::join('productos', 'productos.id', '=', 'pe_detalles.id_pro')
            ->select('productos.nombre_pro', DB::raw('SUM(pe_detalles.cantidad_pdet) as total_vendido'))
            ->groupBy('productos.id', 'productos.nombre_pro')  // Añadimos 'productos.id' al GROUP BY
            ->orderBy('total_vendido', 'desc')
            ->take(10)
            ->get();

        // Asegurarse de que los valores son numéricos
        $cantidades = $productosMasVendidos->pluck('total_vendido')->map(function ($cantidad) {
            return (int)$cantidad;
        })->toArray();

        $nombres = $productosMasVendidos->pluck('nombre_pro')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Cantidad Vendida',
                    'data' => $cantidades,
                ],
            ],
            'labels' => $nombres,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

}