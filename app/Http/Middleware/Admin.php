<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role_id == 1) {
            return $next($request);
        }

        if (Auth::user()->role_id == 2) {
            return redirect()->back()->with('error', 'You can\'t go to that link, because you aren\'t logged in as admin.');
        }

        if (Auth::user()->role_id == 3) {
            return redirect()->back()->with('error', 'You can\'t go to that link, because you aren\'t logged in as admin.');
        }

        if (Auth::user()->role_id == 4) {
            return redirect()->back()->with('error', 'You can\'t go to that link, because you aren\'t logged in as admin.');
        }
    }
}
