<?php

namespace Codedor\FilamentMailTemplates\Filament\Resources;

use Codedor\FilamentMailTemplates\Filament\Resources\MailHistoryResource\Pages;
use Codedor\FilamentMailTemplates\Models\MailHistory;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
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

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Recipients')->schema([
                    TextEntry::make('to_email')
                        ->label('Recipients')
                        ->state(fn ($record) => implode(', ', $record->to_emails)),

                    TextEntry::make('cc_email')
                        ->label('Recipients (CC)')
                        ->state(fn ($record) => implode(', ', $record->cc_emails)),

                    TextEntry::make('bcc_email')
                        ->label('Recipients (BCC)')
                        ->state(fn ($record) => implode(', ', $record->bcc_emails)),
                ]),

                TextEntry::make('preview')
                    ->columnSpan(['lg' => 2])
                    ->label('Content of the sent mail')
                    ->state(fn ($record) => view('filament-mail-templates::filament.forms.preview-column', [
                        'record' => $record,
                    ])),

                \Filament\Schemas\Components\Section::make('Debug data')->schema([
                    \Filament\Schemas\Components\Grid::make()->schema([
                        TextEntry::make('created_at')
                            ->label('Sent at')
                            ->state(fn ($record) => $record->created_at->format('Y-m-d H:i:s')),

                        TextEntry::make('template')
                            ->label('Used template')
                            ->state(fn ($record) => $record->template?->identifier),

                        TextEntry::make('mailed_resource_type')
                            ->state(fn ($record) => $record->mailed_resource_type),

                        TextEntry::make('mailed_resource_id')
                            ->label('Mailed resource ID')
                            ->state(fn ($record) => $record->mailed_resource_id),
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
                \Filament\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
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
