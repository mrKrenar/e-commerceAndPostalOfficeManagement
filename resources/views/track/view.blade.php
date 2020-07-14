@extends('layouts.app')

@section('content')
<div class="text-center py-5">
    <h1 >Enter phone number and tracking id</h1>
    <form action="{{route('order.track')}}" method="post">
        @csrf
        <br> 
        <input type="number" min="0" placeholder = "Phone number without +" name="buyerPhone" class="form-control" style="width: 300px; display: block; margin : 0 auto;">
        <br>
        <input type="number" min="0" placeholder = "Tracking ID" name="tracking_id" id="tracking_id" class="form-control" style="width: 300px; display: block; margin : 0 auto;">
        <br>
        <button type="submit" class="btn btn-outline-primary">Search</button>
    </form>
    {{-- <hr>
    <p class="lead">
        <a class="btn btn-secondary" href="{{route('dashboard')}}" role="button">Check our other products</a>
    </p> --}}
</div>
@endsection
