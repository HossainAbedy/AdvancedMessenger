@extends('layouts.app')

@section('content')
<div class="container" style="background:url('{{ asset('uploads/cover/cover4.jpg') }}');background-repeat: no-repeat;background-size: cover">
    <div class="row">
            
        <div class="col-md-10 col-md-offset-1">
            @foreach($userprofile as $user)
            <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h4>{{ $user->name }}'s Profile</h4>
            <label style="color:red"><strong>Name:</strong></label>{{$user->name}}<br>
            <label style="color:red"><strong>Email:</strong></label>{{$user->email}}<br>
            <h4>{{ $user->name }}'s Details</h4>
                 <div>
                        <h2 class="text-center" style="color:green">{{$user->welcome_text}}</h2>
                </div>
                <div class="text-center">
                        <p class="text-center" style="color:blue"><strong>{{$user->bio}}</strong></p>
                </div>    
                 <label style="color:red"><strong>Birth Date:</strong></label>{{$user->birth_date}} <br> 
                 <label style="color:red"><strong>Sex:</strong></label>{{$user->sex}} <br>  
                 <label style="color:red"><strong>Work:</strong></label>{{$user->work}} <br> 
                 <label style="color:red"><strong>Education:</strong></label>{{$user->education}} <br> 
                 <label style="color:red"><strong>Religion:</strong></label>{{$user->religion}} <br> 
                 <label style="color:red"><strong>Phone:</strong></label>{{$user->phone}} <br> 
                 <label style="color:red"><strong>Address:</strong></label> {{$user->address}}<br> 
                 <br> 
                 <br> 
                 <br> 
                 <br> 
                 <br> 
                 <br> 
                 <br>
                 <br> 
                 <br> 
                 <br> 
                 <br>   
           
            @endforeach
        </div>
    </div>
</div>
@endsection