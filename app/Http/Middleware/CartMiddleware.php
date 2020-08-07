<?php

namespace App\Http\Middleware;

use Closure;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartMiddleware
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
        if (count(Cart::where('buyer_id', Auth::user()->id)->where('purchased', 0)->get()) > 0)
            return $next($request);
        return redirect('/')->with('error', 'Hey hey hey... Add something to cart before going there!');
    }
}
