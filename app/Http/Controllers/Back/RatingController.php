<?php

namespace App\Http\Controllers\Back;

use App\Models\Rating;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = Rating::paginate(10);

        return view('back.ratings.index', compact('ratings'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rating = Rating::findOrFail($id);

        return view('back.ratings.show',compact('rating'));
    }
}
