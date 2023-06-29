<?php

namespace Codedor\FilamentMailTemplates\Filament\MailHistoryResource\Pages;

use Codedor\FilamentMailTemplates\Filament\MailHistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMailHistory extends ViewRecord
{
    protected static string $resource = MailHistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
