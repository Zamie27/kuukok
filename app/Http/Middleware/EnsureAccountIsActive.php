<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && !auth()->user()->is_active) {
            // Allow access to OTP verification routes
            if ($request->routeIs('otp.*') || $request->routeIs('logout')) {
                return $next($request);
            }

            return redirect()->route('otp.view');
        }

        return $next($request);
    }
}
