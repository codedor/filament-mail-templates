<?php

namespace Codedor\FilamentMailTemplates\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Notifications\Notification;

class MailVariablesInput extends Field
{
    protected string $view = 'filament-mail-templates::forms.components.mail-variables-input';

    public function setUp(): void
    {
        // Register some listeners
        $this->registerListeners([
            'filament-mail-templates-input::copyNotification' => [
                function (self $component, string $statePath, string $key): void {
                    if ($component->getStatePath() !== $statePath) {
                        return;
                    }

                    Notification::make()
                        ->title(__('filament-mail-templates::builder.copied :key to clipboard', [
                            'key' => $key,
                        ]))
                        ->success()
                        ->send();
                },
            ],
        ]);

        // Don't save the state as a normal field
        $this->dehydrated(false);
    }

    public function getMailVariables(): iterable
    {
        $model = new ($this->getRecord()->getMailTemplate()->getResourceType());

        return collect($model->getMailVariables())->keys();
    }
}
