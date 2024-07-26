<?php

namespace App\Filament\Resources\IngresosResource\Pages;

use App\Filament\Resources\IngresosResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

use App\Models\Ingresos;
use Barryvdh\DomPDF\Facade\Pdf;

class ListIngresos extends ListRecords
{
    protected static string $resource = IngresosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Action::make('downloadReport')
                ->label('Descargar Reporte')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function () {
                    $ingresos = Ingresos::all();
                    $pdf = Pdf::loadView('Ingresos.reporte_ingreso', compact('ingresos'));
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'ReporteIngresos.pdf');
                }),
        ];
    }
}
