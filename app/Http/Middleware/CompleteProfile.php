<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompleteProfile
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!isset(Auth::user()->agency) || !isset(Auth::user()->sub_unit)){
            return to_route('user.profile')->with('error', 'Silakan lengkapi profil Anda terlebih dahulu untuk melanjutkan!')->with('time', 'first');
        } else {
            return $next($request);
        }
    }
}
