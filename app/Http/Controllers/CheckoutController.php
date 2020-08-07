<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
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
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::where('buyer_id', Auth::user()->id)
            ->where('purchased', false)
            ->get();
        $products = [];
        $total_price = 0;
        $total_price_no_tvsh = 0;
        $transfer_fee = PostalSetting::find(1)->transfer_fee;

        foreach ($cart as $item) {
            $product = Product::find($item->product_id);
            array_push($products, $product);
            $total_price += number_format($product->price * $item->amount, 2, '.', '');
            $total_price_no_tvsh += number_format($product->price * $item->amount * (1 - ($product->tvsh / 100)), 2, '.', '');
        }
        $user = Auth::user();
        return view('checkout/checkout')->with(compact('cart', 'products', 'total_price', 'total_price_no_tvsh', 'transfer_fee','user'));
    }

    private function markCartPaid()
    {
        $cart = Cart::where('buyer_id', Auth::user()->id)
            ->where('purchased', false)
            ->get();
        foreach ($cart as $item) {
            $item->purchased = true;
            $item->update();
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
        $cart = Cart::where('buyer_id', Auth::user()->id)
            ->where('purchased', false)
            ->get();
        $products = [];
        foreach ($cart as $item) {
            array_push($products, Product::find($item->product_id));
        }
        $total_price = $transfer_fee;
        foreach ($products as $product) {
            $total_price = $total_price + $product->price;
        }
        //DELETE EVERYTHING BETWEEN THESE TWO COMMENTS (INCLUDE COMMENTS ALSO :P)
        // $this->addNewOrders($cart, $products, $request, $transfer_fee);
        // $this->markCartPaid();
        // return redirect(route('thankyou'));
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
            $this->markCartPaid();
            $this->changeProductStatus($cart);
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
            $order = Order::create(
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

            $subject = 'Your order has been successfully registered';
            Mail::send(new OrderConfirmationMail($request->email, $subject, $order));
        }
    }


    public function changeProductStatus($cart)
    {
        foreach ($cart as $item) {
            $product = Product::find($item->product_id);
            $product->decrement('quantity', $item->amount);
            if ($product->quantity == 0) {
                $product->status = false;
                $product->save();
            }
        }
    }

    public function thankyou()
    {
        return view('checkout/thankyou');
    }
}
