<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Request;
class checkrequest
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
        if(Request::ajax()){
            return $next($request);
        }
        else
        { 
            return abort(404);
        }
    }
}