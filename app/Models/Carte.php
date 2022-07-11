<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;

    protected $fillable = ["Nom_du_titulaire_de_la_carte", "Numero_de_la_carte", "mois_expiration", "annee_expiration", "CVV", "Solde_de_la_carte"];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function payements ()
    {
        return $this->hasMany(Payement::class);
    }

    public function abonnements ()
    {
        return $this->hasMany(Abonnement::class);
    }
}
