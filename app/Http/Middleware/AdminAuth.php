<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->hasRole(['superadmin', 'admin', 'moderator', 'customersupport', 'financemanager', 'manager', 'staff'])) {
            return $next($request);
        }

        // Redirect to the login route with an error message
        return redirect()->route('dashboard.login')->with('error', 'You must be logged in as an admin to access this page.');
    }
}
