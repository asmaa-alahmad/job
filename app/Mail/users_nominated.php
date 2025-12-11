<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class users_nominated extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $users;
    /**
     * Create a new message instance.
     */
    public function __construct($company, $users)
    {
        $this->company = $company;
        $this->users = $users;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Users Nominated Mail')
            ->markdown('emails.users_nominated');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.users_nominated',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
