<?php

namespace App\Http\Controllers\Front;

use App\Models\Test;
use App\Models\Option;
use App\Models\Question;
use App\Models\Formation;
use Illuminate\Http\Request;

class OptionController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Formation $formation, Test $test, Question $question)
    {
        $options = $question->options;

        return view('front.tests.questions.options.index', [
            'formation' => $formation,
            'test' => $test,
            'question' => $question,
            'options' => $options
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Formation $formation, Test $test, Question $question)
    {
        return view('front.tests.questions.options.create', [
            'formation' => $formation,
            'test' => $test,
            'question' => $question
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Formation $formation, Test $test, Question $question)
    {
        foreach($request->options as $option)
        {
            $validation = Validator($option, [
                'option' => ['required', 'string', 'max:255']
            ]);

            if($validation->fails())
            {
                return back()->withErrors($validation)->withInput();
            }
        }

        $options = $request->only('options');

        $option_data = [];
        foreach($options as $key => $option)
        {
            array_push($option_data, $option);
        }

        $question->options()->createMany($option_data[0]);

        return redirect()->route('options.index', [$formation->slug, $test->id, $question->id])->with('status', 'Options crees');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Formation $formation, Test $test, Question $question, Option $option)
    {
        return view('front.tests.questions.options.edit', [
            'formation' => $formation,
            'test' => $test,
            'question' => $question,
            'option' => $option
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation, Test $test, Question $question, Option $option)
    {
        $request->validate([
            'option' => 'required|string|max:255',
        ]);

        $option->option = $request->option;
        $option->correct == "on" ? $request->correct == 1 : $request->correct == 0 ;
        $option->save();

        return redirect()->route('options.index', [$formation->slug, $test->id, $question->id])->with('status', 'Option' .$option->option. 'modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation, Test $test, Question $question, Option $option)
    {
        $option->delete();

        return back()->with('status', 'Option ' .$option->option. ' supprimée');
    }
}
