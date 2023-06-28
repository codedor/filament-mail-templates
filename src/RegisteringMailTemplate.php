<?php

namespace Codedor\FilamentMailTemplates;

use Codedor\FilamentMailTemplates\Models\MailTemplate;

class RegisteringMailTemplate
{
    public null | string $locale = null;
    public null | string $view = null;
    public null | string $description = null;

    public function __construct(
        public string $identifier,
        public string $resourceType,
    ) {
        //
    }

    public function view(null | string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getView(): string
    {
        return $this->view ?? config('filament-mail-templates.default.view');
    }

    public function locale(null | string $locale): self
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

    public function getTemplateModel(): MailTemplate
    {
        return MailTemplate::query()
            ->where('identifier', $this->getIdentifier())
            ->first();
    }

    public static function make(string $identifier, string $resourceType): self
    {
        return new static($identifier, $resourceType);
    }
}
