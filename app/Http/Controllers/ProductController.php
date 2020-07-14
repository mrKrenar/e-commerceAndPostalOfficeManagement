<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Order;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        //$product_images = ProductImage::get();
        $product_images = ProductImage::select('id', 'path', 'product_id')->groupBy('product_id')->paginate(6);
        return view('welcome', compact('products', 'product_images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|max:255',
                'images' => 'nullable|array|max:5',
                'images.*' => 'image|max:2000',
                'description' => 'nullable|max:255',
                'price' => 'required|numeric|gte:0',
                'weight' => 'nullable|numeric|min:0',
                'product_type' => 'required|max:255'
            ]
        );

        $product = new Product();

        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->weight = $request->get('weight');
        $product->product_type = $request->get('product_type');
        $product->seller_id = Auth::user()->id;
        $product->is_openable = $request->has('is_openable');
        $product->is_returnable = $request->has('is_returnable');

        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {

                $image_name_with_ext = $image->getClientOriginalName();
                $image_name = pathinfo($image_name_with_ext, PATHINFO_FILENAME);
                $extension = $image->extension();
                $full_image_name = $image_name . "_" . time() . '.' . $extension;
                $image->storeAs('public/images', $full_image_name);

                $product_image = new ProductImage();

                $product_image->path = $full_image_name;
                $product_image->product_id = $product->id;;
                $product_image->save();
            }
        } else {
            $product_image = new ProductImage();
            $full_image_name = 'no_image.jpg';
            $product_image->path = $full_image_name;
            $product_image->product_id = $product->id;;
            $product_image->save();
        }

        return redirect()->route('newProduct')->with('success', 'Product added successfully');
    }

    public function productDetails($id)
    {
        $productDetails = Product::where('id', $id)->first();
        $product_images = ProductImage::get();

        return view('product-details')->with(compact('productDetails', 'product_images'));
    }

    public function trackOrder(Request $request)
    {
        //dd($request);
        $this->validate(
            $request,
            [
                'tracking_id' => 'required|numeric',
                'buyerPhone' => 'required|numeric'
            ]
        );

        $order = Order::where(function ($query) use ($request) {
            $query->orWhere('receiver_tel', $request['buyerPhone'])
                ->orWhere('receiver_tel2', $request['buyerPhone']);
        })
            ->where('id', $request['tracking_id'])
            ->first();

        $msg = $order == null ? 'Sorry , We couldn\'t find your order' : 'We found your order, ' . $order->receiver_name;
        $status = $order == null ? 'Please make sure you correctly entered tracking ID. Otherwise, try again in a while.' : 'You order status is: ' . $order->status;

        return view('track.track')->with('msg', $msg)->with('status', $status);
    }

    public function trackView()
    {
        return view('track.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Cart $id)
    {
        $id->delete();
        return redirect()->back()->with('success', 'Item with id ' . $id->id . ' removed from cart');
    }
}
