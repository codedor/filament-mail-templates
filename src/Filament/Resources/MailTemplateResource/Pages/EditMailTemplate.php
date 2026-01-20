<?php

namespace Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;

use Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource;
use Wotz\TranslatableTabs\Resources\Traits\HasTranslations;
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
