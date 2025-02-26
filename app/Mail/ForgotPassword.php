<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable {
    use Queueable, SerializesModels;

    public $token;

    /**
    * Create a new message instance.
    */

    public function __construct( $token ) {
        $this->token = $token;
    }

    /**
    * Get the message envelope.
    */

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Reset Your Password'
        );
    }

    /**
    * Get the message content definition.
    */

    public function content(): Content {
        return new Content(
            view: 'emails.forgot_password', // Update with the correct Blade file
            with: [
                'token' => $this->token,
            ],
        );
    }

    /**
    * Get the attachments for the message.
    */

    public function attachments(): array {
        return [];
    }
}
