<?php

namespace Codedor\FilamentMailTemplates\Filament\MailHistoryResource\Pages;

use Codedor\FilamentMailTemplates\Filament\MailHistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMailHistories extends ListRecords
{
    protected static string $resource = MailHistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
