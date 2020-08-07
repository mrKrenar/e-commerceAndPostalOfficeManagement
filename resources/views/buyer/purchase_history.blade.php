@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center table-responsive">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-header">Welcome {{$buyer->name}}! These are all your purchases.</div>
                    <div class="card-body text-center">    
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($carts) > 0)
                            <div class="card table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Purchased</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < count($carts); $i++)
                                            <tr>
                                                <td>{{$carts[$i]->id}}</td>
                                                <td>{{$products[$i]->name}}</td>
                                                <td style="min-width: 5px; max-width: 300px;">{{$products[$i]->description}}</td>
                                                <td>&euro; {{$products[$i]->price}}</td>
                                                <td>x {{$carts[$i]->amount}}</td>
                                                <td>&euro; {{$products[$i]->price * $carts[$i]->amount}}</td>
                                                <td>{{$carts[$i]->purchased ? 'Yes':'No'}}</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        {{$carts->links()}}
                        @else
                            <h1 class="text-center">No records to show. You haven't purchased anything... yet!</h1>
                        @endif
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
