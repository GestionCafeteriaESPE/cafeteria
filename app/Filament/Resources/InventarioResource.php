<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarioResource\Pages;
use App\Filament\Resources\InventarioResource\RelationManagers;
use App\Models\Inventario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventarioResource extends Resource
{
    protected static ?string $model = Inventario::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_inv')
                    ->label('Nombre del Inventario')
                    ->required(),
                Forms\Components\Textarea::make('descripcion_inv')
                    ->label('Descripción')
                    ->nullable(),
                Forms\Components\TextInput::make('cantidad_inv')
                    ->label('Cantidad')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('estado_inv')
                    ->label('Estado')
                    ->options([
                        'Disponible' => 'Disponible',
                        'Agotado' => 'Agotado',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_inv')->label('Nombre del Inventario'),
                TextColumn::make('descripcion_inv')->label('Descripción'),
                TextColumn::make('cantidad_inv')->label('Cantidad'),
                TextColumn::make('estado_inv')->label('Estado'),
                TextColumn::make('created_at')->label('Creado')->dateTime(),
                TextColumn::make('updated_at')->label('Actualizado')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventarios::route('/'),
            'create' => Pages\CreateInventario::route('/create'),
            'edit' => Pages\EditInventario::route('/{record}/edit'),
        ];
    }
}
