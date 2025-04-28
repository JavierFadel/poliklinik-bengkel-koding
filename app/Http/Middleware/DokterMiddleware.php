<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DokterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Assuming user status is stored as a column in the "users" table
        $user = Auth::user();

        // Check if user is authenticated and their status is 1 or 2
        if ($user && $user->status == 2) {
            return $next($request);
        }

        // If the user doesn't meet the criteria, redirect or abort
        abort(403, "Access denied! {$user}");
        // return $re
        // return redirect()->route('home')->with('error', 'Access denied!');
    }
}
