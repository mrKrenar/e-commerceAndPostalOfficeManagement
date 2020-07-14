@extends('layouts.app')

@section('content')
    <div id="carouselExampleCaptions" class=" carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../storage/images/1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>First slide label</h1>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../storage/images/2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Second slide label</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../storage/images/3.jpg" class="d-block w-100" alt="...">
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

            <div class="text-center py-5">
                <h2>New Collection</h2>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
            <div class="row">
                @foreach($products as $product)
                    @foreach($product_images as $product_image)
                        @if($product_image->product_id==$product->id)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" src="../storage/images/{{$product_image->path}}" alt="Card image cap" >
                                    <div class="card-body">
                                        <div class="card-text d-flex justify-content-between align-items-center">
                                            <p> {{$product->name}}</p>
                                            <p >{{$product->price}} &euro; </p>
                                        </div>
                                        <p class="card-text"> {{$product->description}}</p>
                                        <div class="btn-group">
                                            
                                            <a href="{{ url('product-details/' .$product->id)}}" class="card-link btn btn-outline-secondary">View</a>
                                            <form action="{{route('cart', $product->id)}}" method="post">
                                                @csrf
                                                
                                                <input type="submit" class="card-link btn btn-outline-secondary" value="Add to Cart" />
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
                    {{$product_images->links()}}
                </ul>
            </nav>
        @endif
    </div>
@endsection

