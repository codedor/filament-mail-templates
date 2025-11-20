<?php

namespace Codedor\FilamentMailTemplates\Filament\Resources;

use Codedor\FilamentMailTemplates\Facades\MailTemplateFallbacks;
use Codedor\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;
use Codedor\FilamentMailTemplates\Models\MailTemplate;
use Codedor\FilamentPlaceholderInput\Filament\Forms\Components\PlaceholderInput;
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
            TranslatableTabs::make()
                ->columnSpan(['lg' => 2])
                ->icon(false)
                ->defaultFields([
                    Placeholder::make('identifier')
                        ->label(__('filament-mail-templates::admin.identifier'))
                        ->content(fn (MailTemplate $record) => $record->identifier),

                    Placeholder::make('description')
                        ->label(__('filament-mail-templates::admin.description'))
                        ->content(fn (MailTemplate $record) => $record->description),

                    Grid::make()->schema([
                        TextInput::make('from_name')
                            ->label(__('filament-mail-templates::admin.from name'))
                            ->helperText(
                                __('filament-mail-templates::admin.from name help :name', [
                                    'name' => MailTemplateFallbacks::getFromName(),
                                ])
                            ),

                        TextInput::make('from_email')
                            ->label(__('filament-mail-templates::admin.from email'))
                            ->helperText(
                                __('filament-mail-templates::admin.from email help :email', [
                                    'email' => MailTemplateFallbacks::getFromMail(),
                                ])
                            ),
                    ]),

                    Repeater::make('to_email')
                        ->label(__('filament-mail-templates::admin.to email'))
                        ->helperText(
                            __('filament-mail-templates::admin.to email help :email', [
                                'email' => MailTemplateFallbacks::getToMail()['email'] ?? '',
                            ])
                        )
                        ->hidden(fn (MailTemplate $record) => ! $record->getMailTemplate()->hasTargetField())
                        ->schema([
                            Grid::make()->schema([
                                TextInput::make('email')
                                    ->label(__('filament-mail-templates::admin.email'))
                                    ->required(),

                                Select::make('type')
                                    ->label(__('filament-mail-templates::admin.type'))
                                    ->required()
                                    ->options([
                                        'to' => __('filament-mail-templates::admin.type to'),
                                        'cc' => __('filament-mail-templates::admin.type cc'),
                                        'bcc' => __('filament-mail-templates::admin.type bcc'),
                                    ]),
                            ]),
                        ]),
                ])
                ->translatableFields(fn (string $locale) => [
                    Grid::make(3)->schema([
                        Grid::make(1)
                            ->columnSpan(['lg' => 2])
                            ->schema([
                                TextInput::make('subject')
                                    ->label(__('filament-mail-templates::admin.subject')),
                                TiptapEditor::make('body')
                                    ->label(__('filament-mail-templates::admin.body')),
                            ]),

                        PlaceholderInput::make('variables')
                            ->label(__('filament-mail-templates::admin.variables'))
                            ->linksWith(["{$locale}.subject", "{$locale}.body"])
                            ->defaultLink("{$locale}.body")
                            ->copyable(),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('identifier')
                    ->label(__('filament-mail-templates::admin.identifier'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label(__('filament-mail-templates::admin.description')),

                LocalesColumn::make('online'),
            ])
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->url(fn (MailTemplate $record) => self::getUrl('preview', [$record]))
                    ->label(__('filament-mail-templates::preview.button label'))
                    ->icon('heroicon-o-eye'),

                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('identifier');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMailTemplates::route('/'),
            'preview' => Pages\PreviewMailTemplate::route('/{record}/preview'),
            'edit' => Pages\EditMailTemplate::route('/{record}/edit'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-mail-templates::admin.template resource label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-mail-templates::admin.template resource label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-mail-templates::admin.template resource singular label');
    }
}
