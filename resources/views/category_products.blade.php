@extends('welcome')
@section('products')
        <div class="row mb-3 justify-content-center">
            <h4 class="text-center mb-3 py-2" style="border-bottom:1px solid #ccc;">
                {{$category_name->name}}
            </h4>
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
@endsection
