<?php

namespace App\Http\Middleware;

use App\Models\Formation;
use Closure;
use Illuminate\Http\Request;

class MaFormation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->hasRole(['admin', 'tuteur']))
        {
            $formation = $request->route('formation');
            if(gettype($formation) == 'string')
                $formation = Formation::where('slug', $formation)->get()->first();

            if(auth()->user()->id == $formation->user_id)
                return $next($request);
        }

        abort(403);
    }
}
