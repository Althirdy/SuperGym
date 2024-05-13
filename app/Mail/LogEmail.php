<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LogEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    public $name;
    public $loginDate;
    public $loginTime;

    /**
     * Create a new message instance.
     *
     * @param  string  $name
     * @param  string  $loginDate
     * @param  string  $loginTime
     * @return void
     */
    public function __construct($name, $loginDate, $loginTime)
    {
        $this->name = $name;
        $this->loginDate = $loginDate;
        $this->loginTime = $loginTime;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Log Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email.LogEmail',
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
