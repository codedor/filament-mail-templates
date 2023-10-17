<?php

namespace Codedor\FilamentMailTemplates\Facades;

class MailTemplateFallbacks extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Codedor\FilamentMailTemplates\MailTemplateFallbacks::class;
    }
}
