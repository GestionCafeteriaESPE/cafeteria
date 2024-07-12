<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Models\Cliente;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Actions\Action;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos de cliente')
                ->description('Ingrese la cédula del cliente y seleccione los productos. Si ya ha realizado una compra, se reflejarán automáticamente los datos del cliente. En caso de ser un nuevo cliente, los campos se activarán para el ingreso de datos.')
                ->schema([
                    TextInput::make('cedula_cli')->label('Cédula del Cliente')->required()->maxLength(10)
                        ->afterStateUpdated(function ($state, callable $set) {
                            if ($cliente = \App\Models\Cliente::where('cedula_cli', $state)->first()) {
                                $set('nombre_cli', $cliente->nombre_cli);
                                $set('telefono_cli', $cliente->telefono_cli);
                                $set('email_cli', $cliente->email_cli);
                                $set('is_cliente_found', true);
                            } else {
                                $set('nombre_cli', '');
                                $set('telefono_cli', '');
                                $set('email_cli', '');
                                $set('is_cliente_found', false);
                            }
                        }),
                    TextInput::make('nombre_cli')->label('Nombre del Cliente')->disabled(fn ($get) => $get('is_cliente_found'))->required()->hidden(fn ($get) => !$get('cedula_cli')),
                    TextInput::make('telefono_cli')->label('Teléfono del Cliente')->disabled(fn ($get) => $get('is_cliente_found'))->required()->hidden(fn ($get) => !$get('cedula_cli')),
                    TextInput::make('email_cli')->label('E-mail del Cliente')->disabled(fn ($get) => $get('is_cliente_found'))->hidden(fn ($get) => !$get('cedula_cli')),
                    TextInput::make('is_cliente_found')->hidden(),                    
                ])->columns(4),

                Forms\Components\Section::make('Datos de pedido')
                ->description('Ingrese los datos del pedido.')
                ->schema([
                    DatePicker::make('fecha_ped')->label('Fecha de Pedido')->required()->placeholder('YYYY-MM-DD'),
                    Select::make('modoPago_ped')
                        ->label('Modo de Pago')
                        ->options([
                            'Efectivo' => 'Efectivo',
                            'Tarjeta' => 'Tarjeta',
                            'Transferencia' => 'Transferencia',
                        ])
                        ->required(),
                    Select::make('estado_ped')
                        ->label('Estado de Pedido')
                        ->options([
                            1 => 'Pagado',
                            0 => 'Pendiente',
                        ])
                        ->required(),
                    TextInput::make('total_ped')->label('Total')->required()->numeric()->prefix('$')->disabled(true),
                ])->columns(4),

                /* Utiliza el componente Livewire para la verificación de la cédula
                Forms\Components\View::make('livewire.buscar-cliente')->label('Verificar Cédula'),*/
                
                /*Forms\Components\Livewire::make('buscar-cliente'),
                /*->label('Datos del Cliente')
                ->schema([
                    TextInput::make('cedula_cli')->label('Cédula del Cliente')->required()->maxLength(10),
                    TextInput::make('nombre_cli')->label('Nombre del Cliente')->required(),
                    TextInput::make('telefono_cli')->label('Teléfono del Cliente')->required(),
                    TextInput::make('email_cli')->label('E-mail del Cliente'),
                ]),*/
                
                // Repeater para PeDetalle
                Forms\Components\Repeater::make('peDetalles')
                    ->relationship()
                    ->schema([
                        Select::make('id_pro')->label('Producto')->relationship('producto', 'nombre_pro')->required(),
                        TextInput::make('cantidad_pdet')->label('Cantidad')->numeric()->required(),
                        TextInput::make('precio_pdet')->label('Precio')->numeric()->required()->prefix('$'),
                        TextInput::make('subtotal_pdet')->label('Subtotal')->numeric()->required()->prefix('$'),
                    ])
                    ->columns(4)
                    ->createItemButtonLabel('Añadir Producto'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha_ped')->label('Fecha de Pedido')->sortable(),
                TextColumn::make('total_ped')->label('Total')->sortable(),
                TextColumn::make('modoPago_ped')->label('Modo de Pago')->searchable(),
                TextColumn::make('estado_ped')
                    ->label('Estado')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Pagado' : 'Pendiente')
                    ->sortable(),
                TextColumn::make('cliente.nombre_cli')->label('Cliente')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Creación del Pedido')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('Actualización del Pedido')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }

    // Método para verificar la cédula
    public function verificarCedula(array $data, callable $set)
    {
        try {
            $cliente = Cliente::where('cedula_cli', $data['cedula_cli'])->first();

            if ($cliente) {
                $set('nombre_cli', $cliente->nombre_cli);
                $set('telefono_cli', $cliente->telefono_cli);
                $set('email_cli', $cliente->email_cli);
                $set('is_cliente_found', true);
            } else {
                $set('nombre_cli', '');
                $set('telefono_cli', '');
                $set('email_cli', '');
                $set('is_cliente_found', false);
            }
        } catch (\Exception $e) {
            Log::error('Error verifying cedula', ['exception' => $e->getMessage()]);
            throw $e;
        }
    }

    /*
    protected function getActions(): array
    {
        return [
            Action::make('verificarCedula')
                ->label('Verificar Cédula')
                ->form([
                    TextInput::make('cedula_cli')->label('Cédula del Cliente')->required()->maxLength(10),
                ])
                ->action(function (array $data, callable $set) {
                    try {
                        $cliente = Cliente::where('cedula_cli', $data['cedula_cli'])->first();
                        
                        if ($cliente) {
                            $set('cedula_cli', $cliente->cedula_cli);
                            $set('nombre_cli', $cliente->nombre_cli);
                            $set('telefono_cli', $cliente->telefono_cli);
                            $set('email_cli', $cliente->email_cli);
                            $set('is_cliente_found', true);
                        } else {
                            $set('cedula_cli', $data['cedula_cli']);
                            $set('nombre_cli', '');
                            $set('telefono_cli', '');
                            $set('email_cli', '');
                            $set('is_cliente_found', false);
                        }
                        $this->dispatch('clienteVerificado');
                    } catch (\Exception $e) {
                        Log::error('Error verifying cedula', ['exception' => $e->getMessage()]);
                        throw $e;
                    }
                })
                ->color('primary')
                ->modalButton('Verificar')
                ->modalHeading('Verificar Cédula')
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['is_cliente_found'] = false;
        return $data;
    }

    //#[On('clienteVerificado')] 
    protected function saving(Pedido $pedido, array $data): void
    {
        // Buscar o crear cliente por cédula
        $cliente = Cliente::firstOrCreate(
            ['cedula_cli' => $data['cedula_cli']],
            [
                'nombre_cli' => $data['nombre_cli'] ?? '',
                'telefono_cli' => $data['telefono_cli'] ?? '',
                'email_cli' => $data['email_cli'] ?? '',
            ]
        );

        // Asignar el id del cliente al pedido
        $pedido->id_cli = $cliente->id;
    }*/
}