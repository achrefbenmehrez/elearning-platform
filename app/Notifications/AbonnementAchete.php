<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AbonnementAchete extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $type_abonnement, float $montant_paye, string $date_achat, string $date_de_fin)
    {
        $this->abonnement = $type_abonnement;
        $this->montant = $montant_paye;
        $this->date = $date_achat;
        $this->date_de_fin = $date_de_fin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return explode(',', $notifiable->notification_preference);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                            ->line('Abonnement achetée')
                            ->line('Duree abonnement:' .$this->abonnement)
                            ->line('Montant payé:' .$this->montant)
                            ->line('Date Achat:' .$this->date)
                            ->line('Date Fin:' .$this->date_de_fin)
                            ->action('Telecharger', url('/'));
    }

    public function toDatabase()
    {
        return [
            'ammount' => $this->montant,
            'formation' => $this->abonnement,
            'date' => $this->date
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
