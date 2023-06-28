<?php

namespace Codedor\FilamentMailTemplates\Filament\MailTemplateResource\Pages;

use Codedor\FilamentMailTemplates\Filament\MailTemplateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMailTemplates extends ListRecords
{
    protected static string $resource = MailTemplateResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
