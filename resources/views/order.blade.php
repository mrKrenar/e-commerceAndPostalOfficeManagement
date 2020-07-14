@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Order</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Place an order</h1>
                    <div class="container">
                    
                        <div class="card-body">
                            <form method="POST" action="{{route('order')}}">
                                @csrf

                                <div class="form-group row">
                                    <label for="receiver_name" class="col-md-4 col-form-label text-md-right">{{ __('Receiver Full Name *') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="receiver_name" type="text" class="form-control @error('receiver_name') eshte jo valide @enderror" name="receiver_name" value="{{ old('receiver_name') }}" autocomplete="given-name" required>
        
                                        @error('receiver_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="receiver_tel" class="col-md-4 col-form-label text-md-right">{{ __('Receiver Tel *') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="receiver_tel" type="text" class="form-control @error('receiver_tel') eshte jo valide @enderror" name="receiver_tel" value="{{ old('receiver_tel') }}" autocomplete="tel" required>
        
                                        @error('receiver_tel')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="receiver_tel2" class="col-md-4 col-form-label text-md-right">{{ __('Receiver Tel 2') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="receiver_tel2" type="text" class="form-control @error('receiver_tel2') eshte jo valide @enderror" name="receiver_tel2" value="{{ old('receiver_tel2') }}" autocomplete="tel">
        
                                        @error('receiver_tel2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
        
                                    <div class="col-md-6">
                                        {{-- <input id="state" type="text" class="form-control @error('state') eshte jo valide @enderror" name="state" value="{{ old('state') }}" autocomplete="country-name"> --}}
        
                                        <select class="form-control @error('state') eshte jo valide @enderror" name="state" value="{{ old('state') }}">
                                            <option value="Kosove">Kosove</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Maccedonia">North Maccedonia</option>
                                        </select>

                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City *') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="city" type="text" class="form-control @error('city') eshte jo valide @enderror" name="city" value="{{ old('city') }}" autocomplete="off" required>
        
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control @error('address') eshte jo valide @enderror" name="address" value="{{ old('address') }}" autocomplete="off">
        
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="order_name" class="col-md-4 col-form-label text-md-right">{{ __('Order Name *') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="order_name" type="text" class="form-control @error('order_name') eshte jo valide @enderror" name="order_name" value="{{ old('order_name') }}" autocomplete="on" required>
        
                                        @error('order_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Order Description') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="description" type="text" class="form-control @error('description') eshte jo valide @enderror" name="description" value="{{ old('description') }}" autocomplete="off">
        
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity *') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="quantity" onchange="calculateTotalPrice()" type="number" value="1" class="form-control @error('quantity') eshte jo valide @enderror" name="quantity" value="{{ old('quantity') }}" autocomplete="off" min="1" required>
        
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight (gr)') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="weight" type="number" value="0" class="form-control @error('weight') eshte jo valide @enderror" name="weight" value="{{ old('weight') }}" autocomplete="off" min="0">
        
                                        @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="order_type" class="col-md-4 col-form-label text-md-right">{{ __('Order type') }}</label>
        
                                    <div class="col-md-6">
                                        {{-- <input id="order_type" type="text" class="form-control @error('order_type') eshte jo valide @enderror" name="order_type" value="{{ old('order_type') }}" autocomplete="on"> --}}
                                        
                                        <select class="form-control @error('order_type') eshte jo valide @enderror" name="order_type" value="{{ old('order_type') }}">
                                            <option value="Normal">Normal</option>
                                            <option value="Fragile">Fragile</option>
                                        </select>

                                        @error('order_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="additional_notes" class="col-md-4 col-form-label text-md-right">{{ __('Additional Notes') }}</label>
        
                                    <div class="col-md-6">
                                        {{-- <input id="additional_notes" type="text-box" class="form-control @error('additional_notes') eshte jo valide @enderror" name="additional_notes" value="{{ old('additional_notes') }}" autocomplete="off"> --}}
                                        <textarea name="additional_notes" value="{{ old('additional_notes') }}" class="form-control @error('additional_notes') eshte jo valide @enderror" rows = "5" ></textarea>
                                        @error('additional_notes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Unit Price *') }}</label>
        
                                    <div class="col-md-6">
                                        {{-- <input id="price" type="number" value="0" onchange="calculateTotalPrice()" min="0" step="0.01" class="form-control @error('price') eshte jo valide @enderror" name="price" value="{{ old('price') }}" autocomplete="off" required> --}}
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">€</span>
                                            </div>
                                            <input name="price" id="price" type="number" value="0" onchange="calculateTotalPrice()" min="0" step="0.01" class="form-control @error('price') eshte jo valide @enderror" value="{{ old('price') }}" autocomplete="off" required>
                                          </div>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total_price" class="col-md-4 col-form-label text-md-right">{{ __('Total price + postal service') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="total_price" disabled value="{{$transfer_fee}}.00 €" name="total_price" type="text" min="0" step="0.01" class="form-control @error('total_price') eshte jo valide @enderror" value="{{ old('total_price') }}" >
                                        @error('total_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Place order') }}
                                        </button>
                                    </div>
                                </div>
                                <small class="text-muted">* - required fields</small>
                                <script>
                                    function calculateTotalPrice() {
                                        document.getElementById('total_price').value = ((parseFloat(document.getElementById('price').value * document.getElementById('quantity').value)) + {{$transfer_fee}}).toFixed(2) + " €";   
                                    }
                                </script>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection