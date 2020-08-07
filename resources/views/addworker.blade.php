@extends('layouts.app')
@section('extra-css')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-container">
                <div class="card-header text-center">{{ __('New Worker') }}</div>

                <div class="card-body">
                    <form class="custom-form" method="POST" action="{{ route('post.addworker') }}">
                        @csrf

                        <div class="form-group row align-items-center justify-content-center">

                            <i class="fa fa-user" aria-hidden="true" style="color: #999;"></i>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter your worker's name" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row align-items-center justify-content-center">

                            <i class="fa fa-user" aria-hidden="true" style="color: #999;"></i>
                            <div class="col-md-8">
                                <input id="last_name" type="text" class="form-control @error('last_name') nuk eshte valid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your worker's lastname" required autocomplete="family-name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row align-items-center justify-content-center">
                            <i class="fa fa-envelope" aria-hidden="true"style="color: #999;"></i>
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row align-items-center justify-content-center">

                            <i class="fa fa-unlock-alt" aria-hidden="true" style="color: #999;"></i>
                            <div class="col-md-8">
                                <input id="password" value="12345678" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row align-items-center justify-content-center">

                            <i class="fa fa-phone" aria-hidden="true" style="color: #999;"></i>
                            <div class="col-md-8">
                                <input id="tel" type="tel" class="form-control @error('tel') nuk eshte valid @enderror" name="tel" value="{{ old('tel') }}" placeholder="ex: 383 45 123 456" required autocomplete="tel">

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row align-items-center justify-content-center">

                            <i class="fa fa-globe" aria-hidden="true" style="color: #999;"></i>
                            <div class="col-md-8">
                                <input id="state" type="text" value="Kosove" class="form-control @error('state') nuk eshte valid @enderror" name="state" value="{{ old('state') }}" required autocomplete="country-name">

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
                                <input id="city" type="text" class="form-control @error('city') nuk eshte valid @enderror" name="city" value="{{ old('city') }}" placeholder="City" required autocomplete="off">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row center">
                            <button type="submit" class="btn btn-lg btn-block ">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
