<?php

namespace Wotz\FilamentMailTemplates\Console\Commands;

use Wotz\FilamentMailTemplates\Facades\MailTemplateCollection;
use Wotz\FilamentMailTemplates\MailTemplateBuilder;
use Wotz\FilamentMailTemplates\Models\MailTemplate;
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
