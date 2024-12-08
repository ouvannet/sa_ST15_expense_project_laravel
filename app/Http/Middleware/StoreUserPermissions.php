<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StoreUserPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user());
        if (Auth::check()) {
            // Fetch user permissions from the database
            $user = Auth::user();
            $permissions = $user->permissions->pluck('name')->toArray(); // Assuming 'permissions' is a relationship
            // Store the permissions in the session
            dd($permissions);
            Session::put('user_permissions', $permissions);
        }
        return $next($request);
    }
}
