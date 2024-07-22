<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificationCode extends Notification
{
    use Queueable;

    protected $verification_code;

    public function __construct($verification_code)
    {
        $this->verification_code = $verification_code;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url('/verify?verification_code=' . $this->verification_code);

        return (new MailMessage)
                    ->subject('Código de Verificación')
                    ->greeting('¡Hola!')
                    ->line('Tu código de verificación es: ' . $this->verification_code)
                    ->action('Verificar Email', $url)
                    ->line('Si tienes problemas haciendo clic en el botón "Verificar Email", copia y pega la URL a continuación en tu navegador web: ' . $url)
                    ->salutation('Saludos, Marandu');
    }
}
