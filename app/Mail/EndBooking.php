<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class EndBooking extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $title;
    public $color;
    public $start_date;
    public $end_date;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $title, $color, $start_date, $end_date)
    {
        $this->name = $name;
        $this->title = $title;
        $this->color = $color;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'End Booking',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.end_booking',
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
