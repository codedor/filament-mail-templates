<?php

namespace Codedor\FilamentMailTemplates\Console\Commands;

use Codedor\FilamentMailTemplates\Facades\MailTemplateCollection;
use Codedor\FilamentMailTemplates\Models\MailTemplate;
use Codedor\FilamentMailTemplates\RegisteringMailTemplate;
use Illuminate\Console\Command;

class CreateMailTemplates extends Command
{
    protected $signature = 'filament-mail-templates:create';

    protected $description = 'Find and create new mail templates, defined in the service provider';

    public function handle(): void
    {
        MailTemplateCollection::each(function (RegisteringMailTemplate $template) {
            MailTemplate::updateOrCreate([
                'identifier' => $template->getIdentifier(),
            ]);
        });
    }
}
