<?php

namespace App\Filament\Resources\EgresoResource\Pages;

use App\Filament\Resources\EgresoResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

use App\Models\Egreso;
use Barryvdh\DomPDF\Facade\Pdf;

class ListEgresos extends ListRecords
{
    protected static string $resource = EgresoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Action::make('downloadReport')
                ->label('Descargar Reporte')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function () {
                    $egresos = Egreso::all();
                    $pdf = Pdf::loadView('Egresos.reporte_egreso', compact('egresos'));
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'ReporteEgresos.pdf');
                }),
        ];
    }
}
