@extends('template')

@section('content')
    <div>
        <h2>Hi {{ Auth::user()->name }}!</h2>
        <button class="btn btn-success subscription-to-notifications">Click here to enable push notifications</button>
        <a href="{{url('test-notification')}}" class="btn btn-primary">Send Notification</a>
    </div>
@endsection
