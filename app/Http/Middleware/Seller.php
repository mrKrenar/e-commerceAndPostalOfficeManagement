<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Seller
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
            return redirect()->route('admin')->with('error', 'You can\'t go to that link, because you aren\'t logged in as seller.');
        }

        if (Auth::user()->role_id == 2) {
            return redirect()->route('postalworker')->with('error', 'You can\'t go to that link, because you aren\'t logged in as seller.');
        }

        if (Auth::user()->role_id == 3) {
            if (!Auth::user()->isActive) {
                Auth::logout();
                return redirect('/login')->with('error', 'Account disabled. Contact support for more info.');
            }

            return $next($request);
        }

        if (Auth::user()->role_id == 4) {
            return redirect()->route('buyer')->with('error', 'You can\'t go to that link, because you aren\'t logged in as seller.');
        }
    }
}
