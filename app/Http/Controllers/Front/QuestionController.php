<?php

namespace App\Http\Controllers\Front;

use App\Models\Test;
use App\Models\Chapitre;
use App\Models\Formation;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Formation $formation, Chapitre $chapitre, Test $test)
    {
        $questions = $test->questions;
        return view('front.tests.questions.index', [
            'formation' => $formation,
            'chapitre' => $chapitre,
            'test' => $test,
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Formation $formation, Chapitre $chapitre, Test $test)
    {
        return view('front.tests.questions.create', [
            'formation' => $formation,
            'chapitre' => $chapitre,
            'test' => $test
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Formation $formation, Chapitre $chapitre, Test $test)
    {
        foreach($request->questions as $question)
        {
            $validation = Validator($question, [
                'question' => ['required', 'string', 'max:255'],
                'score' => ['integer']
            ]);

            if($validation->fails())
            {
                return back()->withErrors($validation)->withInput();
            }
        }

        $questions = $request->only('questions');

        $question_data = [];
        foreach($questions as $key => $question)
        {
            foreach($question as $keyy => $temp)
            {
                if($request->file('questions'))
                {
                    if(isset($request->file('questions')[$keyy]))
                        $question[$keyy]['question_image'] = $request->file('questions')[$keyy]['question_image']->storeAs('img/imagesQuestions', $request->file('questions')[$keyy]['question_image']->getClientOriginalName());
                }
            }

            array_push($question_data, $question);
        }

        $test->questions()->createMany($question_data[0]);

        return redirect()->route('questions.index', [$formation->slug, $chapitre->id, $test->id])->with('status', 'Question cree');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Formation $formation, Chapitre $chapitre, Test $test, Question $question)
    {
        return view('front.tests.questions.edit', [
            'formation' => $formation,
            'question' => $question,
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
    public function update(Request $request, Formation $formation, Chapitre $chapitre, Test $test, Question $question)
    {
        if($request->hasFile('question_image'))
        {
            $question_image = $request->file('question_image')->storeAs('img/imagesQuestions', $request->file('question_image')->getClientOriginalName());
            $question->question_image = $question_image;
        }

        $question->question = $request->question;
        $question->score = $request->score;
        $question->save();

        return redirect()->route('questions.index', [$formation->slug, $chapitre->id,$test->id])->with('status', 'Question modifiée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation, Chapitre $chapitre, Test $test, Question $question)
    {
        $question->delete();

        return back()->with('status', 'Question '. $question->question .' supprimée');
    }
}
