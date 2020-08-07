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
                    <div class="card-header text-center">Edit Product</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">

                            <div class="card-body">
                                <form class="custom-form" method="POST" action="{{route('updateProduct', $product->id)}}">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group row align-items-center justify-content-center">

                                        <i class="fas fa-globe" aria-hidden="true" style="color: #999;"></i>
                                        <div class="col-md-8">
                                            <select class="form-control @error('category') eshte jo valide @enderror" name="category"
                                                value="{{ $product->category }}" required>
                                                <option value="" selected disabled hidden>--- Choose A Category ---</option>
                                                @foreach($categories as $category)
                                                        <option value="{{$category->name}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>

                                            @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-center">
                                        <i class="fa fa-list-alt" aria-hidden="true" style="color: #999;"></i>

                                        <div class="col-md-8">
                                            <input id="name" type="text" class="form-control @error('name') eshte jo valide @enderror" name="name"
                                                   value="{{ $product->name }}" autocomplete="given-name"
                                                   placeholder="Product Name *" required>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-center">
                                        <i class="fa fa-align-justify" aria-hidden="true" style="color: #999;"></i>

                                        <div class="col-md-8">
                                            <input id="description" type="text" class="form-control @error('description') eshte jo valide @enderror"
                                                   name="description" value="{{ $product->description }}"
                                                   placeholder="Product Description" autocomplete="off">

                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row align-items-center justify-content-center">
                                        <i class="fa fa-image" aria-hidden="true" style="color: #999;"></i>

                                        <div class="col-md-8 ">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="images">Upload images...</label>
                                                <input id="images" type="file" class="custom-file-input @error('images[]') eshte jo valide @enderror" name="images[]" multiple>

                                                @error('images[]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group row align-items-center justify-content-center">
                                        <i class="fas fa-tags" aria-hidden="true" style="color: #999;"></i>

                                        <div class="col-md-8">
                                            {{-- <input id="price" type="number" value="0" onchange="calculateTotalPrice()" min="0" step="0.01" class="form-control @error('price') eshte jo valide @enderror" name="price" value="{{ old('price') }}" autocomplete="off" required> --}}
                                            <div class="input-group">
                                            {{-- <div class="input-group mb-3"> --}}

                                                <input name="price" id="price" type="number" onchange="calculateTotalPrice()"
                                                       min="0" step="0.01" class="form-control @error('price') eshte jo valide @enderror"
                                                       value="{{ $product->price }}" autocomplete="off"
                                                       placeholder="Product Price *" required>

                                                <div class="input-group-prepend">
                                                    <span class="input-group-text text-muted">€</span>
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
                                        <p class="fas" aria-hidden="true" style="color: #999;">TVSH</p>&nbsp;<i class="fas fa-percentage" aria-hidden="true" style="color: #999;"></i>

                                        <div class="col-md-8" style="margin-right: 50px">
                                            <div class="input-group">

                                                <input name="tvsh" type="number"
                                                       min="0" max="100" step="1" class="form-control @error('price') eshte jo valide @enderror"
                                                       value="{{$product->tvsh}}" autocomplete="off"
                                                       placeholder="TVSH" required>

                                                {{-- <div class="input-group-prepend">
                                                    <span class="input-group-text text-muted">€</span>
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
                                        <i class="fas fa-boxes" aria-hidden="true" style="color: #999;"></i>

                                        <div class="col-md-8">
                                            <input id="quantity" type="number" class="form-control @error('quantity') eshte jo valide @enderror"
                                                   name="quantity" value="{{ $product->quantity }}" autocomplete="off" min="1"
                                                   placeholder="Quantity *" required>

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
                                            <input id="weight" type="number" class="form-control @error('weight') eshte jo valide @enderror"
                                                   name="weight" value="{{ $product->weight }}" autocomplete="off" min="0"
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
                                            <select class="form-control @error('product_type') eshte jo valide @enderror" name="product_type" value="{{ old('product_type') }}" required>
                                                <option value="" selected disabled hidden> --- Choose Product Type --- </option>
                                                <option value="Normal">Normal</option>
                                                <option value="Fragile">Fragile</option>
                                            </select>

                                            @error('product_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-center">
                                        <div class="col-md-8">
                                            <label class="checkbox-inline"> Can be opened</label>
                                            <input id="is_openable" type="checkbox"class=" @error('is_openable') eshte jo valide @enderror" name="is_openable"
                                                   value="{{ $product->is_openable }}" autocomplete="off">

                                            @error('is_openable')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-center">
                                        <div class="col-md-8">
                                            <label class="checkbox-inline">Can be returned </label>
                                            <input id="is_returnable" type="checkbox" class="@error('is_returnable') eshte jo valide @enderror" name="is_returnable" value="{{ $product->is_returnable }}" autocomplete="off">
                                            @error('is_returnable')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row center">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Edit Product') }}
                                            </button>
                                    </div>
                                    <span>*</span><small> required fields</small>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
