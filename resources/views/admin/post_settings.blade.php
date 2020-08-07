@extends('layouts.app')
@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-container">
                <div class="card-header text-center">{{ __('Post settings') }}</div>

                <div class="card-body">
                    <form class="custom-form" method="POST" action="/admin/postalsettings/{{$setting->id}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="transfer_fee" class="col-md-4 col-form-label text-md-right">{{ __('Shipping fee') }}</label>

                            <div class="col-md-6">
                                <input id="transfer_fee" type="number" value="{{$setting->transfer_fee}}" min="0" step="1" class="form-control @error('transfer_fee') eshte jo valide @enderror" name="transfer_fee" value="{{ old('transfer_fee') }}" autocomplete="off">

                                @error('transfer_fee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
