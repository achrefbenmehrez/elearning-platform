<?php

namespace App\Http\Controllers\Back;

use App\Models\Discussion;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $replies = Reply::paginate(10);

        return view('back.replies.index', [
            'replies' => $replies
        ]);
    }

    public function create()
    {
        return view('back.replies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'string', 'exists:users,id'],
            'discussion_id' => ['required', 'string', 'exists:discussions,id'],
            'content' => ['required', 'string'],
        ]);

        Reply::create([
            'user_id' => $request->user_id,
            'content' => $request->content,
            'discussion_id' => $request->discussion_id,
        ]);

        return redirect()->route('admin.replies.index')->with('status', 'Reponse cree');
    }

    public function show(Reply $reply)
    {
        return view('back.replies.show', [
            'reply' => $reply
        ]);
    }

    public function edit(Reply $reply)
    {
        return view('back.replies.edit', [
            'reply' => $reply
        ]);
    }

    public function update(Request $request, Reply $reply)
    {
        $request->validate([
            'user_id' => ['required', 'string', 'exists:users,id'],
            'content' => ['required', 'string'],
            'discussion_id' => ['required', 'string', 'exists:discussions,id'],
        ]);

        $reply->user_id = $request->user_id;
        $reply->content = $request->content;
        $reply->discussion_id = $request->discussion_id;

        $reply->save();

        return redirect()->route('admin.replies.index')->with('status', 'Reponse modifiée');
    }

    public function destroy(Reply $reply)
    {
        $reply->delete();

        return redirect()->back()->with('status', 'Reponse supprimée');
    }
}
