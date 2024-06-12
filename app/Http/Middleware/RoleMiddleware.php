<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role, $permission = null): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Get the authenticated user
        $user = $request->user();
        // dd($role);
        // dd($user->can($permission));
        // Check if the user has the required role
        if (!$user->hasRole($role)) {
            abort(403, 'Unauthorized');
        }

        // Optionally check if the user has the required permission
        if ($permission !== null && !$user->can($permission)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

