<?php

namespace Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;

use Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource;
use Filament\Resources\Pages\ListRecords;

class ListMailTemplates extends ListRecords
{
    protected static string $resource = MailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
