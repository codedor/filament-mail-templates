<?php

namespace Codedor\FilamentMailTemplates\Filament\Resources;

use Codedor\FilamentMailTemplates\Filament\Resources\MailHistoryResource\Pages;
use Codedor\FilamentMailTemplates\Models\MailHistory;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class MailHistoryResource extends Resource
{
    protected static ?string $model = MailHistory::class;

    public static function getNavigationGroup(): ?string
    {
        return config(
            'filament-mail-templates.navigation.history.group',
            parent::getNavigationGroup()
        );
    }

    public static function getNavigationIcon(): string
    {
        return config(
            'filament-mail-templates.navigation.history.icon',
            parent::getNavigationIcon()
        );
    }

    public static function shouldRegisterNavigation(): bool
    {
        return config(
            'filament-mail-templates.navigation.history.shown',
            parent::shouldRegisterNavigation()
        );
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Recipients')->schema([
                    Placeholder::make('to_email')
                        ->label('Recipients')
                        ->content(fn ($record) => implode(', ', $record->to_emails)),

                    Placeholder::make('cc_email')
                        ->label('Recipients (CC)')
                        ->content(fn ($record) => implode(', ', $record->cc_emails)),

                    Placeholder::make('bcc_email')
                        ->label('Recipients (BCC)')
                        ->content(fn ($record) => implode(', ', $record->bcc_emails)),
                ]),

                Placeholder::make('preview')
                    ->columnSpan(['lg' => 2])
                    ->label('Content of the sent mail')
                    ->content(fn ($record) => view('filament-mail-templates::filament.forms.preview-column', [
                        'record' => $record,
                    ])),

                Section::make('Debug data')->schema([
                    Grid::make()->schema([
                        Placeholder::make('created_at')
                            ->label('Sent at')
                            ->content(fn ($record) => $record->created_at->format('Y-m-d H:i:s')),

                        Placeholder::make('template')
                            ->label('Used template')
                            ->content(fn ($record) => $record->template?->identifier),

                        Placeholder::make('mailed_resource_type')
                            ->content(fn ($record) => $record->mailed_resource_type),

                        Placeholder::make('mailed_resource_id')
                            ->label('Mailed resource ID')
                            ->content(fn ($record) => $record->mailed_resource_id),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Sent at')
                    ->sortable(),

                TextColumn::make('template')
                    ->label('Sent template')
                    ->getStateUsing(fn ($record) => $record->template?->identifier)
                    ->sortable(),

                TextColumn::make('to_emails')
                    ->label('Recipients')
                    ->getStateUsing(fn ($record) => $record->to_emails)
                    ->html()
                    ->searchable(),
            ])
            ->filters([
                Filter::make('to_email'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMailHistories::route('/'),
            'view' => Pages\ViewMailHistory::route('/{record}/view'),
        ];
    }
}
