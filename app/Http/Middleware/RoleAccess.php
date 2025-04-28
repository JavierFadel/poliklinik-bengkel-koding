<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userRoles = session()->get('status');

        if(!isset($userRoles)){
            return redirect('/')->with('error', 'Mohon Login Terlebih Dahulu');
        }

        if (session()->get('status') == 0) {
            return redirect('/')->with('error', 'User tidak aktif');
        }
        
        // Get List Roles -> Example roleowner:1,3,5 will get result [1, 3, 5]
        $roles = array_slice(func_get_args(), 2);

        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        abort(404);
    }
}
