<?php

namespace Codedor\FilamentMailTemplates;

class MailTemplateFallbacks
{
    public null|string $fromName = null;
    public null|string $fromMail = null;

    public function __construct()
    {
        $this->fromName = config('mail.from.name');
        $this->fromMail = config('mail.from.address');
    }

    public function fromName(null|string $fromName): self
    {
        $this->fromName = $fromName;

        return $this;
    }

    public function getFromName(): null|string
    {
        return $this->fromName;
    }

    public function fromMail(null|string $fromMail): self
    {
        $this->fromMail = $fromMail;

        return $this;
    }

    public function getFromMail(): null|string
    {
        return $this->fromMail;
    }
}
