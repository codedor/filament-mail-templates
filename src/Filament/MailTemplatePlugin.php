<?php

namespace Wotz\FilamentMailTemplates\Filament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Wotz\FilamentMailTemplates\Filament\Resources\MailHistoryResource;
use Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource;

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
