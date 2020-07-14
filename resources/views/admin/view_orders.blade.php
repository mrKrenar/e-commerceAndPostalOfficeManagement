@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center table-responsive">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route("admin.newOrders")}}">New Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route("admin.allOrders")}}">All Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route("admin.deliveredOrders")}}">Delivered Orders</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="card-body">
                            <h1>Receiver: {{ $order->receiver_name }}</h1>
                            <address>
                                Address:
                                @if($order->address == null)
                                    {{$order->state. ', '.$order->city}}
                                @else
                                    {{$order->state. ', '.$order->city. ', ' .$order->address}}
                                @endif
                                    <br>Tel:
                                @if($order->receiver_tel2 == null)
                                    {{$order->receiver_tel}}
                                @else
                                    {{$order->receiver_tel. " ose " .$order->receiver_tel2}}
                                @endif

                            </address>
                            <p><b>Quantity: </b> {{$order->quantity}}</p>
                            <p><b>Weight: </b>{{ $order->weight }}</p>
                            <p><b>Order Type: </b>{{ $order->order_type }}</p>
                            <p><b>Is Openable: </b>{{ $order->is_openable }}</p>
                            <p><b>Order Type: </b>{{ $order->is_returnable }}</p>
                            <p><b>Additional Notes: </b>{{ $order->additional_notes }}</p>
                            <p><b>Order Name: </b>{{ $order->order_name }}</p>
                            <p><b>Description: </b>{{ $order->description }}</p>
                            <p><b>Total Price: </b>{{ $order->total_price }}</p>
                            <p><b>Status: </b>{{ $order->status }}</p>
                            <p><b>Seller: </b>
                                @foreach($users as $user)
                                    @if($order->seller_id == $user->id)
                                        {{$user->name. " " .$user->last_name}}
                                    @endif
                                @endforeach
                            </p>
                            <p><b>Postman: </b>
                                @foreach($users as $user)
                                    @if($order->poster_id == $user->id)
                                        {{$user->name. " " .$user->last_name}}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
