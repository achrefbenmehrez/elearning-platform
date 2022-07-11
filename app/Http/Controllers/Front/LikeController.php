<?php

namespace App\Http\Controllers\Front;

use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends \App\Http\Controllers\Controller
{
    public function like(Reply $reply)
    {
        $reply->like(auth()->user());

        return back();
    }

    public function dislike(Reply $reply)
    {
        $reply->dislike(auth()->user());

        return back();
    }

    public function unlike(Reply $reply)
    {
        $reply->unlike(auth()->user());

        return back();
    }

    public function undislike(Reply $reply)
    {
        $reply->unlike(auth()->user());

        return back();
    }
}
