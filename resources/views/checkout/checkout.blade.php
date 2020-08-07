@extends('layouts.app')

@section('extra-css')
    <!-- Styles -->
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
@endsection


@section('extra-js')
    <!-- Scripts -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/checkout.js') }}" async ></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4 custom-container">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Cart Items</span>
                    <span class="badge badge-secondary badge-pill">{{count($products)}}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($cart as $item)
                    @foreach($products as $product)
                        @if($product->id == $item->product_id)
                        <li class="list-group-item d-flex justify-content-between lh-condensed align-items-center">
                            <div class="product-details">
                                <h6 class="my-0">{{$product->name}}</h6>
                                <small class="text-muted">{{$product->description}}</small>
                            </div>
                            <span class="price">{{$product->price * $item->amount}} €</span>
                        </li>
                        @endif
                    @endforeach
                    @endforeach
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Shipping Cost</h6>
                            </div>
                            <span class="text-success">+ {{$transfer_fee}} €</span>
                        </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (No TVSH)</span>
                        <strong class="price">{{$total_price_no_tvsh}} €</strong>
                    </li>
                    {{-- <li class="list-group-item d-flex justify-content-between">
                        <span>TVSH</span>
                        <strong class="price">{{$products[0]->tvsh}} %</strong>
                    </li> --}}
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total + Transfer Fee (EUR)</span>
                        <strong class="price">{{$total_price + $transfer_fee}} €</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 order-md-1 custom-container">
                <h4 class="mb-3 text-center">Billing Information</h4>
                <form  class="custom-form" id="payment-form" action="{{route('checkout.store')}}" method="POST">
                    @csrf
                    <div class="form-group row align-items-center justify-content-center">
                        <i class="fa fa-user" aria-hidden="true" style="color: #999;"></i>
                        <div class="col-md-10">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}} {{$user->last_name}}" placeholder="Full Name *" required autocomplete="given-name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row align-items-center justify-content-center">
                        <i class="fa fa-envelope" aria-hidden="true" style="color: #999;"></i>
                        <div class="col-md-10">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" placeholder="Email *" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row align-items-center justify-content-center">
                        <i class="fa fa-home" aria-hidden="true" style="color: #999;"></i>
                        <div class="col-md-10">
                        <input id="address" type="text" class="form-control @error('address') eshte jo valide @enderror" name="address" placeholder="Address (Optional)" value="{{ old('address') }}" autocomplete="off">

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row align-items-center justify-content-center">
                        <i class="fa fa-map-pin" aria-hidden="true" style="color: #999;"></i>
                        <div class="col-md-10">
                        <input id="city" type="text" class="form-control @error('city') eshte jo valide @enderror" name="city"  value="{{ $user->city }}" placeholder="City *" required autocomplete="city" >

                        @error('city')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row align-items-center justify-content-center">
                        <i class="fas fa-globe" aria-hidden="true" style="color: #999;"></i>
                        <div class="col-md-10">
                        <select  id="state" class="form-control @error('state') eshte jo valide @enderror" name="state" value="{{ old('state') }}" required>
                            <option value="" selected disabled hidden>Select your country</option>
                            <option value="Kosovo">Kosovo</option>
                            <option value="Albania">Albania</option>
                            <option value="North Macedonia">North Macedonia</option>
                        </select>

                        @error('state')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row align-items-center justify-content-center">
                        <i class="fa fa-align-justify" aria-hidden="true" style="color: #999;"></i>
                        <div class="col-md-10">
                        <textarea name="additional_notes" placeholder="Additional Notes (Optional)" value="{{ old('additional_notes') }}" class="form-control @error('additional_notes') eshte jo valide @enderror" rows = "3" autocomplete="off" style="resize: none"></textarea>

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>

{{--                    <div class="form-group row align-items-center mt-5">--}}
{{--                        <h5 class="text-muted mr-3">Credit Card Details</h5>--}}
{{--                    </div>--}}

                    <div class="form-group row align-items-center justify-content-center">
                        <i class="fa fa-user" aria-hidden="true" style="color: #999;"></i>
                        <div class="col-md-10">
                        <input id="cardholder_name" type="text" class="form-control @error('cardholder_name') is-invalid @enderror" name="cardholder_name"  placeholder="Cardholder Name *" required autocomplete="off">

                        @error('cardholder_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>


                    <div class="form-group row align-items-center justify-content-center">
                        <i class="fa fa-credit-card" aria-hidden="true" style="color: #999;"></i>
{{--                        <label for="card-element">--}}
{{--                            Credit or debit card--}}
{{--                        </label>--}}

                        <div class="col-md-10">
                            <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span>*</span> <small>indicates required</small>
                    </div>

                    <div class="mb-3 center">
                    <button type="submit" id="complete-order" class="btn btn-lg btn-block" >Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
