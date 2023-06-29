<?php

namespace Codedor\FilamentMailTemplates\Filament\MailTemplateResource\Pages;

use Codedor\FilamentMailTemplates\Filament\MailTemplateResource;
use Codedor\TranslatableTabs\Resources\Traits\HasTranslations;
use Filament\Resources\Pages\EditRecord;

class EditMailTemplate extends EditRecord
{
    use HasTranslations;

    protected static string $resource = MailTemplateResource::class;
}
