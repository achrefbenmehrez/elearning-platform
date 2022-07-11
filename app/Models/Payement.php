<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'formation_id', 'carte_id', 'created_at', 'updated_at', 'montant_paye'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carte()
    {
        return $this->belongsTo(Carte::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
