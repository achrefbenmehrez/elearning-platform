<?php

namespace App\Notifications;

use DateTime;
use App\Models\Formation;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Date;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FormationAchetee extends Notification implements ShouldQueue
{
    use Queueable;

    public $formation;
    public $date;
    public $name;
    public $numero;
    public $date_exp;
    public $nom_carte;
    public $payement_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Formation $formation, string $date, string $name, int $numero, string $date_exp, string $nom_carte, string $payement_id)
    {
        $this->formation = $formation;
        $this->name = $name;
        $this->date = $date;
        $this->numero = $numero;
        $this->date_exp = $date_exp;
        $this->nom_carte = $nom_carte;
        $this->payement_id = $payement_id;
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
                    ->markdown('front.emails.payement', [
                        'name' => $this->name,
                        'numero' => $this->numero,
                        'date_exp' => $this->date_exp,
                        'nom_carte' => $this->nom_carte,
                        'date' => $this->date,
                        'payement_id' => $this->payement_id,
                        'nom_formation' => $this->formation->nom,
                        'prix' => $this->formation->prix,
                    ]);
    }

    public function toDatabase()
    {
        return [
            'amount' => $this->formation->prix,
            'formation' => $this->formation->nom,
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
