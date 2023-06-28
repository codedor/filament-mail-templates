<?php

namespace Codedor\FilamentMailTemplates;

use Illuminate\Support\Collection;

class MailTemplateCollection extends Collection
{
    public function addTemplate(RegisteringMailTemplate $template): self
    {
        return $this->add($template);
    }

    public function getTemplate(string $identifier): RegisteringMailTemplate
    {
        return $this->first(function (RegisteringMailTemplate $template) use ($identifier) {
            return $template->getIdentifier() === $identifier;
        });
    }
}
