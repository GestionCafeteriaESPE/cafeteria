<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use App\Models\Producto;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;

class ProductoWidget extends Widget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Disponibilidad de Productos';

    protected function getViewData(): array
    {
        $productos = Producto::select('nombre_pro', 'disponibilidad_pro')
            ->orderBy('nombre_pro', 'asc')
            ->get();

        return [
            'heading' => static::$heading,
            'productos' => $productos,
        ];
    }

    protected static string $view = 'widgets.producto-disponibilidad-widget';
}
