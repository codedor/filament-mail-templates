<?php

namespace Wotz\FilamentMailTemplates\Filament\Resources\MailHistoryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Wotz\FilamentMailTemplates\Filament\Resources\MailHistoryResource;

class ListMailHistories extends ListRecords
{
    protected static string $resource = MailHistoryResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
