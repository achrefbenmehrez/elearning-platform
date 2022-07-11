<?php

namespace App\Http\Controllers\Front;

use App\Models\Episode;
use App\Helpers\VideoStream;
use App\Models\Formation;
use Illuminate\Support\Facades\Storage;

class StreamController extends \App\Http\Controllers\Controller
{
    public function create(Formation $formation, Episode $episode)
    {
        if ($episode->numero !== 1) {
            if (!auth()->check()) {
                abort(404);
            } else {
                //Si l'utilisateur a achete cette formation
                $temp = [];
                $payements = auth()->user()->payements;
                foreach ($payements as $payement) {

                    array_push($temp, $payement['formation_id']);
                }

                if (in_array($formation->id, $temp)) {
                    $stream = new VideoStream(Storage::path($episode->video_url));
                    $stream->start();
                } else {
                    abort(404);
                }
            }
            $stream = new VideoStream(Storage::path($episode->video_url));
            $stream->start();
        }
        $stream = new VideoStream(Storage::path($episode->video_url));
        $stream->start();
    }
}
