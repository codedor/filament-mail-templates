<?php

namespace Wotz\FilamentMailTemplates\Providers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wotz\FilamentMailTemplates\Console\Commands;
use Wotz\FilamentMailTemplates\MailTemplateCollection;
use Wotz\FilamentMailTemplates\MailTemplateFallbacks;

class FilamentMailTemplatesServiceProvider extends PackageServiceProvider
{
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

    public function registeringPackage(): void
    {
        $this->app->singleton(MailTemplateCollection::class, function () {
            return new MailTemplateCollection;
        });

        $this->app->singleton(MailTemplateFallbacks::class, function () {
            return new MailTemplateFallbacks;
        });
    }
}
