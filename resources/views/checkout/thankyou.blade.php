@extends('layouts.app')

@section('content')
<div class="text-center py-5">
    <h1 class="display-3">Thank You!</h1>
    <p class="lead"><strong>Your order is being processed!</strong> You will receive a confirmation email with details and tracking info.</p>
    <hr>
    <p class="lead">
        <a class="btn btn-secondary" href="{{route('dashboard')}}" role="button">Continue Shopping</a>
    </p>
</div>
@endsection
