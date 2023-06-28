<?php

namespace Codedor\FilamentMailTemplates\Models\Traits;

use Codedor\FilamentMailTemplates\Facades\MailTemplateCollection;
use Codedor\FilamentMailTemplates\Mail\MailableTemplate;
use Codedor\FilamentMailTemplates\RegisteringMailTemplate;

trait HasMails
{
    public function mail(string $identifier, null | string $locale = null): MailableTemplate
    {
        $locale = $locale ?? app()->getLocale();
        $template = MailTemplateCollection::getTemplate($identifier);

        if (! $template) {
            throw new \Exception("Mail template with identifier `{$identifier}` not found.");
        }

        return new MailableTemplate($template, $this, $locale);
    }

    public static function registerMail($identifier): RegisteringMailTemplate
    {
        $template = RegisteringMailTemplate::make($identifier, self::class);

        MailTemplateCollection::addTemplate($template);

        return $template;
    }

    public function getMailVariables(): array
    {
        return [];
    }
}
