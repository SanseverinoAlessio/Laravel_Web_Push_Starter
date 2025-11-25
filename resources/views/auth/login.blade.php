@extends('template')

@section('content')
<div class="d-flex justify-content-center pt-5">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row">
            <div class="col-md-12 mb-2">
                <label>Email</label>
                <input name="email" class="form-control">
            </div>

            <div class="col-md-12 mb-2">
                <label>Password</label>
                <input name="password" type="password" class="form-control">
            </div>

            <div class="col-md-12 btn-group mt-2">
                <button class="btn btn-success btn-block">Confirm</button>
            </div>

            <a href="{{url('/register')}}">Register now</a>

        </div>
    </form>
</div>
@endsection