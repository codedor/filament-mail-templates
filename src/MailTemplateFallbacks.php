<?php

namespace Codedor\FilamentMailTemplates;

class MailTemplateFallbacks
{
    public ?string $fromName = null;

    public ?string $fromMail = null;

    public ?string $toMail = null;

    public function __construct()
    {
        $this->fromName = config('mail.from.name');
        $this->fromMail = config('mail.from.address');
        $this->toMail = config('filament-mail-templates.default.to_email')
                ?? config('mail.from.address');
    }

    public function fromName(?string $fromName): self
    {
        $this->fromName = $fromName;

        return $this;
    }

    public function getFromName(): ?string
    {
        return $this->fromName;
    }

    public function fromMail(?string $fromMail): self
    {
        $this->fromMail = $fromMail;

        return $this;
    }

    public function getFromMail(): ?string
    {
        return $this->fromMail;
    }

    public function toMail(?string $toMail): self
    {
        $this->toMail = $toMail;

        return $this;
    }

    public function getToMail(): ?array
    {
        return $this->toMail ? [
            'email' => $this->toMail,
            'type' => 'to',
        ] : null;
    }
}
