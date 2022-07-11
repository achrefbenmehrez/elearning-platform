<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Carte;
use App\Models\Reply;
use App\Models\Payement;
use App\Models\Formation;
use App\Models\Abonnement;
use App\Models\Discussion;
use App\Models\TestResult;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "nom_utilisateur",
        'email',
        'password',
        'profile_photo_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function cartes()
    {
        return $this->hasMany(Carte::class);
    }

    public function payements()
    {
        return $this->hasMany(Payement::class);
    }

    public function abonnement()
    {
        return $this->hasOne(Abonnement::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function testResult()
    {
        return $this->hasMany(TestResult::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
