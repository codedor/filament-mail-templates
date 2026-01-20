<?php

namespace Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource;

class ListMailTemplates extends ListRecords
{
    protected static string $resource = MailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
