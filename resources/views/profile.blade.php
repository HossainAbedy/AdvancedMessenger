@extends('layouts.app')

@section('content')
<div id="profile" class="container" style="background:url('uploads/cover/cover3.jpg');background-repeat: no-repeat;background-size: cover">
    <profile :user="{{auth()->user()}}"></profile>
    <form enctype="multipart/form-data" action="/profile" method="POST">
        {{csrf_field()}}
        <label style="color:red"><strong>Profile Image</strong></label>
        <input type="file" name="avatar">
        {{-- <label>Update Phone Number</label>
        <input type="number" name="phone"> --}}
        <input type="submit" value="Change" class="pull-right btn btn-md btn-success">
    </form>
</div>
@endsection