<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    public $guarded = [];

    public function author ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies ()
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsBestReply(Reply $reply)
    {
        $this->update([
           'reply_id' => $reply->id
        ]);
    }

    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function getBestReply()
    {
        return Reply::find($this->reply_id);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilterByChannels($builder)
    {
        if(request()->query('channel'))
        {
            $channel = Channel::where('slug', request()->query('channel'))->first();

            if($channel)
            {
                return $builder->where('channel_id', $channel->id);
            }

            return $builder;
        }

        return $builder;
    }
}
