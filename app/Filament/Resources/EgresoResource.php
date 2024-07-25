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
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists;
use Filament\Infolists\Infolist;


class EgresoResource extends Resource
{
    protected static ?string $model = Egreso::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make(3)
            ->schema([
                DatePicker::make('fecha_Egr')->label('Fecha de egreso')->required()->placeholder('YYYY-MM-DD'),
                TextInput::make('descripcion_Egr')->label('Descripción de egreso')->maxLength(60)->required(),
                TextInput::make('cantidad_Egr')->label('Cantidad de egreso')->numeric()->prefix('$')->required()
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha_Egr')->label('Fecha de egreso')->sortable()->searchable(),
                TextColumn::make('descripcion_Egr')->label('Descripción de egreso')->sortable()->searchable(),
                TextColumn::make('cantidad_Egr')->label('Cantidad de egreso')->sortable()->searchable(),
                
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
                Tables\Actions\ViewAction::make()
                    ->label('Ver')
                    ->icon('heroicon-o-eye')
                    ->color('secondary'),
                Tables\Actions\EditAction::make()
                    ->label('Editar')
                    ->icon('heroicon-o-pencil')
                    ->color('primary'),
                Tables\Actions\DeleteAction::make()
                    ->label('Eliminar')
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                    Section::make('Datos de cliente')
                        ->schema([
                            TextEntry::make('fecha_Egr')->label('Fecha'),
                            TextEntry::make('descripcion_Egr')->label('Descripción'),
                            TextEntry::make('cantidad_Egr')->label('Cantidad'),
                        ])
                        ->columns(3),
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
