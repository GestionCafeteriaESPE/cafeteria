<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\PeDetalle;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoMVWidget extends ChartWidget
{
    protected static ?string $heading = 'Productos más vendidos por mes';

    protected function getData(): array
    {
        // Consulta para obtener los productos más vendidos agrupados por mes
        $productosMasVendidos = PeDetalle::join('productos', 'productos.id', '=', 'pe_detalles.id_pro')
            ->join('pedidos', 'pedidos.id', '=', 'pe_detalles.id_ped')
            ->select(
                'productos.nombre_pro',
                DB::raw('SUM(pe_detalles.cantidad_pdet) as total_vendido'),
                DB::raw('DATE_FORMAT(pedidos.fecha_ped, "%Y-%m") as mes_venta')
            )
            ->groupBy('productos.nombre_pro', 'mes_venta')
            ->orderBy('mes_venta', 'asc')
            ->orderBy('total_vendido', 'desc')
            ->get();
        $nombresMeses = [
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
            '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
            '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        ];

        $labels = $productosMasVendidos->pluck('mes_venta')->unique()->map(function ($date) use ($nombresMeses) {
            $mes = substr($date, -2);
            return $nombresMeses[$mes];
        })->values()->toArray();

        $productos = $productosMasVendidos->pluck('nombre_pro')->unique();
        $datasets = [];

        foreach ($productos as $index => $producto) {
            $data = array_fill(0, count($labels), 0);
            foreach ($productosMasVendidos->where('nombre_pro', $producto) as $venta) {
                $mesNumero = substr($venta->mes_venta, -2);
                $mesIndex = array_search($nombresMeses[$mesNumero], $labels);
                if ($mesIndex !== false) {
                    $data[$mesIndex] = $venta->total_vendido;
                }
            }
            $datasets[] = [
                'label' => $producto,
                'data' => $data,
                'backgroundColor' => $this->getPastelColor($index),
            ];
        }

        // Limitar a los 18 productos más vendidos
        $datasets = array_slice($datasets, 0, 18);

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function getPastelColor($index)
    {
        $colors = [
            '#FAD02E', '#F28D35', '#D83367', '#6A0572',
            '#9A4D41', '#C7F9CC', '#FF9A8B', '#E9A6A6',
            '#C9A3BF', '#E0B0FF', '#E3DAC9', '#B7D7E1','#0000FF',
            '#FFC3A0', '#D5AAFF', '#C3A5C5', '#3FD8AA', '#87E79E'
        ];
        
        return $colors[$index % count($colors)];
    }
}