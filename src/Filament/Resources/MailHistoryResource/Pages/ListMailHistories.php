<?php

namespace Wotz\FilamentMailTemplates\Filament\Resources\MailHistoryResource\Pages;

use Wotz\FilamentMailTemplates\Filament\Resources\MailHistoryResource;
use Filament\Resources\Pages\ListRecords;

class ListMailHistories extends ListRecords
{
    protected static string $resource = MailHistoryResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
