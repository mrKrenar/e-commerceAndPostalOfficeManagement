<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Buyer
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
            return redirect()->route('admin')->with('error', 'You can\'t go to that link, because you aren\'t logged in as buyer.');
        }

        if (Auth::user()->role_id == 2) {
            return redirect()->route('postalworker')->with('error', 'You can\'t go to that link, because you aren\'t logged in as buyer.');
        }

        if (Auth::user()->role_id == 3) {
            return redirect()->route('seller')->with('error', 'You can\'t go to that link, because you aren\'t logged in as buyer.');
        }

        if (Auth::user()->role_id == 4) {
            return $next($request);
        }
    }
}
