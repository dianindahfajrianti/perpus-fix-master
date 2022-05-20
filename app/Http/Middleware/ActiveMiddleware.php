<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class ActiveMiddleware
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
        if (!Auth::check()) {
            return redirect('/');
        }
        $user = new User;
        $stat = $user->where('log_status','=',1)->get();
        $statCount = $stat->count();
        if ($statCount > 20) {
            return redirect('/logout');
        }
        return $next($request);
        
    }
}
