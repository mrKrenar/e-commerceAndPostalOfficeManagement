<?php

namespace App\Providers;

use App\Cart;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\ProductImage;
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
                $cartItems = Cart::where('buyer_id', Auth::user()->id)
                    ->where('purchased', false)
                    ->get();
                
                    $cart = Cart::where('buyer_id', Auth::user()->id)
                    ->where('purchased', false)
                    ->get();
                $products = [];
                $productsImage = [];
                $totalPrice = 0;
                foreach ($cart as $item) {
                    $product = Product::find($item->product_id);
                    array_push($products, $product);
                    $totalPrice += $product->price * $item->amount;
                    try {
                        $image = ProductImage::where('product_id', $item->product_id)->get();
                        // dd($image);
                        array_push($productsImage, $image);
                    } catch (\Throwable $th) {
                        array_push($productsImage, 'no_image.jpg');
                    }                   
                    
                }  
                // dd($productsImage[0][0]->path);
                $view->with('cartItems', count($cartItems))
                    ->with('cart', $cart)    
                    ->with('products', $products)
                    ->with('productsImage', $productsImage)
                    ->with('totalPrice', $totalPrice);;
            }
        });
    }
}
