@extends('layouts.app')
@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
@endsection
@section('content')
<div class="col-md-4 mx-auto custom-container">
    <h4 class="text-center">Track Your Order</h4>
    <form class="custom-form " action="{{route('order.track')}}" method="post">
        @csrf
        <br>
        <div class="mb-3">
            <input id="buyerPhone" type="number"  min="0" class="form-control" name="buyerPhone" placeholder="Phone number" autofocus>
        </div>

        <div style="margin-top: 25px; margin-bottom: 10px">
            <input id="tracking_id" type="number"  min="0" class="form-control" name="tracking_id" placeholder="Tracking ID">
        </div>

        <div class="center">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </div>
    </form>
    {{-- <hr>
    <p class="lead">
        <a class="btn btn-secondary" href="{{route('dashboard')}}" role="button">Check our other products</a>
    </p> --}}
    {{-- <hr style="margin-top: 50px"> --}}
</div>
<div class="container">
    @if(count($products) == 0)
        <div class="text-center py-5">
            <h2>There are no available products</h2>
        </div>
    @else

        <div class="text-center" style="margin-bottom: 30px">
            <h1>New Arrivals</h1>
        </div>
        <div class="row">
            @foreach($products as $product)
            @foreach($all_product_images as $product_image)
                @if($product_image->product_id==$product->id)
                    <div class="col-md-4 mb-2 mb-md-3 mb-lg-4">
                        <div class="card my_card">
                            <div class="photo">
                                <img src="../storage/images/{{$product_image->path}}">
                                <hr />
                                <h2>{{Str::length($product->name) > 13 ? Str::substr($product->name, 0, 13).'...' : $product->name}}</h2>
                                <h1>{{$product->price}}&euro;</h1>
                                <p>{{Str::length($product->description) > 38 ? Str::substr($product->description, 0, 38).' ...' : $product->description }}</p>
                                <div class="button_parent">
                                    <a href="{{ url('product-details/' .$product->id)}}">View</a>
                                    <form action="{{route('cart', $product->id)}}" method="POST">
                                        @csrf
                                        <input type="submit" value="Add to Cart">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
        </div>
    @endif
</div>
<p class="lead text-center py-3 ">
    <a class="btn btn-secondary" href="{{route('dashboard')}}" role="button">See more products</a>
</p>
@endsection
