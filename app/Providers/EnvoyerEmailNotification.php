<?php

namespace App\Providers;

use App\Events\FinAbonnement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EnvoyerEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FinAbonnement  $event
     * @return void
     */
    public function handle(FinAbonnement $event)
    {
        //
    }
}
