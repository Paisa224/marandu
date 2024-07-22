<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeNotification extends Notification
{
    use Queueable;

    private $liker;
    private $tweet;

    public function __construct($liker, $tweet)
    {
        $this->liker = $liker;
        $this->tweet = $tweet;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("{$this->liker} le ha dado like a tu tweet.")
                    ->action('Ver Tweet', url('/tweets/'.$this->tweet->id))
                    ->line('¡Gracias por usar nuestra aplicación!');
    }

    public function toArray($notifiable)
    {
        return [
            'liker' => $this->liker,
            'tweet_id' => $this->tweet->id,
        ];
    }
}

