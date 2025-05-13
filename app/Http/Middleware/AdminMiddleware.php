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
        // Kalau belum login, redirect ke login
        if (!Auth::check()) {
            return redirect()->guest(route('login'));
        }

        // Kalau login tapi bukan admin, kembalikan forbidden
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses sebagai admin.');
        }

        return $next($request);
    }
}