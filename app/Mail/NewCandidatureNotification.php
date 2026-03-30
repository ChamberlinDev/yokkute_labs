<?php

namespace App\Mail;

use App\Models\Candidature;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCandidatureNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Candidature $candidature)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle candidature - '.$this->candidature->prenom.' '.$this->candidature->nom,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.candidatures.new',
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        if ($this->candidature->cv_path && \Storage::disk('local')->exists($this->candidature->cv_path)) {
            $attachments[] = Attachment::fromPath(
                \Storage::disk('local')->path($this->candidature->cv_path)
            )->as('CV_' . $this->candidature->prenom . '_' . $this->candidature->nom . '.pdf');
        }

        return $attachments;
    }
}
