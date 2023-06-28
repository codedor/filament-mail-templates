<?php

namespace Codedor\FilamentMailTemplates\Models;

use Codedor\FilamentMailTemplates\Facades\MailTemplateCollection;
use Codedor\FilamentMailTemplates\RegisteringMailTemplate;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MailTemplate extends Model
{
    use HasTranslations;

    protected $fillable = [
        'identifier',
        'from_name',
        'from_email',
        'to_email',
        'subject',
        'body',
        'online',
    ];

    protected $translatable = [
        'subject',
        'body',
        'online',
    ];

    protected $casts = [
        'to_email' => 'array',
    ];

    public function getMailTemplate(): RegisteringMailTemplate
    {
        return MailTemplateCollection::getTemplate($this->identifier);
    }

    public function getDescriptionAttribute(): null|string
    {
        return $this->getMailTemplate()->getDescription();
    }

    public function getToEmail(): string
    {
        return $this->to_email
            ?? config('filament-mail-templates.default.to_email')
            ?? config('mail.from.address');
    }
}
