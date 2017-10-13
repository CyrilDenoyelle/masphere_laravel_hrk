<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsPro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::User()->roles->implode('slug') !== 'proguard' && Auth::User()->roles->implode('slug') !== 'procult') {
            return redirect('/home');
        }

        return $next($request);
    }
}