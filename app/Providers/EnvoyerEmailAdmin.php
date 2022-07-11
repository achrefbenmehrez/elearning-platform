<?php

namespace App\Providers;

use App\Events\NouveauAbonnement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EnvoyerEmailAdmin
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
     * @param  NouveauAbonnement  $event
     * @return void
     */
    public function handle(NouveauAbonnement $event)
    {
        //
    }
}
