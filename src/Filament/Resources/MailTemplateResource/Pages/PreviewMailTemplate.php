<?php

namespace Codedor\FilamentMailTemplates\Filament\Resources\MailTemplateResource\Pages;

use Codedor\FilamentMailTemplates\Filament\Resources\MailTemplateResource;
use Codedor\FilamentMailTemplates\Models\MailTemplate;
use Codedor\LocaleCollection\Facades\LocaleCollection;
use Filament\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PreviewMailTemplate extends Page
{
    use InteractsWithRecord;

    protected static string $resource = MailTemplateResource::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament-mail-templates::filament.pages.preview';

    public string $preview;

    public string $currentLocale;

    public array $locales;

    public static function route(string $path): array
    {
        return [
            'class' => static::class,
            'route' => $path,
        ];
    }

    public function getTitle(): string | Htmlable
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

        $this->dispatchBrowserEvent('filament-mail-templates::update-preview-content', [
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
}
