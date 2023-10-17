<?php

namespace Codedor\FilamentMailTemplates;

class MailTemplateFallbacks
{
    public ?string $fromName = null;

    public ?string $fromMail = null;

    public function __construct()
    {
        $this->fromName = config('mail.from.name');
        $this->fromMail = config('mail.from.address');
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
}
