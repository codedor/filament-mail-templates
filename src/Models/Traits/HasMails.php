<?php

namespace Wotz\FilamentMailTemplates\Models\Traits;

use Wotz\FilamentMailTemplates\Facades\MailTemplateCollection;
use Wotz\FilamentMailTemplates\Mail\MailableTemplate;
use Wotz\FilamentMailTemplates\MailTemplateBuilder;

trait HasMails
{
    public function mail(string $identifier, ?string $locale = null): MailableTemplate
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

        MailTemplateCollection::add($builder);

        return $builder;
    }

    public function getPlaceholderVariables(): array
    {
        return [];
    }
}
