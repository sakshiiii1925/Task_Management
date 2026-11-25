<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check whether the user is logged in
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check whether the user's role matches
        if (Auth::user()->role !== $role) {
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
