<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as Page;
use App\Filament\Widgets\EgresostWidget;
use App\Filament\Widgets\EgresosStat;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected function getHeaderWidgets(): array
    {
        return [
            EgresosStat::class,
            EgresostWidget::class,
            IngresotWidget::class,
            PedidoWidget::class,
            ProductoMVWidget::class,
            ProductoWidget::class,
        ];
    }
}