@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>Your Profile</h2>
            Name:{{$user->name}}<br>
            Email:{{$user->email}}<br>
            Phone:{{$user->phone}}<br>
            <form enctype="multipart/form-data" action="/profile" method="POST">
                {{csrf_field()}}
                <label>Update Profile Image</label>
                <input type="file" name="avatar"><br>
                {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                <label>Update Phone Number</label>
                <input type="number" name="phone">
                <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection