<?php

namespace Codedor\FilamentMailTemplates;

use Illuminate\Support\Collection;

class MailTemplateCollection extends Collection
{
    public function addTemplate(MailTemplateBuilder $builder): self
    {
        return $this->add($builder);
    }

    public function getTemplate(string $identifier): MailTemplateBuilder
    {
        return $this->first(function (MailTemplateBuilder $builder) use ($identifier) {
            return $builder->getIdentifier() === $identifier;
        });
    }
}
