<?php

namespace Codedor\FilamentMailTemplates\Console\Commands;

use Codedor\FilamentMailTemplates\Facades\MailTemplateCollection;
use Codedor\FilamentMailTemplates\MailTemplateBuilder;
use Codedor\FilamentMailTemplates\Models\MailTemplate;
use Illuminate\Console\Command;

class CreateMailTemplates extends Command
{
    protected $signature = 'filament-mail-templates:create';

    protected $description = 'Find and create new mail templates, defined in the service provider';

    public function handle(): void
    {
        MailTemplateCollection::each(function (MailTemplateBuilder $builder) {
            MailTemplate::updateOrCreate([
                'identifier' => $builder->getIdentifier(),
            ]);
        });
    }
}
