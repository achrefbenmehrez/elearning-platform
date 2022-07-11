<?php

namespace App\Http\Controllers\Front;
use id;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Carte;
use App\Models\Panier;
use App\Models\Payement;
use App\Models\Formation;
use App\Notifications\FormationAcheteAdmin;
use Illuminate\Http\Request;
use App\Notifications\FormationAchetee;
use Illuminate\Support\Facades\Notification;

class PayementController extends \App\Http\Controllers\Controller
{
    public function create(Request $request)
    {
        return view('front.payement.payement');
    }

    public function store(Request $request)
    {
        if(!session()->has('cart'))
        {
            return redirect()->back()->with('status', 'Votre panier est vide');
        }

        $carte = Carte::where('Nom_du_titulaire_de_la_carte', $request->nom_titulaire)
                      ->where('Numero_de_la_carte', $request->numero_carte)
                      ->where('date_expiration', $request->date_expiration)
                      ->where('CVV', $request->CVV)
                      ->where('Solde_de_la_carte', '>=', $request->total)
                      ->get();

        if($carte->isEmpty())
        {
            return redirect()->back()->with('status', 'Identifiants de carte de crédit non valides');
        }

        $formation_ids = array_keys(session('cart'));

        foreach($formation_ids as $formation_id)
        {
            $montant = session('cart')[$formation_id]['prix'];
            $payement = Payement::create([
                'user_id' => auth()->user()->id,
                'formation_id' => $formation_id,
                'montant_paye' => $montant,
                'carte_id' => $carte->toArray()[0]['id'],
                'created_at' => Carbon::now()
            ]);

            $carte->first()->Solde_de_la_carte -= $montant;
            $carte->first()->save();

            $formation = Formation::find($formation_id);
            $date = date("Y/m/d H:i:s", strtotime(Carbon::now()));
            $admins = User::whereHas('roles', function($q){
            $q->where('name', 'admin');
            })->get();
            Notification::send(auth()->user(), new FormationAchetee($formation, $date, auth()->user()->nom_utilisateur, substr($carte->first()->Numero_de_la_carte, -3), $carte->first()->date_expiration, $carte->first()->Nom_du_titulaire_de_la_carte, $payement->id));
            Notification::send($admins, new FormationAcheteAdmin($formation, $payement->id,$date,auth()->user()->id));
        }

        $request->session()->forget('cart');
        Panier::where('user_id', auth()->user()->id)->delete();

        return redirect()->route('home')->with('payement_success', 'Payement reussi');
    }
}
