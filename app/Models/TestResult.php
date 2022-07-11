<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'result',
        'question_number',
        'attempt',
        'correct',
        'wrong',
        'percentage',
        'user_id'
    ];

    protected $casts = [
        'result' => 'array'
    ];

    public function test ()
    {
        return $this->belongsTo(Test::class);
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
