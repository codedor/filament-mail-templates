<?php

namespace Codedor\FilamentMailTemplates\Filament;

use Codedor\FilamentMailTemplates\Filament\MailHistoryResource\Pages;
use Codedor\FilamentMailTemplates\Models\MailHistory;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class MailHistoryResource extends Resource
{
    protected static ?string $model = MailHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Forms';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMailHistories::route('/'),
            'create' => Pages\CreateMailHistory::route('/create'),
            'edit' => Pages\EditMailHistory::route('/{record}/edit'),
        ];
    }
}
