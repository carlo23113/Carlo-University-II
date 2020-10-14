<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checking
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
        $user = $request->session()->get('user');
        $url = $request->fullUrl();
        $baseurl = url('/');

        
        if($request->session()->has('user'))
        {

            if ($url == $baseurl."/login") {
                
                return redirect("/");
            }
        }

        return $next($request);
    }
}