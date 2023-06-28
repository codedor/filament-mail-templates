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
    ) {
        $this->template = $registeredTemplate->getTemplateModel();
        $this->locale($locale);
    }

    public function envelope(): Envelope
    {
        if ($this->to === []) {
            $this->to($this->template->getToEmail());
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
        try {
            MailHistory::create([
                'mail_template_id' => $this->template->id,
                'to_email' => $this->to[0]['address'] ?? null,
                'from_email' => $this->envelope()->from->address,
                'from_name' => $this->envelope()->from->name,
                'subject' => $this->template->subject,
                'content' => $this->render(),
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $th) {
            report($th);
        }

        return parent::send($mailer);
    }

    public function parseVariables(string $content): string
    {
        $data = $this->item->getMailVariables();

        return preg_replace_callback(
            '/{{ (?<keyword>.*?) }}/',
            fn ($match) => data_get($data, $match['keyword']),
            $content
        );
    }
}
