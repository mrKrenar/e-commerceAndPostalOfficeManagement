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
                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($orders) > 0)
                            <div class="card table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Order Name</th>
                                        <th scope="col">Receiver Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Seller Name</th>
                                        <th scope="col">Postman Name</th>
                                        <th scope="col">View Order</th>
                                        <th scope="col">Edit Order</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->order_name}}</td>
                                            <td>{{$order->receiver_name}}</td>
                                            <td>@if($order->address == null)
                                                    {{$order->state. ', '.$order->city}}
                                                @else
                                                    {{$order->state. ', '.$order->city. ', ' .$order->address}}
                                                @endif
                                            </td>
                                            <td>@foreach($users as $user)
                                                    @if($order->seller_id == $user->id)
                                                {{$user->name. " " .$user->last_name}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>@foreach($users as $user)
                                                    @if($order->poster_id == $user->id)
                                                        {{$user->name. " " .$user->last_name}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <button onclick="window.location.href = '/admin/all_orders/{{ $order->id }}'" class="btn btn-primary">View</button>
                                            </td>
                                            <td>
                                                <button onclick="window.location.href = '{{route('editPostalWorker', $order->id)}}'" class="btn btn-primary">Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
{{--                            <nav aria-label="Page navigation example" class="py-4">--}}
{{--                                <ul class="pagination justify-content-center">--}}
                                        {{$orders->links()}}
{{--                                </ul>--}}
{{--                            </nav>--}}
                        @else
                            <h1>No orders yet. Wait for any than try again</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
