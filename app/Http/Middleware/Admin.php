<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if(empty(Auth::user())){
            abort(403);
        }
        if(Auth::user()->id != 1) {
            Auth::logout(Auth::user());
            abort(403);
        } else{
            return $next($request);
        }
        abort(403);
    }
}
