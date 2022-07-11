<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $lang The language key to use in setting the app locale, e.g 'en', 'fr'
     * @return mixed
     */
    public function handle($request, Closure $next) {
        app()->setLocale($request->segment(1));
        return $next($request);
    }
}
