<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->guest(route('login'));
        }

        if (Auth::user()->role !== 'tim') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Tim.');
        }

        return $next($request);
    }
}