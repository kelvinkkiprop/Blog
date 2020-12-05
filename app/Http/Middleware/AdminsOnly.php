<?php

namespace App\Http\Middleware;

use Closure;

//Add
use Illuminate\Support\Facades\Auth;

class AdminsOnly
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
        if(Auth::user()->type == 1){//Admins
            return $next($request);
        }
        return redirect()->back();
    }
}
