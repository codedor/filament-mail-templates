<?php

namespace Codedor\FilamentMailTemplates\Facades;

class MailTemplateCollection extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Codedor\FilamentMailTemplates\MailTemplateCollection::class;
    }
}
