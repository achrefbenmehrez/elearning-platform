<?php

namespace App\Http\Controllers\Front;

use App\Models\Test;
use App\Models\Chapitre;
use App\Models\Formation;
use Illuminate\Http\Request;

class TestController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Formation $formation, Chapitre $chapitre)
    {
        return view('front.tests.create', [
            'formation' => $formation,
            'chapitre' => $chapitre
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Formation $formation, Chapitre $chapitre)
    {
        $request->validate([
           'title' => 'required|string|max:255',
           'description' => 'required|string',
           'chapitre_id' => 'unique:tests'
        ]);

        Test::create([
            'title' => $request->title,
            'description' => $request->description,
            'chapitre_id' => $chapitre->id,
            'formation_id' => $formation->id
        ]);

        return redirect()->route('chapitres.index', $formation->slug)->with('status', 'Test cree');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Formation $formation, Chapitre $chapitre, Test $test)
    {
        if(!$test->published)
        {
            abort(404);
        }

        //Si l'utilisateur a achete cette formation
        $temp = [];
        foreach (auth()->user()->payements as $payement)
        {
            array_push($temp, $payement['formation_id']);
        }

        if (in_array($formation->id, $temp))
        {
            $questions = $test->questions;

            $questions->load('options');

            return view('front.tests.show', [
                'formation' => $formation,
                'chapitre' => $chapitre,
                'test' => $test,
                'questions' => $questions
            ]);
        }
        else
        {
        //Si l'utilisateur a un abonnement
            if(auth()->user()->abonnement && auth()->user()->abonnement->date_de_fin < auth()->user()->abonnement->created_at)
                return view('front.tests.show', [
                    'formation' => $formation,
                    'chapitre' => $chapitre,
                    'msg' => 'Your subscription has ended'
                ]);

                return view('front.tests.show', [
                    'formation' => $formation,
                    'chapitre' => $chapitre,
                    'msg' => 'Vous devez acheter cette formation'
                ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Formation  $formation
     * @param  Chapitre  $chapitre
     * @param  Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Formation $formation, Chapitre $chapitre,Test $test)
    {
        return view('front.tests.edit', [
            'formation' => $formation,
            'chapitre' => $chapitre,
            'test' => $test
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation, Chapitre $chapitre, Test $test)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $test->title = $request->title;
        $test->description = $request->description;
        $test->save();

        return redirect()->route('chapitres.index', $formation->slug)->with('status', 'Test' .$test->title. 'modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation, Chapitre $chapitre, Test $test)
    {
        $test->delete();

        return back()->with('status', 'Test' .$test->title. 'supprimé');
    }

    public function activation(Request $request)
    {

        $test = Test::findOrFail($request->test_id);

        $test->published = !$test->published;
        $test->save();

        return response()->json([
            'data' => [
                'success' => $test->published ? 'Test '.$test->title .' activé' : 'Test '. $test->title .' desactivé',
                'test_active' => $test->published
            ]
        ]);
    }
}
