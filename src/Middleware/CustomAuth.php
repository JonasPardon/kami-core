<?php

namespace JonasPardon\KamiCore\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuth
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
        // This is hacky, but for some reason the normal auth middleware
        // is just not working, this fixes that.

        if (!Auth::check()) return redirect()->route('login');
        return $next($request);
    }
}
