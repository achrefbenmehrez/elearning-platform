<?php

namespace App\Http\Controllers\Back;

use App\Models\Channel;
use App\Models\Formation;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Payement;

class DashboardController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $total = 0;
        $payements = Payement::all();
        foreach($payements as $payement)
        {
            $total += $payement->montant_paye;
        }
        $user_number = User::all()->count();

        $derniere = Formation::latest()->first()?->nom;

        $chaines = Channel::all();
        $meilleure_chaine = new Channel();
        foreach($chaines as $chaine)
        {
            if(count($chaine->discussions) > count($meilleure_chaine->discussions))
            {
                $meilleure_chaine = $chaine;
            }
        }

        $monthly['jan'] = User::whereMonth('created_at', '1')->count();
        $monthly['feb'] = User::whereMonth('created_at', '2')->count();
        $monthly['mars'] = User::whereMonth('created_at', '3')->count();
        $monthly['april'] = User::whereMonth('created_at', '4')->count();
        $monthly['may'] = User::whereMonth('created_at', '5')->count();
        $monthly['june'] = User::whereMonth('created_at', '6')->count();
        $monthly['july'] = User::whereMonth('created_at', '7')->count();
        $monthly['aug'] = User::whereMonth('created_at', '8')->count();
        $monthly['sept'] = User::whereMonth('created_at', '9')->count();
        $monthly['oct'] = User::whereMonth('created_at', '10')->count();
        $monthly['nov'] = User::whereMonth('created_at', '11')->count();
        $monthly['dec'] = User::whereMonth('created_at', '12')->count();

        $nmbre_admins = User::whereHas('roles', function($q){
            $q->where('name', 'admin');
            })->count();

        $nmbre_tuteurs = User::whereHas('roles', function($q){
            $q->where('name', 'tuteur');
            })->count();

        $nmbre_clients = User::whereHas('roles', function($q){
            $q->where('name', 'client');
            })->count();

        $count = array("daily" => 0, "weekly" => 0, "monthly" => 0);
        $count['daily'] = User::where('created_at','>=',Carbon::today())->count();
        $count['weekly'] = User::where('created_at','>=',Carbon::today()->subDays(7))->count();
        $count['monthly'] = User::where('created_at','>=',Carbon::today()->subDays(30))->count();

        return view('back.index', [
            'total' => $total,
            'user_number' => $user_number,
            'monthly' => $monthly,
            'count' => $count,
            'admins' => $nmbre_admins,
            'tuteurs' => $nmbre_tuteurs,
            'clients' => $nmbre_clients,
            'derniere' => $derniere,
            'chaine' => $meilleure_chaine
        ]);
    }
}
