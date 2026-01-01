<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip tracking for admin routes, assets, or non-GET requests
        if ($request->is('admin*') || !$request->isMethod('GET')) {
            return $next($request);
        }

        // Skip if visitor is a known bot (basic check)
        $userAgent = $request->header('User-Agent');
        if (preg_match('/(bot|crawl|slurp|spider|mediapartners)/i', $userAgent)) {
            return $next($request);
        }

        try {
            Visitor::firstOrCreate([
                'ip_address' => $request->ip(),
                'visit_date' => now()->toDateString(),
            ], [
                'user_agent' => substr($userAgent, 0, 255),
            ]);
        } catch (\Exception $e) {
            // Silently fail to not disrupt user experience
        }

        return $next($request);
    }
}
