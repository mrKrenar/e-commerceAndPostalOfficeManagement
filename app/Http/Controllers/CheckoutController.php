<?php

namespace App\Http\Controllers;

use App\PostalSetting;
use App\Product;
use App\ProductImage;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\User;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::where('buyer_id', Auth::user()->id)->get();
        $products = [];
        foreach ($cart as $item) {
            array_push($products, Product::find($item->product_id));
        }

        $transfer_fee = PostalSetting::find(1)->transfer_fee;
        $total_price = $transfer_fee;
        foreach ($products as $product) {
            $total_price += $product->price;
        }
        return view('checkout/checkout')->with(compact('products', 'total_price', 'transfer_fee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    private function wipeCart()
    {
        $cart = Cart::where('buyer_id', Auth::user()->id)->get();
        foreach ($cart as $item) {
            $item->delete();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email',
                'state' => 'required',
                'city' => 'required',
                'address' => 'nullable',
                'additional_notes' => 'nullable'
            ]
        );

        $transfer_fee = PostalSetting::find(1)->transfer_fee;
        $cart = Cart::where('buyer_id', Auth::user()->id)->get();
        $products = [];
        foreach ($cart as $item) {
            array_push($products, Product::find($item->product_id));
        }
        $total_price = $transfer_fee;
        foreach ($products as $product) {
            $total_price = $total_price + $product->price;
        }
        //DELETE EVERYTHING BETWEEN THESE TWO COMMENTS (INCLUDE COMMENTS ALSO :P)
        $this->addNewOrders($cart, $products, $request, $transfer_fee);
        $this->wipeCart();
        return redirect(route('thankyou'));
        //DELETE EVERYTHING BETWEEN THESE TWO COMMENTS (INCLUDE COMMENTS ALSO :P)

        try {
            $stripe = Stripe::make('sk_test_51H0mlKK5oDGBuQ7Kkgj6KVsIowcTCS99NPDtO00r3Y011Xa2GShmBkotvPkXDKVW4H7yjpAIo0rFnDeGflrDulHr00ukWffyBZ');
            $change = $stripe->charges()->create([
                'amount' => $total_price,
                'currency' => 'EUR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metatadata' => [],
            ]);
            $this->addNewOrders($cart, $products, $request, $transfer_fee);
            $this->wipeCart();
            return redirect(route('thankyou'));
        } catch (CardErrorException $e) {
            //return view('checkout/checkout')->withErrors(compact('products','total_price','transfer_fee'));
        }
    }

    public function addNewOrders($cart, $products, $request, $transfer_fee)
    {
        $user = Auth::user();

        for ($i = 0; $i < count($cart); $i++) {
            // dd($cart[$i]->amount * $products[$i]->price + PostalSetting::find(1)->transfer_fee);
            Order::create(
                [
                    'receiver_name' => $user->name . ' ' . $user->last_name,
                    'receiver_tel' => $user->tel,
                    'receiver_tel2' => $user->tel2,
                    'state' => $user->state,
                    'city' => $user->city,
                    'address' => $request['address'],
                    'quantity' => $cart[$i]->amount,
                    'weight' => $products[$i]->weight,
                    'order_type' => $products[$i]->product_type,
                    'is_openable' => $products[$i]->is_openable,
                    'is_returnable' => $products[$i]->is_returnable,
                    'additional_notes' => $request['additional_notes'],
                    'order_name' => $products[$i]->name,
                    'description' => $products[$i]->description,
                    'price' => $products[$i]->price,
                    'total_price' => $cart[$i]->amount * $products[$i]->price + $transfer_fee,
                    'status' => 'Processing',
                    'seller_id' => $products[$i]->seller_id
                ]
            );
        }
    }

    public function thankyou()
    {
        return view('checkout/thankyou');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //        $products = Product::where('id', $id)->get();
        //        //dd($product);
        //        $total_price = 2;
        //        foreach ($products as $product){
        //            $total_price = $total_price + $product->price;
        //        }
        //        return view('checkout/checkout')->with(compact('products','total_price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
