<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type_abonnement_id', 'date_de_fin', 'carte_id', 'montant_paye'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carte()
    {
        return $this->belongsTo(Carte::class);
    }

    public function typeAbonnement()
    {
        return $this->belongsTo(TypeAbonnement::class);
    }
}
