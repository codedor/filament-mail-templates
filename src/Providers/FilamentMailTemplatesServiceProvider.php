<?php

namespace Codedor\FilamentMailTemplates\Providers;

use Codedor\FilamentMailTemplates\Console\Commands;
use Codedor\FilamentMailTemplates\Filament;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentMailTemplatesServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        Filament\MailTemplateResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-mail-templates')
            ->setBasePath(__DIR__ . '/../')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews('filament-mail-templates')
            ->hasMigrations([
                '2023_06_23_072639_create_mail_templates_table',
                '2023_06_23_130040_create_mail_history_table',
            ])
            ->runsMigrations()
            ->hasConsoleCommands([
                Commands\CreateMailTemplates::class,
            ]);
    }
}
