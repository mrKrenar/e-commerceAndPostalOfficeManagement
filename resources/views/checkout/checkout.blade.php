@extends('layouts.app')
@section('extra-css')

    <!-- Styles -->
    <style>
        /**
        * The CSS shown here will not be introduced in the Quickstart guide, but shows
        * how you can use CSS to style your Element's container.
        */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            /*border: 1px solid gray;*/
            /*border-radius: 4px;*/
            /*background-color: white;*/

            display: block;
            width: 100%;
            height: calc(1.6em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

            /*box-shadow: 0 1px 3px 0 #e6ebf1;*/
            /*-webkit-transition: box-shadow 150ms ease;*/
            /*transition: box-shadow 150ms ease;*/
        }

        .StripeElement--focus {
            color: #495057;
            background-color: #fff;
            border-color: #a1cbef;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #card-errors{
            font-size: 80%;
            color: #e3342f;
        }

        /*.form-control::placeholder {*/
        /*    color: #6c757d;*/
        /*    opacity: 1;*/
        /*}*/
    </style>
@endsection


@section('extra-js')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        (function () {
            // Create a Stripe client.
            var stripe = Stripe('pk_test_51H0mlKK5oDGBuQ7KdvveET0SjGj3zPj0dPaaUafGmmyY2oyIM2DFUk1J3FJRXmnrWP6xjkxCSbLbopxuM2HsiEDo00lFidXQ4f');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                var options = {
                    name: document.getElementById('cardholder_name').value,
                    address_line1: document.getElementById('address').value,
                    address_city: document.getElementById('city').value,
                    address_state: document.getElementById('state').value
                }

                //Disable the submit button to prevent repeated clicks
                document.getElementById('complete-order').disabled = true;


                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;

                        // Enable the submit button
                        document.getElementById('complete-order').disabled = false;

                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        })();
    </script>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{count($products)}}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($products as $product)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{$product->name}}</h6>
                                <small class="text-muted">{{$product->description}}</small>
                            </div>
                            <span class="text-muted">{{$product->price}} €</span>
                        </li>
                    @endforeach
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Shipping Cost</h6>
                            </div>
                            <span class="text-success">+ {{$transfer_fee}} €</span>
                        </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (EUR)</span>
                        <strong>{{$total_price}} €</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form  id="payment-form" action="{{route('checkout.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Full Name <span class="text-muted">*</span></label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name Lastname" required autocomplete="given-name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">*</span></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address">Address<span class="text-muted">(Optional)</span></label>
                        <input id="address" type="text" class="form-control @error('address') eshte jo valide @enderror" name="address" placeholder="1234 Main St" value="{{ old('address') }}" autocomplete="off">

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city">City<span class="text-muted">*</span></label>
                            <input id="city" type="text" class="form-control @error('city') eshte jo valide @enderror" name="city"  value="{{ old('city') }}" placeholder="City" required autocomplete="city" >

                            @error('city')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state">State<span class="text-muted">*</span></label>
                            <select  id="state" class="form-control @error('state') eshte jo valide @enderror" name="state" value="{{ old('state') }}">
                                <option value="" selected disabled hidden>Choose..</option>
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
                    <div class="mb-3">
                        <label for="additional_notes">Additional Notes<span class="text-muted">(Optional)</span></label>
                        <textarea name="additional_notes" placeholder="Special instructions?" value="{{ old('additional_notes') }}" class="form-control @error('additional_notes') eshte jo valide @enderror" rows = "5" autocomplete="off"></textarea>

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>
                    <div class="mb-3">
                        <label for="cardholder_name">Cardholder Name<span class="text-muted">*</span></label>

                        <input id="cardholder_name" type="text" class="form-control @error('cardholder_name') is-invalid @enderror" name="cardholder_name"  placeholder="Cardholder Name" required autocomplete="off">

                        @error('cardholder_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="card-element">
                            Credit or debit card *
                        </label>
                        <div id="card-element" >
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <hr class="mb-4">
                    <button type="submit" id="complete-order" class="btn btn-primary btn-lg btn-block" >Checkout</button>
                </form>
            </div>
        </div>
    </div>
@endsection
