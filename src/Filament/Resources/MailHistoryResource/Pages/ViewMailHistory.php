<?php

namespace Wotz\FilamentMailTemplates\Filament\Resources\MailHistoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Wotz\FilamentMailTemplates\Filament\Resources\MailHistoryResource;

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
