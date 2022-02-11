<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        App::setLocale('id');
        if (Auth::user()->role <= 2) {
            return $next($request)->header('Access-Control-Allow-Origin', '*');
        }else {
            return redirect('/');
        }
    }
}
