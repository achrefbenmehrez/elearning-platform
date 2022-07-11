<?php

namespace App\Http\Controllers\Back;

use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ChaineController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $chaines = Channel::paginate(10);

        return view('back.chaines.index', [
            'chaines' => $chaines
        ]);
    }

    public function create()
    {
        return view('back.chaines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255'
        ]);

        Channel::create([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name)
        ]);

        return redirect()->route('admin.channels.index')->with('status', 'Chaine cree');
    }

    public function show(Channel $channel)
    {
        return view('back.chaines.show', [
            'chaine' => $channel
        ]);
    }

    public function edit(Channel $channel)
    {
        return view('back.chaines.edit', [
            'chaine' => $channel
        ]);
    }

    public function update(Request $request, Channel $channel)
    {
        $channel->name = $request->name;
        $channel->save();

        return redirect()->route('admin.channels.index')->with('status', 'Chaine modifiée');
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();

        return redirect()->back()->with('status', 'Chaine supprimee');
    }
}
