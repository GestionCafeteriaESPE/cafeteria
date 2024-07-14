<?php

namespace App\Filament\Resources\InventarioResource\Pages;

use App\Filament\Resources\InventarioResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;

class ViewInventario extends ViewRecord
{
    protected static string $resource = InventarioResource::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('nombre_inv')
                ->label('Nombre del Inventario')
                ->disabled()
                ->required()
                ->maxLength(70),
            Textarea::make('descripcion_inv')
                ->label('Descripción')
                ->disabled()
                ->nullable(),
            TextInput::make('cantidad_inv')
                ->label('Cantidad')
                ->disabled()
                ->required()
                ->numeric(),
            TextInput::make('estado_inv')
                ->label('Estado')
                ->disabled()
                ->required()
                ->maxLength(60),
            TextInput::make('created_at')
                ->label('Creado')
                ->disabled()
                ->dateTime(),
            TextInput::make('updated_at')
                ->label('Actualizado')
                ->disabled()
                ->dateTime(),
        ];
    }
}
