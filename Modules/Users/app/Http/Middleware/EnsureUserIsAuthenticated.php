<?php

namespace Modules\Users\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAuthenticated
{
       /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('web')->user();

        // If the user is not logged in, redirect to login
        if (!$user) {
            return redirect()->route('login')->with('status', 'Please log in to access this page.');
        }

        // If the user is inactive, logout and redirect to login
        if ($user->status !== 'active') {
            Auth::guard('web')->logout();
            return redirect()->route('login')->withErrors(['login' => 'Your account is inactive. Please contact support.']);
        }

        return $next($request);
    }
}
