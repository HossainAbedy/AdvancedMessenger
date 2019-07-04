@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @foreach($userprofile as $user)
            <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->name }}'s Profile</h2>
            Name:{{$user->name}}<br>
            Email:{{$user->email}}<br>
            Phone:{{$user->phone}}<br>
            @endforeach
        </div>
    </div>
</div>
@endsection