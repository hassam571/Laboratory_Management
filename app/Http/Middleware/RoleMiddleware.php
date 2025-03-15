<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // If the user isn't authenticated, redirect to the login route.
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // If the user's role isn't one of the allowed roles, redirect to the auth.errors.role route.
        if (! in_array($user->role, $roles)) {
            return redirect()->route('auth.errors.role');
        }

        return $next($request);
    }
}
