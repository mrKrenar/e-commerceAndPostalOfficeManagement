@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center table-responsive">
        <div class="col-md-18">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route("postalworker")}}">New Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route("listDeliveredOrders")}}">Delivered Orders</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card table-responsive" >
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Receiver</th>
                                    <th scope="col">Tel</th>
                                    <th scope="col">Full Address</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Order Type</th>
                                    <th scope="col">Openable</th>
                                    <th scope="col">Returnable</th>
                                    <th scope="col">Additional Notes</th>
                                    <th scope="col">Order Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key =>$order)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$order->receiver_name}}</td>
                                        <td>@if($order->receiver_tel2 == null)
                                                {{$order->receiver_tel}}
                                            @else
                                                {{$order->receiver_tel. " ose " .$order->receiver_tel2}}
                                            @endif
                                        </td>
                                        <td>@if($order->address == null)
                                                {{$order->state. ', '.$order->city}}
                                            @else
                                                {{$order->state. ', '.$order->city. ', ' .$order->address}}
                                            @endif
                                            </td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{$order->weight}}</td>
                                        <td>{{$order->order_type}}</td>
                                        <td>@if($order->is_openable) YES
                                            @else No
                                            @endif
                                        </td>
                                        <td>@if($order->is_returnable) YES
                                            @else No
                                            @endif</td>
                                        <td>{{$order->additional_notes}}</td>
                                        <td>{{$order->order_name}}</td>
                                        <td>{{$order->description}}</td>
                                        <td>{{$order->price}}</td>
                                        <td>{{$order->total_price}}</td>
                                        <td>
                                            <form  class="input-group" action="{{route('changeOrderStatus', $order->id)}}" method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <input type="checkbox" id="status" name="status" value="Delivered">
                                                <label for="status"> Delivered</label><br>
                                                <button  type="submit"  class="btn btn-primary">Save</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
