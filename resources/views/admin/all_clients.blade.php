@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center table-responsive">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-header">All clients</div>
                        <div class="card-body text-center">
                            <!-- Search form -->
                            <div class="main">
                                    <form action="{{route('searchClients')}}" method="post" class="input-group">
                                        @csrf
                                        <input name="query" class="form-control" type="text" placeholder="Search clients" aria-label="Search">
                                        <div class="input-group-append">
                                            <input type="submit" value="Search" class="btn btn-secondary">
                                        </div>
                                    </form>
                              </div>
                        {{-- <div class="md-form mt-0">
                            <form action="{{route('searchClients')}}" method="post">
                                @csrf
                                <input name="query" class="form-control" type="text" placeholder="Search" aria-label="Search">
                                <input type="submit" value="Search" class="btn btn-primary float-right">
                            </form> --}}
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($clients) > 0)
                            <div class="card table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">State</th>
                                        <th scope="col">City</th>
                                        <th scope="col">All Orders</th>
                                        <th scope="col">Disable account</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($clients as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}} <br /> {{$item->last_name}}</td>
                                            <td>{{$item->company}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->tel}}</td>
                                            <td>{{$item->state}}</td>
                                            <td>{{$item->city}}</td>
                                            <td class="text-center">
                                                <a href="{{route('ordersof', $item->id)}}" class="btn btn-secondary">Orders</a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{route('disableacc', $item->id)}}" method="POST">
                                                    @method('PATCH')
                                                    @csrf
                                                <input name="disable" class="btn {{$item->isActive?'btn-warning':'btn-info'}}" type="submit" onclick="return confirm('Confirm account {{$item->isActive?'disabling':'enabling'}} for {{$item->name}}?')" value="{{$item->isActive?'Disable':'Enable'}}">
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('postalclient.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete {{$item->name}} {{$item->last_name}} (ID:{{$item->id}})?')" class="btn btn-danger">Delete</button>
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        {{$clients->links()}}
                        @else
                        <h1 class="text-center">No clients registered yet. Wait for any registration then try again</h1>
                        @endif
                        <br/>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection
