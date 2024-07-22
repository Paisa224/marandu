<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FollowerTweetNotification extends Notification
{
    use Queueable;

    private $follower;
    private $tweet;

    public function __construct($follower, $tweet)
    {
        $this->follower = $follower;
        $this->tweet = $tweet;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("{$this->follower} ha publicado un nuevo tweet.")
                    ->action('Ver Tweet', url('/tweets/'.$this->tweet->id))
                    ->line('¡Gracias por usar nuestra aplicación!');
    }

    public function toArray($notifiable)
    {
        return [
            'follower' => $this->follower,
            'tweet_id' => $this->tweet->id,
        ];
    }
}
