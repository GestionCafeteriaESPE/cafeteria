<?php

namespace App\Filament\Resources\EgresoResource\Pages;

use App\Filament\Resources\EgresoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEgreso extends CreateRecord
{
    protected static string $resource = EgresoResource::class;

    protected function getRedirectUrl(): string  // Asegúrate de cambiar el tipo de retorno a string
    {
        return $this->getResource()::getUrl('index');
    }
}
