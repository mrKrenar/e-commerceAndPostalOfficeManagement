@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Postal settings') }}</div>

                <div class="card-body">
                    <form method="POST" action="/admin/postalsettings/{{$setting->id}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="transfer_fee" class="col-md-4 col-form-label text-md-right">{{ __('Transfer fee') }}</label>

                            <div class="col-md-6">
                                <input id="transfer_fee" type="number" value="{{$setting->transfer_fee}}" min="0" step="0.01" class="form-control @error('transfer_fee') eshte jo valide @enderror" name="transfer_fee" value="{{ old('transfer_fee') }}" autocomplete="off">

                                @error('transfer_fee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
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
