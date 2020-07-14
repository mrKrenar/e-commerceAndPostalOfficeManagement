@extends('layouts.app')


@section('content')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cart</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($cart) > 0)
                    <table class="table table-responsive" style="text-align: center">
                        <thead>
                          <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Price</th>
                            {{-- <th scope="col">Amount</th> --}}
                            <th scope="col">Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($cart); $i++)
                                
                                <tr>
                                    <td><img style="align-text: center; object-fit: cover" width="100" height="100" src="../storage/images/{{$productsImage[$i][0]->path}}" /></td>
                                    <td style="min-width: 5px; max-width: 50px; padding:10px; padding-top:18px;">{{$products[$i]->name}}</td>
                                    <td style="padding: 10px; padding-top:18px;">{{$products[$i]->price}} &euro;</td>
                                    {{-- <td style="padding: 10px"><input type="number" class="form-contr ol" name="amount" value="{{$cart[$i]->amount}}" min="1" max="20"></td> --}}
                                    <td style="padding: 10px"> 
                                        <form action="{{route('product.destroy',$cart[$i]->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="X" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            
                            @endfor
                          
                        </tbody>
                    </table>
                    <div>
                        <hr>
                        <h5 style="text-align: right;"><strong>Total price: {{$totalPrice}} &euro;</strong></h5>
                    </div>
                    <div>
                        <a href="{{route('checkout.index')}}" class="btn btn-primary float-right">Continue</a>
                        @else
                            <p>No products added to cart</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
