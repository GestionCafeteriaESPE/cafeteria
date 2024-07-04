<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use Filament\Actions;
use App\Models\Cliente;
use Filament\Resources\Pages\CreateRecord;

class CreatePedido extends CreateRecord
{
    protected static string $resource = PedidoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Buscar o crear el cliente
        $cliente = Cliente::firstOrCreate(
            ['cedula_cli' => $data['cedula_ped']],
            [
                'nombre_cli' => $data['nombre_ped'],
                'email_cli' => $data['email_ped'],
                'telefono_cli' => $data['telefono_ped'],
            ]
        );

        // Asignar el id del cliente al pedido
        $data['id_cli'] = $cliente->id;

        return $data;
    }
}
