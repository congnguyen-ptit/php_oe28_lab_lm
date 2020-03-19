<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Enums\UserRole;

class Administrator
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
        if (Auth::check() && Auth::user()->role_id == UserRole::Administrator) {
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
