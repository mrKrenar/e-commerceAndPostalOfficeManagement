@extends('layouts.app')
@extends('layouts.register')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('registerBuyer') }}">
                            @csrf

                            <div class="form-group row">
                            <i class="fa fa-user" aria-hidden="true"></i>

                                <div class="col-md-6">
                                    <input id="name" type="text" placeholder="Name *" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                            <i class="fa fa-user" aria-hidden="true"></i>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" placeholder="Last Name *" class="form-control @error('last_name') nuk eshte valid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                            <i class="fa fa-envelope" aria-hidden="true"></i>

                                <div class="col-md-6">
                                    <input id="email" type="email" placeholder="Email *" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>

                                <div class="col-md-6">
                                    <input id="password" type="password" placeholder="Password *" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" placeholder="Confrim Password *" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                            <i class="fa fa-phone" aria-hidden="true"></i>

                                <div class="col-md-6">
                                    <input id="tel" type="tel" placeholder="Phone *" class="form-control @error('tel') nuk eshte valid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">

                                    @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                            <i class="fa fa-phone" aria-hidden="true"></i>

                                <div class="col-md-6">
                                    <input id="tel2" type="tel" placeholder="Second Phone" class="form-control @error('tel2') nuk eshte valid @enderror" name="tel2" value="{{ old('tel2') }}" autocomplete="tel">

                                    @error('tel2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                            <i class="fa fa-globe" aria-hidden="true"></i>

                                <div class="col-md-6">
                                    <input id="state" type="text" placeholder="Country *" class="form-control @error('state') nuk eshte valid @enderror" name="state" value="{{ old('state') }}" required autocomplete="country-name">

                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                            <i class="fa fa-map-pin" aria-hidden="true"></i>

                                <div class="col-md-6">
                                    <input id="city" type="text" placeholder="City *" class="form-control @error('city') nuk eshte valid @enderror" name="city" value="{{ old('city') }}" required autocomplete="off">

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <small class="text-muted">* - Required fields</small>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
