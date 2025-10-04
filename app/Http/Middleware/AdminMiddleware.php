<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error','Harus login dulu');
        }
        if (Auth::user()->role !== $role) {
            abort(403, 'Tidak punya akses');
        }
        return $next($request);
    }
}
