<?php

namespace App\Notifications;

use App\Models\Formation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FormationAcheteAdmin extends Notification implements ShouldQueue
{
    use Queueable;

    public $formation;
    public $payement_id;
    public $date;
    public $user_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Formation $formation, string $payement_id,string $date, string $user_id)
    {
        $this->formation = $formation;
        $this->payement_id = $payement_id;
        $this->date = $date;
        $this->user_id = $user_id;
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
                    ->line('Formation achetée')
                    ->line('Formation:' .$this->formation->nom)
                    ->line('Montant payé:' .$this->formation->prix)
                    ->line('ID utilisateur: ' .$this->user_id)
                    ->line('Payement ID: ' .$this->payement_id)
                    ->line('Date Achat:' .$this->date)
                    ->action('Voir payement', route('admin.payements.show', $this->payement_id));
    }

    public function toDatabase()
    {
        return [
            'amount' => $this->formation->prix,
            'formation' => $this->formation->nom,
            'date' => $this->date,
            'payement_id' => $this->payement_id,
            'nom_utilisateur' => $this->user_id
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
