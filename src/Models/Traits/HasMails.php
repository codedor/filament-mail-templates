<?php

namespace Codedor\FilamentMailTemplates\Models\Traits;

use Codedor\FilamentMailTemplates\Facades\MailTemplateCollection;
use Codedor\FilamentMailTemplates\Mail\MailableTemplate;
use Codedor\FilamentMailTemplates\MailTemplateBuilder;

trait HasMails
{
    public function mail(string $identifier, string $locale = null): MailableTemplate
    {
        $locale = $locale ?? app()->getLocale();
        $template = MailTemplateCollection::getTemplate($identifier);

        if (! $template) {
            throw new \Exception("Mail template with identifier `{$identifier}` not found.");
        }

        return new MailableTemplate($template, $this, $locale);
    }

    public static function registerMail($identifier): MailTemplateBuilder
    {
        $builder = MailTemplateBuilder::make($identifier, self::class);

        MailTemplateCollection::addTemplate($builder);

        return $builder;
    }

    public function getPlaceholderVariables(): array
    {
        return [];
    }
}
