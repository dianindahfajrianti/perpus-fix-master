<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use stdClass;
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
            $res = new stdClass;
            $res->status = 'error';
            $res->title = 'Anda belum login';
            $res->message = 'Silahkan login untuk melihat isi';
            
            return redirect('/')->with($res->status,json_encode($res));
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
