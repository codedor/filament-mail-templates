<?php

namespace Codedor\FilamentMailTemplates\Filament\Resources\MailHistoryResource\Pages;

use Codedor\FilamentMailTemplates\Filament\Resources\MailHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMailHistories extends ListRecords
{
    protected static string $resource = MailHistoryResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
