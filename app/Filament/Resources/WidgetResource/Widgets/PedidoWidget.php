<?php

namespace App\Filament\Resources\WidgetResource\Widgets;

use Filament\Widgets\ChartWidget;

class PedidoWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
