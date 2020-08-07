@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center table-responsive">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-header">All workers</div>
                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($workers) > 0)

                            <div class="card table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        {{-- <th scope="col">#</th> --}}
                                        <th scope="col">Name</th>
                                        {{-- <th scope="col">Last Name</th> --}}
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">State</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Manage</th>
                                        <th scope="col">Contract</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($workers as $item)
                                        <tr>
                                            {{-- <td>{{$item->id}}</td> --}}
                                            <td>{{$item->name}} <br /> {{$item->last_name}}</td>
                                            {{-- <td>{{$item->last_name}}</td> --}}
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->tel}}</td>
                                            <td>{{$item->state}}</td>
                                            <td>{{$item->city}}</td>
                                            <td>
                                                <form action="{{ route('postalworker.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                            <td><a class="btn btn-outline-primary" href="{{route('workerContract',$item->id)}}">PDF</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                                {{$workers->links()}}
                        @else
                            <h1>No workers registered. Add one to get started</h1>
                        @endif
                        <br/>
                        <a class="btn btn-primary float-right" href="{{route('addworker')}}" role="button" >Add worker</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
