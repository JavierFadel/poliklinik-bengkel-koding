<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {        
        $userRoles = session()->get('idRole');

        if(!isset($userRoles)){
            // return redirect('/')->with('error', 'Mohon Login Terlebih Dahulu');
            abort(404);
        }

        // Checking session status was active will be redirected to the dashboard
        if (session()->get('status') == 0) {
            // return redirect('/')->with('error', 'User tidak aktif');
            abort(404);
        }

        return $next($request);
    }
}
