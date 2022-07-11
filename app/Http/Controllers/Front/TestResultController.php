<?php

namespace App\Http\Controllers\Front;

use App\Models\Chapitre;
use App\Models\Formation;
use App\Models\Option;
use App\Models\Test;
use App\Models\TestResult;
use Illuminate\Http\Request;

class TestResultController extends \App\Http\Controllers\Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Formation $formation, Chapitre $chapitre, Test $test)
    {
        $reponses = $request->only('reponses')['reponses'];

        $question_number = count($test->questions);
        $attempt = 0;
        $correct = 0;
        $wrong = 0;
        foreach($reponses as $reponse)
        {
            if(array_key_exists('reponse', $reponse))
            {
                $attempt++;
                if(count(Option::where('id', $reponse['reponse'])->where('correct', 1)->get()) > 0)
                {
                    $correct++;
                }
                else
                {
                    $wrong++;
                }
            }
            else
            {
                $wrong++;
            }
        }

        $percentage = ($correct/$wrong) * 100;

        $testResult = TestResult::updateOrCreate([
            'test_id' => $test->id,
            'user_id' => auth()->user()->id
        ],
        [
            'result' => $reponses,
            'question_number' => $question_number,
            'attempt' => $attempt,
            'correct' => $correct,
            'wrong' => $wrong,
            'percentage' => $percentage
        ]);

        return redirect()->route('test_result.show', [$formation->slug, $chapitre->id, $test->id, $testResult->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function show(Formation $formation, Chapitre $chapitre, Test $test, TestResult $testResult)
    {
        if($testResult->user->id != auth()->user()->id)
        {
            return abort(404);
        }

        return view('front.testResults.show', [
            'formation' => $formation,
            'chapitre' => $chapitre,
            'testResult' => $testResult,
            'test' => $test
        ]);
    }
}
