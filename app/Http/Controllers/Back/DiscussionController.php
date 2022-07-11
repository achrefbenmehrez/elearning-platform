<?php

namespace App\Http\Controllers\Back;

use App\Models\Channel;
use App\Models\Discussion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DiscussionController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $discussions = Discussion::paginate(10);

        return view('back.discussions.index', [
            'discussions' => $discussions
        ]);
    }

    public function create()
    {
        $channels = Channel::all();

        return view('back.discussions.create', [
            'channels' => $channels
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'string', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'channel_id' => ['required', 'string', 'exists:channels,id'],
        ]);

        Discussion::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'channel_id' => $request->channel_id,
        ]);

        return redirect()->route('admin.discussions.index')->with('status', 'Discussion cree');
    }

    public function show(Discussion $discussion)
    {
        return view('back.discussions.show', [
            'discussion' => $discussion
        ]);
    }

    public function edit(Discussion $discussion)
    {
        $channels = Channel::all();

        return view('back.discussions.edit', [
            'discussion' => $discussion,
            'channels' => $channels
        ]);
    }

    public function update(Request $request, Discussion $discussion)
    {
        $request->validate([
            'user_id' => ['required', 'string', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'channel_id' => ['required', 'string', 'exists:channels,id'],
        ]);

        $discussion->title = $request->title;
        $discussion->slug = Str::slug($request->title);
        $discussion->user_id = $request->user_id;
        $discussion->content = $request->content;
        $discussion->channel_id = $request->channel_id;

        $discussion->save();

        return redirect()->route('admin.discussions.index')->with('status', 'Discussion modifiée');
    }

    public function destroy(Discussion $discussion)
    {
        $discussion->delete();

        return redirect()->back()->with('status', 'Discussion supprimée');
    }
}
