<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mailings extends Mailable
{
    use Queueable, SerializesModels;

    private $subject;
    private $markdown;
    public $data;
    private $from_mail;
    private $from_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $markdown, $data=[], $from_mail="hello@gemtrustsolutions.com", $from_name="Oyinpreye from Gemtrust")
    {
        $this->subject = $subject;
        $this->markdown = $markdown;
        $this->data = $data;
        $this->from_mail = $from_mail;
        $this->from_name = $from_name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->from_mail, $this->from_name),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.'.$this->markdown,
            with: [
                'data' => $this->data
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
