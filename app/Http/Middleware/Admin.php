<?php

namespace App\Http\Middleware;

use App\User;
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
            return redirect('/admin/login');
        }
        if(Auth::user()->id != User::ADMIN_ID) {
            Auth::logout(Auth::user());
            abort(403);
        } else{
            return $next($request);
        }
        abort(403);
    }
}
