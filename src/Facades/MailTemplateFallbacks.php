<?php

namespace Wotz\FilamentMailTemplates\Facades;

class MailTemplateFallbacks extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Wotz\FilamentMailTemplates\MailTemplateFallbacks::class;
    }
}
