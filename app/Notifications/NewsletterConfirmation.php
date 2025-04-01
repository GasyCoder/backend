<?php

namespace App\Notifications;

use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsletterConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $newsletter;

    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = url("/api/newsletter/verify/{$this->newsletter->verification_code}");

        return (new MailMessage)
            ->subject('Confirmez votre inscription à la newsletter')
            ->greeting('Bonjour!')
            ->line('Merci de vous être inscrit à ma newsletter!')
            ->line('Veuillez cliquer sur le bouton ci-dessous pour confirmer votre inscription:')
            ->action('Confirmer mon inscription', $verificationUrl)
            ->line('Si vous n\'avez pas demandé cette inscription, vous pouvez ignorer cet email.')
            ->salutation('Merci, BEZARA Florent');
    }
}
