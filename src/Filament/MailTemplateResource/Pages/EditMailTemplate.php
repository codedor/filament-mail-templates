<?php

namespace Codedor\FilamentMailTemplates\Filament\MailTemplateResource\Pages;

use Codedor\FilamentMailTemplates\Filament\MailTemplateResource;
use Codedor\TranslatableTabs\Resources\Traits\HasTranslations;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMailTemplate extends EditRecord
{
    use HasTranslations;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    protected static string $resource = MailTemplateResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
