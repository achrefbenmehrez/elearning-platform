<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'chapitre_id', 'formation_id'];

    public function chapitre ()
    {
        return $this->belongsTo(Chapitre::class);
    }

    public function questions ()
    {
        return $this->hasMany(Question::class);
    }

    public function options ()
    {
        return $this->hasMany(Option::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}
