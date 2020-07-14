<?php

namespace App\Providers;

use App\Cart;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     *
     Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            // Using Closure based composers...
            View::composer('layouts/app', function ($view) {

                if (Auth::check()) {
                $cart = Cart::where('buyer_id', Auth::user()->id)->get();
                $products = [];
                foreach ($cart as $item) {
                    array_push($products, Product::find($item->product_id));
                }
                $cartItems = count($products);
                $view->with('cartItems', $cartItems );
                }
            });

    }
}
