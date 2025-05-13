<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Wadir1Middleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->guest(route('login'));
        }

        if (Auth::user()->role !== 'wadir1') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Wadir 1.');
        }

        return $next($request);
    }
}