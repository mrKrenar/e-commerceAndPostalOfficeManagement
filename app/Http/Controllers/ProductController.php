<?php

namespace App\Http\Controllers;

use App\Categories;
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
        $products = Product::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);
        $categories = Categories::all();
        $product_images = ProductImage::select('id', 'path', 'product_id')->groupBy('product_id')->orderBy('created_at', 'desc')->get();
        return view('welcome', compact('products', 'product_images', 'categories'));
    }

    public function showCategories($id)
    {
        $category_name = Categories::find($id);
        $products = Product::where('status', 1)->where('category', $category_name->name)->orderBy('created_at', 'desc')->paginate(6);
        $categories = Categories::all();
        $product_images = ProductImage::select('id', 'path', 'product_id')->groupBy('product_id')->orderBy('created_at', 'desc')->get();
        return view('category_products', compact('products', 'product_images', 'categories', 'category_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('create_product')->with('categories', $categories);
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
                'category' => 'required',
                'name' => 'required|max:255',
                'images' => 'nullable|array|max:5',
                'images.*' => 'image|max:2000',
                'description' => 'nullable|max:255',
                'price' => 'required|numeric|gte:0',
                'tvsh' => 'required|numeric|gte:0|lte:100',
                'quantity' => 'required|numeric|min:1',
                'weight' => 'nullable|numeric|min:0',
                'product_type' => 'required|max:255'
            ]
        );

        $product = new Product();

        $product->category = $request->get('category');
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->tvsh = $request->get('tvsh');
        $product->quantity = $request->get('quantity');
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

    public function allProducts()
    {
        return view('all_products')->with('products', Product::where('seller_id', Auth::user()->id)->orderBy('status', 'desc')->paginate(6));
    }

    public function editProduct(Product $product)
    {
        return view('update_product')->with('product', $product)
            ->with('categories', Categories::all());
    }

    public function updateProduct(Product $product, Request $request)
    {
        // $data = request()->validate([
        //     'category' => 'required',
        //     'name' => 'required|max:255',
        //     'description' => 'nullable|max:255',
        //     'price' => 'required|numeric|gte:0',
        //     'tvsh' => 'required|numeric|gte:0|lte:100',
        //     'quantity' => 'required|numeric|min:1',
        //     'weight' => 'nullable|numeric|min:0',
        //     'product_type' => 'required|max:255'
        // ]);

        $this->validate(
            $request,
            [
                'category' => 'required',
                'name' => 'required|max:255',
                'description' => 'nullable|max:255',
                'price' => 'required|numeric|gte:0',
                'tvsh' => 'required|numeric|gte:0|lte:100',
                'quantity' => 'required|numeric|min:1',
                'weight' => 'nullable|numeric|min:0',
                'product_type' => 'required|max:255'
            ]
        );
        // dd($request);
        $product->category = $request['category'];
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->tvsh = $request['tvsh'];
        $product->quantity = $request['quantity'];
        $product->weight = $request['weight'];
        $product->product_type = $request['product_type'];

        // dd($product->isDirty('category'));
        $product->update();

        return redirect(route('allProducts'))->with('success', 'Product updated successfully');
    }

    public function archiveProduct(Product $product)
    {
        $product->status = !$product->status;
        $product->update();

        return redirect(route('allProducts'))->with('success', 'Product archived successfully');
    }

    public function productDetails($id)
    {
        $productDetails = Product::where('id', $id)->first();
        $product_images = ProductImage::get();

        //get e products ans store in array
        $products1 = Product::orderBy('id', 'desc')->take(4)->get();
        $products = [];
        foreach ($products1 as $key) {
            array_push($products, $key);
        }

        //if array contains product, same as product that we're viewing in this page
        //remove product from array
        in_array($productDetails, $products) ? array_splice($products, array_search($productDetails, $products), 1) : array_splice($products, 3);

        $all_product_images = ProductImage::select('id', 'path', 'product_id')->orderBy('id', 'desc')->take(4)->get();

        return view('product-details')->with(compact('productDetails', 'product_images', 'products', 'all_product_images'));
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

        $products = Product::orderBy('id', 'desc')->take(3)->get();

        $all_product_images = ProductImage::select('id', 'path', 'product_id')->orderBy('id', 'desc')->take(4)->get();

        return view('track.track')->with(compact('msg', 'status', 'products', 'all_product_images'));
    }

    public function trackView()
    {
        $products = Product::orderBy('id', 'desc')->take(3)->get();

        $all_product_images = ProductImage::select('id', 'path', 'product_id')->orderBy('id', 'desc')->take(4)->get();

        return view('track.view')->with(compact('products', 'all_product_images'));
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

    public function search(Request $request)
    {
        $results = Product::search($request['query'])->paginate(6);
        $productImgs = ProductImage::select('id', 'path', 'product_id')->groupBy('product_id')->get();

        return view('search_results')->with('products', $results)
            ->with('product_images', $productImgs);
    }
}
