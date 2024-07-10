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
                ->action(function (array $data, callable $set) {
                    Log::info('Verificar cédula action triggered', ['data' => $data]);

                    try {
                        $cliente = Cliente::where('cedula_cli', $data['cedula_cli'])->first();
                        Log::info('Cliente query result', ['cliente' => $cliente]);

                        $this->fillClienteData($cliente);
                        $this->emit('clienteVerificado');
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

    public function mount(string|int $record): void
    {
        parent::mount($record);

        $this->form->fill([
            'cedula_cli' => $this->record ? $this->record->cedula_cli : '',
            'nombre_cli' => $this->record ? $this->record->nombre_cli : '',
            'telefono_cli' => $this->record ? $this->record->telefono_cli : '',
            'email_cli' => $this->record ? $this->record->email_cli : '',
            'total_ped' => $this->record ? $this->record->total_ped : '',
            'modoPago_ped' => $this->record ? $this->record->modoPago_ped : '',
            'estado_ped' => $this->record ? $this->record->estado_ped : '',
            'fecha_ped' => $this->record ? $this->record->fecha_ped : date('Y-m-d'), // O la fecha actual si es nuevo
            'is_cliente_found' => false,
        ]);
    }
}
