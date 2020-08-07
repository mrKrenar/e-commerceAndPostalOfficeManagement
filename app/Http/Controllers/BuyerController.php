<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Cart;
use App\ProductImage;
use Illuminate\Support\Facades\Auth;
use App\User;

class BuyerController extends Controller
{

    public function loadCart()
    {
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
                //dd($image);
                array_push($productsImage, $image);
            } catch (\Throwable $th) {
                array_push($productsImage, 'no_image.jpg');
            }
        }

        // dd($products);

        return view('buyer.cart')->with('cart', $cart)
            ->with('products', $products)
            ->with('productsImage', $productsImage)
            ->with('totalPrice', $totalPrice);
    }

    public function updateCart(Cart $cartId, Request $request)
    {
        $cartId->amount = $request['amount'];
        $cartId->update();
        return redirect()->back()->with('success', 'Cart updated successfuly');
    }

    public function addToCart(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'quantity' => 'nullable|numeric'
            ]
        );

        //If user adds product from welcome page (possible solution)
        if ($request->quantity == null) {
            $request->quantity = 1;
        }
        if (count(Cart::where('product_id', $id)
            ->where('buyer_id', Auth::user()->id)
            ->where('purchased', false)
            ->get()) > 0) {
            return redirect()->back()->with('error', 'Product already added to cart');
        } else {
            Cart::create([
                'buyer_id' => Auth::user()->id,
                'product_id' => $id,
                'amount' => $request->quantity
            ]);
            return redirect()->back()->with('success', 'Product added to cart');
        }
    }

    function purchaseHistory(User $buyer)
    {
        $carts = Cart::where('buyer_id', $buyer->id)->paginate(5);
        $products = [];
        foreach ($carts as $item) {
            array_push($products, Product::find($item->product_id));
        }
        return view('buyer.purchase_history')
            ->with('buyer', $buyer)
            ->with('carts', $carts)
            ->with('products', $products);
    }
}
