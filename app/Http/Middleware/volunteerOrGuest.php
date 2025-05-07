<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class volunteerOrGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( (auth()->check() && auth()->user()->role === 'volunteer') || !auth()->user()) {
            return $next($request);
        }

        if (auth()->user()->role === 'organization') {
            return redirect('/organization/dashboard');
        }
        return redirect()->back();
    }
}
