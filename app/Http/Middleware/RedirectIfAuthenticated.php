<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::guard('web')->check()) {
                if (auth()->user()->hasRole(['ROLE_COMPANY'])) {
                    return redirect()->route('company.dashboard');
                }
                if (auth()->user()->hasRole(['ROLE_CANDIDATE'])) {
                    return redirect()->route('candidate.dashboard');
                }
            }
            if (Auth::guard('admin')->check()) {
                if (auth()->user()->hasRole(['ROLE_SUPERADMIN'])) {
                    return redirect()->route('admin.dashboard');
                }
            }
        }

        return $next($request);
    }
}
