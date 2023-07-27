<?php

namespace Codedor\FilamentSettings\Filament;

use Codedor\FilamentMailTemplates\Filament\MailTemplateResource;
use Codedor\FilamentMailTemplates\Filament\Resources\MailHistoryResource;
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
