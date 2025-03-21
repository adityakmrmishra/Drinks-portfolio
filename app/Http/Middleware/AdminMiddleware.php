<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Debug output - check user's admin status
        info('AdminMiddleware: User ID = ' . Auth::id() . ', Is Admin = ' . (Auth::user()->is_admin ? 'true' : 'false'));
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'You need admin permissions to access this page.');
        }
        
        return $next($request);
    }
}
