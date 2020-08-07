@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{Auth::logout()}}
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Account disabled</h4>
                <p>Your account has been disabled. Contact support for more info</p>
                <div class="mt-4">
                    <a href="mailto:support@test.test">Contact support</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection