<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'photo_url',
        'slug',
        'user_id'
    ];

    public function payements()
    {
        return $this->hasMany(Payement::class);
    }

    public function categories ()
    {
        return $this->belongsToMany(Categorie::class);
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function chapitres ()
    {
        return $this->hasMany(Chapitre::class);
    }

    public function episodes ()
    {
        return $this->hasMany(Episode::class);
    }

    public function tests ()
    {
        return $this->hasMany(Test::class);
    }

    public function scopeFilterByChannels($builder)
    {
        $category = request()->query('category');
        if($category)
        {
            return Categorie::where('slug', $category)->first()->formations;
        }

        return $builder;
    }
}
