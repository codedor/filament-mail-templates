<?php

namespace Codedor\FilamentMailTemplates\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $mail_template_id
 * @property string $mailed_resource_type
 * @property string $mailed_resource_id
 * @property string $to_emails
 * @property string $cc_emails
 * @property string $bcc_emails
 * @property string $from_email
 * @property string $from_name
 * @property string $subject
 * @property string $content
 * @property string $locale
 */
class MailHistory extends Model
{
    protected $table = 'mail_history';

    protected $fillable = [
        'mail_template_id',
        'mailed_resource_type',
        'mailed_resource_id',
        'to_emails',
        'cc_emails',
        'bcc_emails',
        'from_email',
        'from_name',
        'subject',
        'content',
        'locale',
    ];

    public $casts = [
        'to_emails' => 'array',
        'cc_emails' => 'array',
        'bcc_emails' => 'array',
    ];

    public function template()
    {
        return $this->belongsTo(MailTemplate::class, 'mail_template_id');
    }

    public static function booted()
    {
        static::addGlobalScope('sorting', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }
}
