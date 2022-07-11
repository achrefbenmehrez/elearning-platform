<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'description', 'numero', 'video_url', 'formation_id', 'chapitre_id'
    ];

    public function formation ()
    {
        return $this->belongsTo(Formation::class);
    }

    public function chapitre ()
    {
        return $this->belongsTo(Chapitre::class);
    }
}
