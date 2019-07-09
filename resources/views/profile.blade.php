@extends('layouts.app')

@section('content')
<div id="profile" class="container" style="background:url('uploads/cover/cover3.jpg');background-repeat: no-repeat;background-size: cover">
    <profile :user="{{auth()->user()}}"></profile>
    <form enctype="multipart/form-data" action="/profile" method="POST">
        {{csrf_field()}}
        <label>Update Profile Image</label>
        <input type="file" name="avatar"><br>
        <label>Update Phone Number</label>
        <input type="number" name="phone">
        <input type="submit" class="pull-right btn btn-sm btn-primary">
    </form>
</div>
@endsection