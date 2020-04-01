<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Active
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
            return redirect('/login');
        }
        if(Auth::user()->account_status == 0) {
            Auth::logout();
            return redirect('/login');
        } else{
            return $next($request);
        }
    }
}
