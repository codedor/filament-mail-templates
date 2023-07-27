<?php

namespace Codedor\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;

use Codedor\FilamentMailTemplates\Filament\Resources\MailTemplateResource;
use Codedor\TranslatableTabs\Resources\Traits\HasTranslations;
use Filament\Resources\Pages\EditRecord;

class EditMailTemplate extends EditRecord
{
    use HasTranslations;

    protected static string $resource = MailTemplateResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
