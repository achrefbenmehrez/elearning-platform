<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'formation_id'
    ];

    public function episodes ()
    {
        return $this->hasMany(Episode::class);
    }

    public function formation ()
    {
        return $this->belongsTo(Formation::class);
    }

    public function tests ()
    {
        return $this->hasOne(Test::class);
    }

}
