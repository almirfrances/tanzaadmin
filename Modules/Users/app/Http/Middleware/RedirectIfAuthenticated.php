<?php

namespace Modules\Users\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
        /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // If the user is already logged in, redirect to the intended URL or dashboard
        if (Auth::guard('web')->check()) {
            return redirect()->intended(route('user.dashboard'));
        }

        return $next($request);
    }
}
