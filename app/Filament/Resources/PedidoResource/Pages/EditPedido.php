<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use Filament\Actions;
use Filament\Actions\Action;
use App\Models\Cliente;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Log;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('verificarCedula')
                ->label('Verificar Cédula')
                ->form([
                    TextInput::make('cedula_cli')->label('Cédula del Cliente')->required()->maxLength(10),
                ])
                ->action(function (array $data) {
                    Log::info('Verificar cédula action triggered', ['data' => $data]);

                    try {
                        $cliente = Cliente::where('cedula_cli', $data['cedula_cli'])->first();
                        Log::info('Cliente query result', ['cliente' => $cliente]);

                        $this->fillClienteData($cliente);
                    } catch (\Exception $e) {
                        Log::error('Error verifying cedula', ['exception' => $e->getMessage()]);
                    }
                })
                ->color('primary')
                ->modalButton('Verificar')
                ->modalHeading('Verificar Cédula')
        ];
    }

    protected function fillClienteData($cliente)
    {
        $this->form->fill([
            'cedula_cli' => $cliente ? $cliente->cedula_cli : '',
            'nombre_cli' => $cliente ? $cliente->nombre_cli : '',
            'telefono_cli' => $cliente ? $cliente->telefono_cli : '',
            'email_cli' => $cliente ? $cliente->email_cli : '',
            'is_cliente_found' => (bool) $cliente,
        ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return array_merge($data, ['is_cliente_found' => false]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /*protected function mutateFormDataBeforeSave(array $data): array
    {
        // Buscar o crear el cliente
        $cliente = Cliente::firstOrCreate(
            ['cedula_cli' => $data['cedula_cli']],
            [
                'nombre_cli' => $data['nombre_cli'] ?? '',
                'email_cli' => $data['email_cli'] ?? '',
                'telefono_cli' => $data['telefono_cli'] ?? '',
            ]
        );

        $data['id_cli'] = $cliente->id;

        return $data;
    }*/

    public function mount(string|int $record): void
    {
        parent::mount($record);

        $this->form->fill([
            'is_cliente_found' => false,
        ]);
    }
}
