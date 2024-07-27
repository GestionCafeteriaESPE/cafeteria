<?php

namespace App\Filament\Resources\IngresosResource\Pages;

use App\Filament\Resources\IngresosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIngresos extends CreateRecord
{
    protected static string $resource = IngresosResource::class;
    protected function getRedirectUrl(): string  // Asegúrate de cambiar el tipo de retorno a string
    {
        return $this->getResource()::getUrl('index');
    }
}
