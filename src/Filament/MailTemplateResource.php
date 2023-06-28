<?php

namespace Codedor\FilamentMailTemplates\Filament;

use Closure;
use Codedor\FilamentMailTemplates\Filament\MailTemplateResource\Pages;
use Codedor\FilamentMailTemplates\Forms\Components\MailVariablesInput;
use Codedor\FilamentMailTemplates\Models\MailTemplate;
use Codedor\TranslatableTabs\Forms\TranslatableTabs;
use Codedor\TranslatableTabs\Tables\LocalesColumn;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Model;

class MailTemplateResource extends Resource
{
    protected static ?string $model = MailTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Forms';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TranslatableTabs::make('Translations')
                ->columnSpan(['lg' => 2])
                ->defaultFields([
                    Placeholder::make('identifier')
                        ->content(fn (Model $record) => $record->identifier),

                    Placeholder::make('description')
                        ->content(fn (Model $record) => $record->description),
                ])
                ->translatableFields([
                    Grid::make(3)->schema([
                        TextInput::make('subject')
                            ->required(fn (Closure $get) => $get('online'))
                            ->columnSpan(['lg' => 3]),

                        TiptapEditor::make('body')
                            ->required(fn (Closure $get) => $get('online'))
                            ->columnSpan(['lg' => 2]),

                        MailVariablesInput::make('variables'),

                        Toggle::make('online')
                            ->columnSpan(['lg' => 3])
                            ->label('Online'),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('identifier'),

                TextColumn::make('description'),

                LocalesColumn::make('online'),
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
            'index' => Pages\ListMailTemplates::route('/'),
            'create' => Pages\CreateMailTemplate::route('/create'),
            'edit' => Pages\EditMailTemplate::route('/{record}/edit'),
        ];
    }
}
