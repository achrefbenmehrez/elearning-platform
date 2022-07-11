<?php

namespace App\Http\Controllers\Front;

use App\Models\Formation;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends \App\Http\Controllers\Controller
{
    public function store(Request $request, Formation $formation)
    {
        if(!auth()->user())
            return response()->json(['error' => 'Vous devez etre connecter pour evaluer cette formation']);

        request()->validate(['rate' => 'required']);
        $user_rating = DB::table('ratings')->where('user_id', auth()->user()->id)->where('formation_id', $formation->id)->get();
        if(count($user_rating) > 0)
        {
            return response()->json(['error' => 'Vous avez deja evalue cette formation']);
        }
        else
        {
            Rating::create([
                'user_id' => auth()->user()->id,
                'formation_id' => $formation->id,
                'value' => $request->rate
            ]);
            return response()->json(['msg' => 'Merci pour votre evaluation']);
        }
    }
}
