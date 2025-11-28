<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
{
    $user = Auth::user(); // atau $request->user()
    if (!$user) {
        return redirect()->route('login');
    }
    if (!$user->is_admin) {
        abort(403, 'Akses ditolak (admin only).');
    }
    return $next($request);
}
}
