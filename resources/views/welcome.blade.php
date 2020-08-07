@extends('layouts.app')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
@endsection
@section('content')
    <div id="carouselExampleCaptions" class=" carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div style="--aspect-ratio:3/1;">
                    <img src="../storage/images/1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h1>First slide label</h1>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <div style="--aspect-ratio:3/1;">
                    <img src="../storage/images/2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h1>Second slide label</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <div style="--aspect-ratio:3/1;">
                    <img src="../storage/images/3.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h1>Third slide label</h1>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
        @if(count($products) == 0)
            <div class="text-center py-5">
                <h2>There are no available products</h2>
            </div>
        @else
            <div class="row py-3  justify-content-end">
                <div class="dropright show">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter by Category
                    </a>
                    <div class=" dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a href="{{route('dashboard')}}" class="dropdown-item"> All Categories </a>
                        @foreach($categories as $category)
                            <a href="{{route('categories',$category->id)}}" class="dropdown-item"> {{$category->name}} </a>
                        @endforeach
                    </div>
                </div>
            </div>

            @section('products')
                <div class="row">
                    @foreach($products as $product)
                        @foreach($product_images as $product_image)
                            @if($product_image->product_id==$product->id)
                                <div class="col-md-4 mb-2 mb-md-3 mb-lg-4">
                                    <div class="card my_card">
                                        <div class="photo">
                                            <img src="../storage/images/{{$product_image->path}}">
                                            <hr />
                                            <h2>{{Str::length($product->name) > 13 ? Str::substr($product->name, 0, 13).'...' : $product->name}}</h2>
                                            {{-- <h4>{{$product->description}}</h4> --}}
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
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{$products->links()}}
                    </ul>
                </nav>
            @show
        @endif
    </div>
@endsection

