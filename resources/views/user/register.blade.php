@extends('user.layout')
@section('title',"Register")

@section('content')
<div class="card card-container" style="max-width: 500px;">
    <h2 style="font-size:27px; color:blueviolet; text-align:center">Create new account</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}
                <br>
            @endforeach
        </div>
        
    @endif
    <form class="form-signin" method="post" action="{{route('register')}}">
        @csrf()
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus value="{{old('username')}}">

        <input type="text" name="fullname" class="form-control" placeholder="Fullname" required value="{{old('fullname')}}">

        <input type="date" name="birthdate" class="form-control" placeholder="Birthdate" required style="margin-bottom: 10px">

        <input type="email" name="email" class="form-control" placeholder="Email address" required>

        <input type="password" name="password" class="form-control" placeholder="Password" required>

        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
        
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" >Sign up</button>
    </form><!-- /form -->
</div><!-- /card-container -->
@endsection