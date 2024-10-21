<?php

namespace App\Http\Middleware;

use Closure;

class FrameOptions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Check if the current request is for a specific endpoint
        if ($request->is('forms/*')) {
            // Allow iframing for this endpoint from any domain
            $response->headers->set('Content-Security-Policy', "frame-ancestors *;");
        } else {
            // Prevent all other endpoints from being iframed
            $response->headers->set('Content-Security-Policy', "frame-ancestors 'none';");
        }

        return $response;
    }
}
