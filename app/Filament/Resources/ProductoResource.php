<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_pro')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('descripcion_pro')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('precio_pro')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('disponibilidad_pro')
                    ->label('Disponibilidad del producto')
                    ->options([
                        1 => 'Disponible',
                        0 => 'No disponible',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('imagenRef_pro')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Select::make('id_categoria')
                    ->label('Categoria')
                    ->relationship('categoria', 'nombre_cat')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_pro')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion_pro')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio_pro')
                    ->numeric(),
                Tables\Columns\TextColumn::make('disponibilidad_pro')
                    ->searchable(),
                Tables\Columns\TextColumn::make('imagenRef_pro')
                    ->searchable(),
                Tables\Columns\TextColumn::make('categoria.nombre_cat')
                    ->label('Categoria')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
