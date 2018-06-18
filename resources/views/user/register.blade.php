@extends('user.layout')
@section('title',"Register")

@section('content')
<div class="card card-container">
    <h2 style="font-size:27px; color:blueviolet">Create new account</h2>
    <form class="form-signin" method="post" action="#">
        
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>

        <input type="text" name="fullname" class="form-control" placeholder="Fullname" required >

        <input type="date" name="birthdate" class="form-control" placeholder="Birthdate" required style="margin-bottom: 10px">

        <input type="email" name="inputEmail" class="form-control" placeholder="Email address" required>

        <input type="password" name="password" class="form-control" placeholder="Password" required>

        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
        
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="register">Sign up</button>
    </form><!-- /form -->
</div><!-- /card-container -->
@endsection