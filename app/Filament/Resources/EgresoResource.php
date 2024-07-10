<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EgresoResource\Pages;
use App\Filament\Resources\EgresoResource\RelationManagers;
use App\Models\Egreso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EgresoResource extends Resource
{
    protected static ?string $model = Egreso::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fecha_Egr')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('descripcion_Egr')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('cantidad_Egr')
                    ->required()
                    ->numeric(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha_Egr')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion_Egr')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cantidad_Egr')
                    ->searchable(),
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
            'index' => Pages\ListEgresos::route('/'),
            'create' => Pages\CreateEgreso::route('/create'),
            'edit' => Pages\EditEgreso::route('/{record}/edit'),
        ];
    }
}
