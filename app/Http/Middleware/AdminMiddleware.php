<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use stdClass;
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
        if (!Auth::check()) {
            $res = new stdClass;
            $res->status = 'error';
            $res->title = 'Anda belum login';
            $res->message = 'Silahkan login untuk mengakses menu admin';
            
            return redirect('/')->with($res->status,json_encode($res));
        }
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
        ];

        App::setLocale('id');
        if (Auth::user()->role <= 2) {
            $response = $next($request);
                foreach($headers as $key => $value) {
                    $response->headers->set($key, $value);
                }
            return $response;
        }else {
            return redirect('/');
        }
    }
}
