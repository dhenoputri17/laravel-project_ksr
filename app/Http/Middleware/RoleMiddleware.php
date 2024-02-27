<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (auth()->check() && in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }
        Log::error("Middleware CheckRole: Akses Ditolak");


        if (auth()->check() && auth()->user()->role === 'pelanggan') {
            return redirect('/')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        else if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        else if (auth()->check() && auth()->user()->role === 'kasir') {
            return redirect('/kasir')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }


        return redirect()->route('login');
    }
}
