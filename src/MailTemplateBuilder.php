<?php

namespace Wotz\FilamentMailTemplates;

use Wotz\FilamentMailTemplates\Mail\MailableTemplate;
use Wotz\FilamentMailTemplates\Models\MailTemplate;

class MailTemplateBuilder
{
    public ?string $locale = null;

    public ?string $view = null;

    public ?string $description = null;

    public ?bool $hasTargetField = true;

    public function __construct(
        public string $identifier,
        public string $resourceType,
    ) {
        //
    }

    public function view(?string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getView(): string
    {
        return $this->view ?? config('filament-mail-templates.default.view');
    }

    public function locale(?string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale ?? app()->getLocale();
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getResourceType(): string
    {
        return $this->resourceType;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function disableTargetField(): self
    {
        $this->hasTargetField = false;

        return $this;
    }

    public function hasTargetField(): bool
    {
        return $this->hasTargetField;
    }

    public function getTemplateModel(): MailTemplate
    {
        return MailTemplate::query()
            ->where('identifier', $this->getIdentifier())
            ->first();
    }

    public function renderPreview(?string $locale = null)
    {
        return (new MailableTemplate(
            $this,
            $this->getTemplateModel(),
            $locale ?? $this->getLocale(),
            true
        ))->render();
    }

    public static function make(string $identifier, string $resourceType): self
    {
        return new static($identifier, $resourceType);
    }
}
