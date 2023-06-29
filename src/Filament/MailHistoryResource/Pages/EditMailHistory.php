<?php

namespace Codedor\FilamentMailTemplates\Filament\MailHistoryResource\Pages;

use Codedor\FilamentMailTemplates\Filament\MailHistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMailHistory extends EditRecord
{
    protected static string $resource = MailHistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
