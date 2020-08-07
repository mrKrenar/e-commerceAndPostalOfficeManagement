@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center table-responsive">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-header">Cart</div>
                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($cart) > 0)
                        <table class="table" style="text-align: center;">
                            <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Product name</th>
                                <th scope="col">Price No TVSH</th>
                                <th scope="col">TVSH</th>
                                <th scope="col">Price</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Total</th>
                                <th scope="col">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($cart); $i++)
                                    
                                    <tr>
                                        <td>
                                            <a href="product-details/{{$products[$i]->id}}"><img style="align-text: center; object-fit: cover" width="100" height="100" src="../storage/images/{{$productsImage[$i][0]->path}}" /></a>
                                        </td>
                                        <td style="min-width: 5px; max-width: 50px; padding:10px; padding-top:18px;">
                                            <a href="product-details/{{$products[$i]->id}}">{{$products[$i]->name}}</a>
                                        </td>
                                        <td style="padding: 10px; padding-top:18px;">{{number_format($products[$i]->price * (1 - $products[$i]->tvsh / 100),2,'.','')}} &euro;</td>
                                        <td style="padding:10px; padding-top:18px;">{{$products[$i]->tvsh}} %</td>
                                        <td style="padding: 10px; padding-top:18px;">{{$products[$i]->price}} &euro;</td>
                                        <td style="padding: 10px">
                                        {{-- <input type="number" onfocusout="saveNewAmount('{{'amount'.$i}}')" class="form-control" name="amount" id={{'amount'.$i}} value="{{$cart[$i]->amount}}" min="1" max="20"> --}}
                                        <form action="{{route('cart.update', $cart[$i]->id)}}" method="post" id={{'form'.$i}}>
                                            @csrf
                                            <input type="number" class="form-control" onfocusout="saveNewAmount('{{'form'.$i}}')" name="amount" id={{'amount'.$i}} value="{{$cart[$i]->amount}}" min="1" max="20">
                                            <input type="submit" hidden value="submit">
                                        </form>
                                        </td>
                                        {{-- following td contains total with no TVSH. To show total with TVSH, comment existing row, and uncomment commented--}}
                                        {{-- <td style="padding: 10px; padding-top:18px;">{{number_format(($products[$i]->price * (1 - $products[$i]->tvsh / 100)) * $cart[$i]->amount,2,'.','')}} &euro;</td> --}}
                                        <td style="padding: 10px; padding-top:18px;">{{number_format(($products[$i]->price * $cart[$i]->amount),2,'.','')}} &euro;</td>
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



    {{-- <input type="button" id="test1" value="click me" />
    <p id="test2">HI </p>

    <script>
        document.getElementById("test1").addEventListener("click", function(){ 
        document.getElementById("test2").innerText = "GeeksforGeeks"; 
    });
    
    </script>


    <script src="{{asset('js/test.js')}}" type="text/javascript"></script> --}}

    <script>
        function saveNewAmount(formId) {
            $("#"+formId).trigger('submit');
        }
    </script>

</div>
@endsection
