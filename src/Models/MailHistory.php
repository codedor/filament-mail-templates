<?php

namespace Codedor\FilamentMailTemplates\Models;

use Illuminate\Database\Eloquent\Model;

class MailHistory extends Model
{
    protected $table = 'mail_history';

    protected $fillable = [
        'mail_template_id',
        'to_email',
        'from_email',
        'from_name',
        'subject',
        'content',
        'locale',
    ];

    public function template()
    {
        return $this->belongsTo(MailTemplate::class, 'mail_template_id');
    }
}
