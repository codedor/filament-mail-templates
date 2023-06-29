<?php

namespace Codedor\FilamentMailTemplates\Mail;

use Codedor\FilamentMailTemplates\Models\MailHistory;
use Codedor\FilamentMailTemplates\Models\MailTemplate;
use Codedor\FilamentMailTemplates\RegisteringMailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\HtmlString;

class MailableTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public MailTemplate $template;

    public function __construct(
        public RegisteringMailTemplate $registeredTemplate,
        public Model $item,
        string $locale,
        public bool $isPreview = false,
    ) {
        $this->template = $registeredTemplate->getTemplateModel();
        $this->locale($locale);
    }

    public function envelope(): Envelope
    {
        // Add the to, cc, and bcc addresses, but only add to if it's not empty
        foreach (['to', 'cc', 'bcc'] as $type) {
            if ($type !== 'to' || $this->to === []) {
                $this->{$type}($this->template->getEmailsFor($type));
            }
        }

        return new Envelope(
            subject: $this->parseVariables($this->template->subject),
            from: new Address(
                $this->template->from_email ?? config('mail.from.address'),
                $this->template->from_name ?? config('mail.from.name'),
            ),
        );
    }

    public function content(): Content
    {
        $body = nl2br($this->parseVariables($this->template->body));

        return new Content(
            view: $this->registeredTemplate->getView(),
            with: [
                'item' => $this->item,
                'body' => new HtmlString($body),
            ],
        );
    }

    public function send($mailer)
    {
        $mail = parent::send($mailer);

        // Do this AFTER sending the mail, so we have the correct envelope data
        try {
            MailHistory::create([
                'mail_template_id' => $this->template->id,
                'mailed_resource_type' => $this->item->getMorphClass(),
                'mailed_resource_id' => $this->item->getKey(),
                'to_emails' => collect($this->to)->pluck('address'),
                'cc_emails' => collect($this->cc)->pluck('address'),
                'bcc_emails' => collect($this->bcc)->pluck('address'),
                'from_email' => $this->envelope()->from->address,
                'from_name' => $this->envelope()->from->name,
                'subject' => $this->template->subject,
                'content' => $this->render(),
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $th) {
            report($th);
        }

        return $mail;
    }

    public function parseVariables(string $content): string
    {
        // Don't parse variables if we're previewing, because we have no data
        if ($this->isPreview) {
            return $content;
        }

        $data = $this->item->getMailVariables();

        return preg_replace_callback(
            '/{{ (?<keyword>.*?) }}/',
            fn ($match) => data_get($data, $match['keyword']),
            $content
        );
    }
}
