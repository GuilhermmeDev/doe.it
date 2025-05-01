<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CampaignInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign;
    public $user;
    public $inviter;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($campaign, $user, $inviter, $token)
    {
        $this->campaign = $campaign;
        $this->user = $user;
        $this->inviter = $inviter;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Convite para campanha',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.campaign-invite',
            with: [
                'campaign' => $this->campaign,
                'user' => $this->user,
                'inviter' => $this->inviter,
                'token' => $this->token,
            ],
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
