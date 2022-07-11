<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Models\Chapitre;
use App\Models\Formation;

class ChapitreController extends \App\Http\Controllers\Controller
{
    public function index(Formation $formation)
    {
        $chapitres = $formation->chapitres()->paginate(8);

        return view('front.formations.chapitres.index', [
            'formation' => $formation,
            'chapitres' => $chapitres
        ]);
    }

    public function create(Formation $formation)
    {
        return view('front.formations.chapitres.create', [
            'formation' => $formation
        ]);
    }

    public function store(Request $request, Formation $formation)
    {
        foreach($request->chapitres as $chapitre)
        {
            $validation = Validator($chapitre, [
                'nom' => ['required', 'string', 'max:255'],
            ]);

            if($validation->fails())
            {
                return response()->json(['error'=>$validation->errors()->all()]);
            }
        }

        $chapitres = $request->only('chapitres');

        $chapitre_data = [];
        foreach($chapitres as $key => $chapitre)
        {
            array_push($chapitre_data, $chapitre);
        }

        $formation->chapitres()->createMany($chapitre_data[0]);

        return response()->json(['slug'=>$formation->slug]);
    }

    public function edit(Formation $formation, Chapitre $chapitre)
    {
        return view('front.formations.chapitres.edit', [
            'chapitre' => $chapitre,
            'formation' => $formation
        ]);
    }

    public function update(Request $request, Formation $formation, Chapitre $chapitre)
    {
        $chapitre->nom = $request->nom;
        $chapitre->save();

        return redirect()->route('chapitres.index', $formation->slug)->with('status', 'chapitre modifié');
    }

    public function destroy(Formation $formation, Chapitre $chapitre)
    {
        $chapitre->delete();

        return redirect()->back()->with('status', 'chapitre supprimé');
    }
}
