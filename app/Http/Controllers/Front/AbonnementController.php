<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Carte;
use App\Models\Abonnement;
use App\Models\TypeAbonnement;
use App\Notifications\AbonnementAchete;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;

class AbonnementController extends \App\Http\Controllers\Controller
{
    public function create(Request $request)
    {
        if (auth()->user()->abonnement)
        {
            return Redirect::back()->withErrors(['Vous avez deja un abonnement']);;
        }

        $type_abonnement = DB::select('select * from type_abonnements where duree = ?', [$request->submit]);
        if(count($type_abonnement) == 0)
        {
            return abort(404);
        }
        else {
            return view('front.payement.abonnement', [
            'type_abonnement' => $type_abonnement[0]
        ]);
        }
    }

    public function store(Request $request, $type_abonnement_id)
    {

        $abonnement = TypeAbonnement::find($type_abonnement_id);
        $carte = Carte::where('Nom_du_titulaire_de_la_carte', $request->nom_titulaire)
                      ->where('Numero_de_la_carte', $request->numero_carte)
                      ->where('date_expiration', $request->date_expiration)
                      ->where('CVV', $request->CVV)
                      ->where('Solde_de_la_carte', '>=', $abonnement['prix'])
                      ->get();

        if($carte->isEmpty())
        {
            return redirect()->route('abonnements.create', [
                '_token' => csrf_token(),
                'submit' => $abonnement->duree
            ])->with('status', 'Identifiants de carte de crédit non valides');
        }

        $duree = explode(' ', trim($abonnement['duree']))[0];

        $a = Abonnement::create([
            'user_id' => auth()->user()->id,
            'type_abonnement_id' => $type_abonnement_id,
            'date_de_fin' => date('Y-m-d H:i:s', strtotime('+ '. $duree .' months', strtotime(date('Y-m-d H:i:s')))),
            'montant_paye' => $abonnement['prix'],
            'created_at' => Carbon::now(),
            'carte_id' => $carte[0]->id
        ]);

        $solde = $carte->toArray()[0]['Solde_de_la_carte'];
        Carte::where('Numero_de_la_carte', $request->numero_carte)->update(['Solde_de_la_carte' => $solde - $abonnement['prix']]);

        $date = date("Y/m/d H:i:s", strtotime(Carbon::now()));
        auth()->user()->notify(new AbonnementAchete($abonnement->duree, $abonnement->prix, $date, $a->date_de_fin));

        return redirect()->route('home')->with('status', 'Abonnement reussi');
    }
}
