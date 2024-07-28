<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngresosResource\Pages;
use App\Models\Ingresos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Grid;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class IngresosResource extends Resource
{
    protected static ?string $model = Ingresos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
        Grid::make(3)
            ->schema([
                DatePicker::make('fecha_ing')
                    ->label('Fecha de Ingreso')
                    ->required()
                    ->placeholder('YYYY-MM-DD'),

                TextInput::make('descripcion_ing')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(150),

                TextInput::make('cantidad_ing')
                    ->label('Cantidad')
                    ->required()
                    ->numeric(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha_ing')
                    ->label('Fecha de Ingreso')
                    ->sortable(),  // Puedes añadir sortable si necesitas

                Tables\Columns\TextColumn::make('descripcion_ing')
                    ->label('Descripción')
                    ->searchable(),

                Tables\Columns\TextColumn::make('cantidad_ing')
                    ->label('Cantidad')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                // Agrega tus filtros aquí
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                    Section::make('Datos del Ingreso')
                        ->schema([
                            TextEntry::make('fecha_ing')->label('Fecha'),
                            TextEntry::make('descripcion_ing')->label('Descripción'),
                            TextEntry::make('cantidad_ing')->label('Cantidad'),
                        ])
                        ->columns(3),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define tus relaciones aquí
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIngresos::route('/'),
            'create' => Pages\CreateIngresos::route('/create'),
            'edit' => Pages\EditIngresos::route('/{record}/edit'),
        ];
    }
}
