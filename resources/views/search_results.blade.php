@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <div class="container">
        @if(count($products) == 0)
            <div class="text-center py-5">
                <div>
                    <h2>Sorry. We couldn't find any result.</h2>
                </div>
                <div>
                    <img src="http://static.skaip.org/img/emoticons/180x180/f6fcff/loudlycrying.gif" style="max-width: 150px; margin-top: 70px" alt="cying_emoji">
                </div>
                <div style="margin-top: 100px">
                    <h3>Please search again or</h3>
                </div>
                <div style="margin-top: 20px">
                    <a href="/" class="btn btn-primary">Explore other products</a>
                </div>
            </div>
        @else

        <div class="text-center py-5">
            <h2>Hooray! We've got some results!</h2>
            <br>
            <h5 class="my-0">Here's what we found</h5>
        </div>
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
        @endif
    </div>
@endsection

