@extends('layouts.app')
@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom-container">
                    <div class="card-header text-center">Add New Order</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" class="custom-form" action="{{route('order')}}">
                            @csrf

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fa fa-user" aria-hidden="true" style="color: #999;"></i>
                                <div class="col-md-8">
                                    <input id="receiver_name" type="text"
                                           class="form-control @error('receiver_name') eshte jo valide @enderror"
                                           name="receiver_name" value="{{ old('receiver_name') }}"
                                           placeholder="Receiver's Full Name *"
                                           autocomplete="given-name" required>

                                    @error('receiver_name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fas fa-phone" aria-hidden="true" style="color: #999;"></i>
                                <div class="col-md-8">
                                    <input id="receiver_tel" type="text"
                                           class="form-control @error('receiver_tel') eshte jo valide @enderror"
                                           name="receiver_tel" value="{{ old('receiver_tel') }}" autocomplete="tel"
                                           placeholder="Phone *"
                                           required>

                                    @error('receiver_tel')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fas fa-phone" aria-hidden="true" style="color: #999;"></i>
                                <div class="col-md-8">
                                    <input id="receiver_tel2" type="text"
                                           class="form-control @error('receiver_tel2') eshte jo valide @enderror"
                                           name="receiver_tel2" value="{{ old('receiver_tel2') }}"
                                           placeholder="Second Phone" autocomplete="tel">

                                    @error('receiver_tel2')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">

                                <i class="fas fa-globe" aria-hidden="true" style="color: #999;"></i>
                                <div class="col-md-8">
                                    {{-- <input id="state" type="text" class="form-control @error('state') eshte jo valide @enderror" name="state" value="{{ old('state') }}" autocomplete="country-name"> --}}

                                    <select class="form-control @error('state') eshte jo valide @enderror" name="state"
                                            value="{{ old('state') }}">
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

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fa fa-map-pin" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8">
                                    <input id="city" type="text"
                                           class="form-control @error('city') eshte jo valide @enderror" name="city"
                                           value="{{ old('city') }}" autocomplete="off"
                                           placeholder="City *" required>

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fa fa-home" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8">
                                    <input id="address" type="text"
                                           class="form-control @error('address') eshte jo valide @enderror"
                                           name="address" value="{{ old('address') }}" autocomplete="off"
                                           placeholder="Address">

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fa fa-list-alt" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8">
                                    <input id="order_name" type="text"
                                           class="form-control @error('order_name') eshte jo valide @enderror"
                                           name="order_name" value="{{ old('order_name') }}" autocomplete="on"
                                           placeholder="Order Name *" required>

                                    @error('order_name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fa fa-align-justify" aria-hidden="true" style="color: #999;"></i>
                                <div class="col-md-8">
                                    <input id="description" type="text"
                                           class="form-control @error('description') eshte jo valide @enderror"
                                           name="description" value="{{ old('description') }}" autocomplete="off"
                                           placeholder="Description">

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fas fa-boxes" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8">
                                    <input id="quantity" onchange="calculateTotalPrice()" type="number"
                                           class="form-control @error('quantity') eshte jo valide @enderror"
                                           name="quantity" value="{{ old('quantity') }}" autocomplete="off" min="1"
                                           required placeholder="Quantity *">

                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fas fa fa-balance-scale" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8">
                                    <input id="weight" type="number"
                                           class="form-control @error('weight') eshte jo valide @enderror" name="weight"
                                           value="{{ old('weight') }}" autocomplete="off" min="0"
                                           placeholder="Weight in grams">

                                    @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fas fa-people-carry" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8">
                                    {{-- <input id="order_type" type="text" class="form-control @error('order_type') eshte jo valide @enderror" name="order_type" value="{{ old('order_type') }}" autocomplete="on"> --}}

                                    <select class="form-control @error('order_type') eshte jo valide @enderror"
                                            name="order_type" value="{{ old('order_type') }}">
                                        <option value="" selected disabled hidden> Select order type:</option>
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

                            <div class="form-group row justify-content-center">
                                <i class="fa fa-align-justify" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8">
                                    {{-- <input id="additional_notes" type="text-box" class="form-control @error('additional_notes') eshte jo valide @enderror" name="additional_notes" value="{{ old('additional_notes') }}" autocomplete="off"> --}}
                                    <textarea name="additional_notes" value="{{ old('additional_notes') }}"
                                              class="form-control @error('additional_notes') eshte jo valide @enderror"
                                              rows="3"
                                              placeholder="Additional Notes...">

                                    </textarea>
                                    @error('additional_notes')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fas fa-tags" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8">
                                    {{-- <input id="price" type="number" value="0" onchange="calculateTotalPrice()" min="0" step="0.01" class="form-control @error('price') eshte jo valide @enderror" name="price" value="{{ old('price') }}" autocomplete="off" required> --}}
                                    <div class="input-group">
                                        <input name="price" id="price" type="number"
                                               onchange="calculateTotalPrice()" min="0" step="0.01"
                                               class="form-control @error('price') eshte jo valide @enderror"
                                               value="{{ old('price') }}" autocomplete="off"
                                               placeholder="Price *" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text text-muted">&euro;</span>
                                        </div>
                                    </div>
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <p class="fas" aria-hidden="true" style="color: #999;">TVSH</p>&nbsp;<i class="fas fa-percent" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8" style="margin-right: 50px">
                                    <div class="input-group">
                                        <input name="tvsh" type="number"
                                               min="0" max="100" step="1"
                                               class="form-control @error('tvsh') eshte jo valide @enderror"
                                               value="18" autocomplete="off"
                                               placeholder="TVSH" required>
                                        {{-- <div class="input-group-append">
                                            <span class="input-group-text text-muted px-3">&percnt;</span>
                                        </div> --}}
                                    </div>
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-center">
                                <i class="fas fa-tags" aria-hidden="true" style="color: #999;"></i>

                                <div class="col-md-8">
                                    {{--value="{{$transfer_fee}}.00 €"--}}
                                    <input id="total_price" disabled name="total_price"
                                           type="text" min="0" step="0.01"
                                           class="form-control @error('total_price') eshte jo valide @enderror"
                                           value=""
                                           placeholder="Total Price"
                                           {{-- duhemi me lon 1 indikator kur osht disabled 1 element,
                                            psh background ngjyra si rreshti me poshte --}}
                                           {{-- style="background-color: rgb(241, 241, 241)" --}}
                                           >
                                    @error('total_price')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Place order') }}
                                    </button>
                            </div>
                                <span class="text-muted">*</span> <small> required fields</small>


                        </form>

                        <script>
                            function calculateTotalPrice() {
                                document.getElementById('total_price').value = ((parseFloat(document.getElementById('price').value * document.getElementById('quantity').value)) + {{$transfer_fee}}).toFixed(2) + " €";
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
