<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenggunaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the user is authenticated
         if (auth()->check()) {
            // Check the user's role
            if (auth()->user()->role === 'user') {
                return $next($request);
            }
        }
        // If the user is not authenticated or doesn't have the 'spradm' role, redirect to /logout
        return redirect()->to('/logout');
    }
}
