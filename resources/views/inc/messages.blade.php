@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger text-center my-4" style="margin-left: 10%; margin-right: 10%">
            {{$error}}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success text-center my-4" style="margin-left: 10%; margin-right: 10%">
        {{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-center my-4" style="margin-left: 10%; margin-right: 10%">
        {{session('error')}}
    </div>
@endif