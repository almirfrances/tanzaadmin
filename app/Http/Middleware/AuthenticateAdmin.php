<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {


                        // Check if the admin is authenticated
        if (!Auth::guard($guard)->check()) {
            // Store the current URL in session before redirecting to login
            if (!$request->expectsJson()) {
                session()->put('url.intended', $request->fullUrl());
            }

            return redirect()->route('admin.login');
        }

        // Check admin's status
        $admin = Auth::guard($guard)->user();
        if ($admin->status !== 'active') {
            Auth::guard($guard)->logout();

            return redirect()->route('admin.login')->withErrors([
                'login' => 'Your account is inactive. Please contact support.',
            ]);
        }

        return $next($request);
    }
}
