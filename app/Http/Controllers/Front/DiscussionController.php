<?php

namespace App\Http\Controllers\Front;

use App\Models\Channel;
use App\Models\Categorie;
use App\Models\Formation;
use App\Models\Discussion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DiscussionController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'store',
            'create'
        ]);
    }

    public function index()
    {
        $discussions = Discussion::filterByChannels()->with('replies', 'channel')->paginate(8);
        $channels = Channel::paginate(12);

        $nouveautes = Formation::latest()->with(['user', 'categories'])->paginate(4);

        $categories = Categorie::take(8)->get();

        return view('front.discussions.index', [
            'discussions' => $discussions,
            'channels' => $channels,
            'categories' => $categories,
            'nouveautes' => $nouveautes
        ]);
    }

    public function show(Discussion $discussion)
    {
        $discussion->load(['author', 'bestReply', 'channel']);
        $replies = $discussion->replies()->with('owner')->paginate(3);
        $channels = Channel::all();

        $nouveautes = Formation::latest()->with(['user', 'categories'])->paginate(4);

        $categories = Categorie::take(8)->get();

        return view('front.discussions.show', [
            'discussion' => $discussion,
            'replies' => $replies,
            'channels' => $channels,
            'categories' => $categories,
            'nouveautes' => $nouveautes
        ]);
    }

    public function create()
    {
        $channels = Channel::all();

        return view('front.discussions.create', [
            'channels' => $channels
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => 'required', 'string',
            'channel_id' => 'required', 'exists:channels,id',
            'photo' => 'required', 'image'
        ]);


        $discussion = auth()->user()->discussions()->create([
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel_id,
            'slug' => Str::slug($request->title),
            'photo_url' => $request->file('photo')->storeAs('img/ImagesDiscussions', $request->file('photo')->getClientOriginalName()),
        ]);

        return redirect()->route('discussions.show', $discussion->slug)->with('status', 'Discussion cree');
    }
}
