<?php

namespace Codedor\FilamentMailTemplates\Filament\Resources;

use Codedor\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;
use Codedor\FilamentMailTemplates\Forms\Components\MailVariablesInput;
use Codedor\FilamentMailTemplates\Models\MailTemplate;
use Codedor\TranslatableTabs\Forms\TranslatableTabs;
use Codedor\TranslatableTabs\Tables\LocalesColumn;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Model;

class MailTemplateResource extends Resource
{
    protected static ?string $model = MailTemplate::class;

    public static function getNavigationGroup(): ?string
    {
        return config(
            'filament-mail-templates.navigation.templates.group',
            parent::getNavigationGroup()
        );
    }

    public static function getNavigationIcon(): string
    {
        return config(
            'filament-mail-templates.navigation.templates.icon',
            parent::getNavigationIcon()
        );
    }

    public static function shouldRegisterNavigation(): bool
    {
        return config(
            'filament-mail-templates.navigation.templates.shown',
            parent::shouldRegisterNavigation()
        );
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TranslatableTabs::make('Translations')
                ->columnSpan(['lg' => 2])
                ->icon(false)
                ->defaultFields([
                    Placeholder::make('identifier')
                        ->content(fn (Model $record) => $record->identifier),

                    Placeholder::make('description')
                        ->content(fn (Model $record) => $record->description),

                    Repeater::make('to_email')
                        ->helperText('If left empty, the sites default e-mail will be used.')
                        ->label('Target e-mails')
                        ->schema([
                            Grid::make()->schema([
                                TextInput::make('email')
                                    ->required(),

                                Select::make('type')
                                    ->required()
                                    ->options([
                                        'to' => 'Normal',
                                        'cc' => 'CC',
                                        'bcc' => 'BCC',
                                    ]),
                            ]),
                        ]),
                ])
                ->translatableFields([
                    Grid::make(3)->schema([
                        TextInput::make('subject')
                            ->columnSpan(['lg' => 3]),

                        TiptapEditor::make('body')
                            ->columnSpan(['lg' => 2]),

                        MailVariablesInput::make('variables'),
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
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->url(fn (MailTemplate $record) => self::getUrl('preview', $record))
                    ->label(__('filament-mail-templates::preview.button label'))
                    ->icon('heroicon-o-eye'),

                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMailTemplates::route('/'),
            'preview' => Pages\PreviewMailTemplate::route('/{record}/preview'),
            'edit' => Pages\EditMailTemplate::route('/{record}/edit'),
        ];
    }
}
