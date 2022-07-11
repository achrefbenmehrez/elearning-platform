<?php

namespace App\Http\Controllers\Front;

use App\Models\Video;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends \App\Http\Controllers\Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Episode $episode)
    {
        $request->validate([
            'time' => 'required'
        ]);

        $user = Auth::user();
        if($user === null){
            return response()->json(['message' => 'User not authenticated', 403]);
        }
        $user_id = $user->id;
        $currentTime = $request->time;

        //save them somewhere
        Video::updateOrCreate(
            [
                'user_id' => $user_id,
                'episode_id' => $episode->id,
            ],
            [
                'currentTime' => $currentTime
            ]
        );

        return response()->json(['message' => 'Time saved', 200]);//send http response as json back to the ajax call
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        $user = Auth::user();
        if($user === null){
            return response()->json(['message' => 'User not authenticated', 403]);
        }
        //get the time from saved time where you saved it with this data
        $playbackTime = Video::where('episode_id',$episode->id)->where('user_id',$user->id)->first();//use this one if you update the time instead of inserting a new row each time a time is saved.

        if($playbackTime === null){
            //there's no saved time
            $playbackTime = 0;
        }else{
            $playbackTime = $playbackTime->currentTime;//use what column you saved the time in.
        }
        return response()->json(['playbackTime' => $playbackTime, 200]);
    }
}
