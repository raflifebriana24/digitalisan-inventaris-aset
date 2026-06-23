<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = strtolower(Auth::user()->role);
        $requiredRole = strtolower($role);

        if ($userRole !== $requiredRole) {
            // Redirect if not the right role
            if ($userRole === 'admin') {
                if ($request->routeIs('dashboard')) return abort(403);
                return redirect()->route('dashboard');
            } else {
                if ($request->routeIs('operator.*')) return abort(403);
                return redirect()->route('operator.index');
            }
        }

        return $next($request);
    }
}
