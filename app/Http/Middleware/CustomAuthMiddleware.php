<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // echo '<h1>custome auth middleware</h1>';
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You are not allowed to access.']);
        }
        // $user = $request->user();
        //  // Optionally check if the user has the required permission
        //  if ($permission !== null && !$user->can($permission)) {
        //     abort(403, 'Unauthorized');
        // }
        return $next($request);
        
    }
}
