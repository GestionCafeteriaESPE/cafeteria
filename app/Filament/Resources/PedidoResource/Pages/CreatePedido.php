<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use Filament\Actions;
use Filament\Actions\Action;
use App\Models\Cliente;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;
use Livewire\Component;

class CreatePedido extends CreateRecord
{
    protected static string $resource = PedidoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $cliente = Cliente::firstOrCreate(
            ['cedula_cli' => $data['cedula_cli']],
            ['nombre_cli' => $data['nombre_cli'], 'telefono_cli' => $data['telefono_cli'], 'email_cli' => $data['email_cli']]
        );

        $data['id_cli'] = $cliente->id;

        return $data;
    }

    /*protected function getActions(): array
    {
        return [
            Action::make('verificarCedula')
                ->label('Verificar Cédula')
                ->form([
                    TextInput::make('cedula_cli')->label('Cédula del Cliente')->required()->maxLength(10),
                ])
                ->action(function (array $data) {
                    Log::info('Verificar cédula action triggered', ['data' => $data]);

                    try {
                        $cliente = Cliente::where('cedula_cli', $data['cedula_cli'])->first();
                        Log::info('Cliente query result', ['cliente' => $cliente]);
                        
                        //$this->emit('clienteVerificado'); //No bloquea pero no muestra nada
                        $this->fillClienteData($cliente);
                        //Livewire::emit('clienteVerificado');
                        $this->dispatch('clienteVerificado');
                        //$this->dispatchBrowserEvent('clienteVerificado'); // Emitir evento para cerrar modal
                        //Livewire::dispatch('clienteVerificado'); // Emitir evento para cerrar modal
                        //$this->emit('clienteVerificado'); //Si bloquea pero muestra datos
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return array_merge($data, ['is_cliente_found' => false]);
    }

    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
        'cedula_cli' => '',
        'nombre_cli' => '',
        'telefono_cli' => '',
        'email_cli' => '',
        'total_ped' => 0,
        'modoPago_ped' => 'Efectivo',
        'estado_ped' => 0,
        'fecha_ped' => date('Y-m-d'),
        'is_cliente_found' => false,
        ]);
    }*/
}
