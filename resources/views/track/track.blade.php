@extends('layouts.app')

@section('content')
<div class="text-center py-5">
    <h1 >{{$msg}}!</h1>
    <br>
    <p class="lead"><strong>{{$status}}</strong></p>
    <hr>
    <p class="lead">
        <a class="btn btn-secondary" href="{{route('dashboard')}}" role="button">Check our other products</a>
    </p>
</div>
@endsection