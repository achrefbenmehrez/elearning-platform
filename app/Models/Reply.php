<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;

    public $guarded = [];

    public function owner ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function discussion ()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select reply_id, sum(liked) likes, sum(!liked) dislikes from likes group by reply_id',
            'likes',
            'likes.reply_id',
            'reply_id'
        );
    }

    public function like ($user = null, $liked = 1)
    {
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id()
        ], [
            'liked' => $liked
        ]);
    }

    public function dislike ($user, $liked = 0)
    {
        $this->like($user, $liked);
    }

    public function isLikedBy(User $user)
    {
        return (bool)
                $user->likes
                ->where('reply_id', $this->id)
                ->where('liked', 1)
                ->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool)
                $user->likes
                ->where('reply_id', $this->id)
                ->where('liked', 0)
                ->count();
    }

    public function likeCount ()
    {
        return $this->likes
                    ->where('liked', 1)
                    ->count();
    }

    public function dislikeCount ()
    {
        return $this->likes
                        ->where('liked', 0)
                        ->count();
    }

    public function unlike(User $user)
    {
        $this->likes->where('user_id', $user->id)->first()->delete();
    }

    public function likes ()
    {
        return $this->hasMany(Like::class);
    }
}
