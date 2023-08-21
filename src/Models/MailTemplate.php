<?php

namespace Codedor\FilamentMailTemplates\Models;

use Codedor\FilamentMailTemplates\Facades\MailTemplateCollection;
use Codedor\FilamentMailTemplates\MailTemplateBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $identifier
 * @property string $from_name
 * @property string $from_email
 * @property string $to_email
 * @property string $subject
 * @property string $body
 */
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
    ];

    protected $translatable = [
        'subject',
        'body',
        'online',
    ];

    protected $casts = [
        'to_email' => 'array',
    ];

    public function getMailTemplate(): MailTemplateBuilder
    {
        return MailTemplateCollection::getTemplate($this->identifier);
    }

    public function getPlaceholderVariables(): array
    {
        $model = $this->getMailTemplate()->getResourceType();

        if (! $model || ! method_exists($model, 'getPlaceholderVariables')) {
            return [];
        }

        return (new $model)->getPlaceholderVariables();
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->getMailTemplate()->getDescription();
    }

    public function getOnlineAttribute()
    {
        return true;
    }

    public function getEmailsFor(string $type): Collection
    {
        return $this->getAllEmails()
            ->filter(fn ($email) => $email['type'] === $type)
            ->pluck('email');
    }

    public function getAllEmails(): Collection
    {
        return Collection::wrap(
            $this->to_email
                ?? config('filament-mail-templates.default.to_email')
                ?? config('mail.from.address')
        );
    }
}
