<?php

namespace Codedor\FilamentMailTemplates\Filament;

use Codedor\FilamentMailTemplates\Filament\Resources\MailHistoryResource;
use Codedor\FilamentMailTemplates\Filament\Resources\MailTemplateResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class MailTemplatePlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-mail-templates';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            MailTemplateResource::class,
            MailHistoryResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
