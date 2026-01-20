<?php

namespace Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;

use Filament\Panel;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\PageRegistration;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Wotz\FilamentMailTemplates\Filament\Resources\MailTemplateResource;
use Wotz\FilamentMailTemplates\Models\MailTemplate;
use Wotz\LocaleCollection\Facades\LocaleCollection;

class PreviewMailTemplate extends Page
{
    use InteractsWithRecord;

    protected static string $resource = MailTemplateResource::class;

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament-mail-templates::filament.pages.preview';

    public string $preview;

    public string $currentLocale;

    public array $locales;

    public function getBreadcrumb(): string
    {
        return __('filament-mail-templates::preview.button label');
    }

    public static function route(string $path): PageRegistration
    {
        return new PageRegistration(
            page: static::class,
            route: fn (Panel $panel): Route => FacadesRoute::get($path, static::class)
                ->middleware(static::getRouteMiddleware($panel)),
        );
    }

    public function getTitle(): string|Htmlable
    {
        return __('filament-mail-templates::preview.title :name', [
            'name' => $this->record->identifier,
        ]);
    }

    public function mount($record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->locales = LocaleCollection::toBase()->map->locale()->toArray();
        $this->currentLocale = head($this->locales);

        $this->updatedCurrentLocale($this->currentLocale);
    }

    public function updatedCurrentLocale(string $locale): void
    {
        $this->preview = $this->record
            ->getMailTemplate()
            ->renderPreview($locale);

        $this->dispatch('filament-mail-templates::update-preview-content', [
            'content' => $this->preview,
        ]);
    }

    public static function getResource(): string
    {
        return static::$resource;
    }

    protected function resolveRecord($key): Model
    {
        $record = static::getResource()::resolveRecordRouteBinding($key);

        if ($record === null) {
            throw (new ModelNotFoundException)->setModel(MailTemplate::class, [$key]);
        }

        return $record;
    }

    public function getSubNavigation(): array
    {
        return [];
    }
}
