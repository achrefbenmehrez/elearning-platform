<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use FFMpeg\FFProbe;

use App\Models\Test;
use App\Models\Episode;
use App\Models\Chapitre;
use App\Models\Question;
use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Events\FinAbonnement;

class EpisodeController extends \App\Http\Controllers\Controller
{
    public function index(Formation $formation, Chapitre $chapitre)
    {
        $episodes = Episode::where('chapitre_id', $chapitre->id)->paginate(4);
        $categories = Categorie::paginate(15);

        return view('front.formations.chapitres.episodes.index', [
            'episodes' => $episodes,
            'formation' => $formation,
            'chapitre' => $chapitre,
            'categories' => $categories
        ]);
    }

    public function show(Formation $formation, Episode $episode)
    {
        if ($episode->numero !== 1) {
            if (!auth()->check()) {
                return redirect('/login');
            } else {
                $formation->load('chapitres.tests');

                //Si l'utilisateur a achete cette formation
                $temp = [];
                $payements = auth()->user()->payements;
                foreach ($payements as $payement) {

                    array_push($temp, $payement['formation_id']);
                }

                if (in_array($formation->id, $temp)) {
                    $ffprobe = FFProbe::create();

                    $duration = $ffprobe
                        ->streams(asset('storage/' . $episode->video_url))
                        ->videos()
                        ->first()
                        ->get('duration');

                    if ($duration > 0) {
                        $mins = floor($duration / 60);
                        $secs = $duration % 60;
                        $duration = $mins . ":" . $secs;
                    }

                    return view('front.formations.chapitres.episodes.show', [
                        'formation' => $formation,
                        'episode' => $episode,
                        'duration' => $duration
                    ]);
                } else {
                    //Si l'utilisateur a un abonnement
                    if (auth()->user()->abonnement && auth()->user()->abonnement->date_de_fin <= Carbon::now())
                        return view('front.formations.chapitres.episodes.show', [
                            'formation' => $formation,
                            'msg' => 'Votre abonnement est expiré'
                        ]);

                    return view('front.formations.chapitres.episodes.show', [
                        'formation' => $formation,
                        'msg' => 'Vous devez acheter cette formation'
                    ]);
                }
            }
        }

        $ffprobe = FFProbe::create();

        $duration = $ffprobe
            ->streams(asset('storage/' . $episode->video_url))
            ->videos()
            ->first()
            ->get('duration');

        if ($duration > 0) {
            $mins = floor($duration / 60);
            $secs = $duration % 60;
            $duration = $mins . ":" . $secs;
        }

        return view('front.formations.chapitres.episodes.show', [
            'formation' => $formation,
            'episode' => $episode,
            'duration' => $duration
        ]);
    }

    public function create(Request $request, Formation $formation)
    {
        return view('front.formations.chapitres.episodes.create', [
            'formation' => $formation
        ]);
    }

    public function store(Request $request, Formation $formation, Test $test, Question $question)
    {
        foreach ($request->episodes as $episode) {
            $validation = Validator($episode, [
                'nom' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'numero' => ['required', 'numeric'],
                'chapitre_id' => 'required|numeric|exists:chapitres,id',
                'video' => 'required',
            ]);

            if ($validation->fails()) {
                return response()->json(['error' => $validation->errors()->all()]);
            }
        }

        $episodes = $request->only('episodes');

        $episode_data = [];
        foreach ($episodes as $key => $episode) {
            foreach ($episode as $keyy => $temp) {
                $episode[$keyy]['video_url'] = $request->file('episodes')[$keyy]['video']->storeAs('mp4', $request->file('episodes')[$keyy]['video']->getClientOriginalName());
            }

            array_push($episode_data, $episode);
        }

        $formation->episodes()->createMany($episode_data[0]);

        return response()->json(['slug' => $formation->slug]);
    }

    public function edit(Formation $formation, Chapitre $chapitre, Episode $episode)
    {
        return view('front.formations.chapitres.episodes.edit', [
            'formation' => $formation,
            'chapitre' => $chapitre,
            'episode' => $episode
        ]);
    }

    public function update(Request $request, Formation $formation, Chapitre $chapitre, Episode $episode, Question $question)
    {
        if ($request->hasFile('video')) {
            $request->validate([
                'video' => 'required'
            ]);

            $video_url = $request->file('video')->storeAs('mp4', $request->file('video')->getClientOriginalName());
            $episode->video_url = $video_url;
        }

        $episode->nom = $request->nom;
        $episode->description = $request->description;
        $episode->numero = $request->numero;
        $episode->chapitre_id = $request->chapitre_id;

        $episode->save();

        return redirect()->route('episodes.index', [$formation->slug, $chapitre->id])->with('status', 'Episode modifiée');
    }

    public function destroy(Formation $formation, Chapitre $chapitre, Episode $episode, Question $question)
    {
        $episode->delete();

        return redirect()->route('episodes.index', [$formation->slug, $chapitre->id])->with('status', 'Episode supprimée');
    }
}
