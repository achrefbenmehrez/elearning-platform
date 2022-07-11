<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'donnees_panier'];

    protected $casts = [
        'donnees_panier' => 'array'
    ];
}
