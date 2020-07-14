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
                                </tr>
                                </thead>
                                <tbody>
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
                                        <td>
                                            <form  class="input-group" action="{{route('updatePostalWorker', $order->id)}}" method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <select class="form-control" name="postman">
                                                    <option value="" selected disabled hidden>Choose a postman here</option>
                                                    @foreach($users as $user)
                                                        @if($user->role_id==2)
                                                            <option value="{{$user->id}}">{{$user->city. " - " .$user->name." ".$user->last_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                <button  type="submit"  class="btn btn-primary">Save</button>
                                            </form>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
