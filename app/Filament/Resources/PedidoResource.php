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
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('fecha_ped')->required(),
                TextInput::make('nombre_ped')->required()->maxLength(50),
                TextInput::make('cedula_ped')->required()->maxLength(10),
                TextInput::make('telefono_ped')->maxLength(10),
                TextInput::make('email_ped')->maxLength(30),
                TextInput::make('total_ped')->required()->numeric()->prefix('$'),

                Select::make('modoPago_ped')
                    ->options([
                        'Efectivo' => 'Efectivo',
                        'Tarjeta' => 'Tarjeta',
                        'Transferencia' => 'Transferencia',
                    ])
                    ->required(),
                Select::make('estado_ped')
                    ->options([
                        1 => 'Pagado',
                        0 => 'Pendiente',
                    ])
                    ->required(),
                
                // Repeater para PeDetalle
                Forms\Components\Repeater::make('peDetalles')
                    ->relationship()
                    ->schema([
                        Select::make('id_pro')
                            ->relationship('producto', 'nombre_pro')
                            ->required(),
                        TextInput::make('cantidad_pdet')
                            ->numeric()
                            ->required(),
                        TextInput::make('precio_pdet')
                            ->numeric()
                            ->required(),
                        TextInput::make('subtotal_pdet')
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(2)
                    ->createItemButtonLabel('Añadir Detalle'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha_ped')->searchable(),
                TextColumn::make('nombre_ped')->searchable(),
                TextColumn::make('cedula_ped')->searchable(),
                TextColumn::make('telefono_ped')->searchable(),
                TextColumn::make('email_ped')->searchable(),
                TextColumn::make('total_ped')->sortable(),
                TextColumn::make('modoPago_ped')->searchable(),
                TextColumn::make('estado_ped')
                    ->label('Estado')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Pagado' : 'Pendiente')
                    ->sortable(),
                TextColumn::make('cliente.nombre_cli')->label('Cliente')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)
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

    protected function saving(Pedido $pedido, array $data): void
    {
        // Buscar o crear cliente por cédula
        $cliente = Cliente::firstOrCreate(
            ['cedula_cli' => $data['cedula_ped']],
            [
                'nombre_cli' => $data['nombre_ped'],
                'telefono_cli' => $data['telefono_ped'],
                'email_cli' => $data['email_ped'],
            ]
        );

        // Asignar el id del cliente al pedido
        $pedido->id_cli = $cliente->id;
    }
}
