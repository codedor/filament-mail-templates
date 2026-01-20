<?php

namespace Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource;
use Wotz\TranslatableTabs\Resources\Traits\HasTranslations;

class EditMailTemplate extends EditRecord
{
    use HasTranslations;

    protected static string $resource = MailTemplateResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
