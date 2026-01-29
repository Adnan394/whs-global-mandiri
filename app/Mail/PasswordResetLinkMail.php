<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetLinkMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $resetUrl;
    public $userName;

    /**
     * Create a new message instance.
     * @param string $resetUrl Link reset password lengkap dengan token.
     * @param string $userName Nama pengguna yang meminta reset.
     */
    public function __construct(string $resetUrl, string $userName)
    {
        $this->resetUrl = $resetUrl;
        $this->userName = $userName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permintaan Reset Password Anda',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.password-reset',
            with: [
                'name' => $this->userName,
                'resetLink' => $this->resetUrl,
                'expiryHours' => config('auth.passwords.users.expire') / 60, // Menghitung jam dari menit
            ],
        );
    }
}