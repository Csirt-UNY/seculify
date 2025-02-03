<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && Auth::user()->role == 'user') {
                return to_route('user');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role == 'admin') {
                return to_route('admin');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role == 'creator') {
                return to_route('creator');
            }
        }

        return $next($request);
    }
}
