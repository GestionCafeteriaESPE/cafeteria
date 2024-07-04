<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use Filament\Actions;
use App\Models\Cliente;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $cliente = Cliente::firstOrCreate(
            ['cedula_cli' => $data['cedula_ped']],
            [
                'nombre_cli' => $data['nombre_ped'],
                'telefono_cli' => $data['telefono_ped'],
                'email_cli' => $data['email_ped'],
            ]
        );

        $data['id_cli'] = $cliente->id;

        return $data;
    }
}
