@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center table-responsive">
            <div class="col-md-16">
                <div class="card text">
                    <div class="card-header">All products posted by {{Auth::user()->name}}</div>
                    <div class="card-body">    
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($products) > 0)
                            <div class="card table-responsive">
                                <table class="table text-center">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Archived</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Archive</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $item)
                                        <tr>
                                            <td style="max-width: 100px">{{$item->name}}</td>
                                            <td style="max-width: 250px">{{$item->description}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->status ? 'No' : 'Yes'}}</td>
                                            <td class="text-center">
                                                <a href="{{route('editProduct', $item->id)}}" class="btn btn-secondary">Edit</a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{route('archiveProduct', $item->id)}}" method="POST">
                                                    @method('PATCH')
                                                    @csrf
                                                    <input name="disable" class="btn {{$item->status? 'btn-warning' : 'btn-info'}}" type="submit" onclick="return confirm('Do you really want to {{$item->status? 'archive' : 'unarchive'}} this product?')" value="{{$item->status? 'Archive' : 'Unarchive'}}">
                                                </form>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div style="align-self: center; margin-top:10px; margin-bottom: -10px;">
                                {{$products->links()}}
                            </div>
                        @else
                        <h3 class="text-center">No products registered yet. Register one to get started.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
