<?php

namespace Codedor\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;

use Codedor\FilamentMailTemplates\Filament\Resources\MailTemplateResource;
use Filament\Resources\Pages\ListRecords;

class ListMailTemplates extends ListRecords
{
    protected static string $resource = MailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
