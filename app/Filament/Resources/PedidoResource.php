<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\PeDetalle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Repeater;
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
                        TextInput::make('cedula_cli')->label('Cédula del Cliente')->required()->maxLength(10)->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
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
                                static::updateTotal($get, $set);
                            }),
                        TextInput::make('nombre_cli')->label('Nombre del Cliente')->maxLength(70)->disabled(fn ($get) => $get('is_cliente_found'))->required()->hidden(fn ($get) => !$get('cedula_cli')),
                        TextInput::make('telefono_cli')->label('Teléfono del Cliente')->maxLength(10)->disabled(fn ($get) => $get('is_cliente_found'))->required()->hidden(fn ($get) => !$get('cedula_cli')),
                        TextInput::make('email_cli')->label('E-mail del Cliente')->maxLength(60)->disabled(fn ($get) => $get('is_cliente_found'))->hidden(fn ($get) => !$get('cedula_cli')),
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
                        TextInput::make('total_ped')->label('Total')->required()->numeric()->prefix('$')->live()
                        ->afterStateUpdated(function (callable $get, callable $set) {
                            static::updateTotal($get, $set);
                        }),
                    ])->columns(4),
                
                // Los detalles de pedido (Repeater)
                Forms\Components\Section::make('Productos de Pedido')
                    ->description('Ingrese los productos dentro de este pedido')
                    ->schema([

                        Forms\Components\Repeater::make('peDetalles')
                            ->label('')
                            ->relationship()
                            ->schema([
                                Select::make('id_pro')
                                ->label('Producto')
                                ->relationship('producto', 'nombre_pro')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    static::updateTotal($get, $set);
                                    $producto = Producto::find($state);
                                    if ($producto) {
                                        $set('precio_pdet', $producto->precio_pro);
                                        $set('subtotal_pdet', $get('cantidad_pdet') * $producto->precio_pro);
                                        //$set('subtotal_pdet', $producto->precio_pro * $get('cantidad_pdet'));
                                        //$set('subtotal_pdet', $get('cantidad_pdet') * $get('precio_pdet'));
                                    }
                                    static::updateTotal($get, $set);
                                }),
                                TextInput::make('cantidad_pdet')->label('Cantidad')->numeric()->required()->live(onBlur: true)
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    static::updateTotal($get, $set);
                                    $set('subtotal_pdet', $state * $get('precio_pdet'));
                                    static::updateTotal($get, $set);
                                }),
                                TextInput::make('precio_pdet')->label('Precio unitario')->numeric()->required()->prefix('$')->disabled(true),
                                TextInput::make('subtotal_pdet')->label('Subtotal')->numeric()->required()->prefix('$')->disabled(true)->live(debounce: 500),
                            ])
                            ->createItemButtonLabel('Añadir Producto')
                            ->columns(4)
                            ->columnSpan('full')
                            ->live(debounce: 600)
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                static::updateTotal($get, $set);
                            }),

                    ])->columns(4),
            ]);
    }

    protected static function updateTotal(callable $get, callable $set)
    {
        $total = 0;
        $peDetalles = $get('peDetalles') ?? [];

        foreach ($peDetalles as $detalle) {
            // Verificar si los detalles tienen los campos necesarios
            if (isset($detalle['precio_pdet']) && isset($detalle['subtotal_pdet'])) {
                $total += $detalle['subtotal_pdet'];
            } else {
                Log::error('Detalle faltante', $detalle); // Log para depuración
            }
        }

        $set('total_ped', $total);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha_ped')->label('Fecha de Pedido')->sortable(),
                TextColumn::make('total_ped')->label('Total'),
                TextColumn::make('modoPago_ped')->label('Modo de Pago')->searchable(),
                TextColumn::make('estado_ped')
                    ->label('Estado')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Pagado' : 'Pendiente')
                    ->sortable(),
                TextColumn::make('cliente.nombre_cli')->label('Cliente')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Creación del Pedido')->dateTime()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('Actualización del Pedido')->dateTime()->toggleable(isToggledHiddenByDefault: true)
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
            RelationManagers\PedetallesRelationManager::class
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
}