<?php

namespace App\Http\Controllers\Front;

use App\Models\Discussion;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends \App\Http\Controllers\Controller
{
    public function store (Request $request, Discussion $discussion)
    {
        $request->validate([
            'content' => 'required', 'string'
        ]);

        auth()->user()->replies()->create([
            'discussion_id' => $discussion->id,
            'content' => $request->content
        ]);

        return redirect()->back()->with('status', 'Reponse cree');
    }

    public function reply(Discussion $discussion, Reply $reply)
    {
        $discussion->markAsBestReply($reply);

        return redirect()->back()->with('status', 'Reponse de '.$reply->owner->nom_utilisateur. ' marquée comme meilleure réponse');
    }
}
