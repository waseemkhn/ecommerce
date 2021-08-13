@extends('front.layout.layout')
 
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">home</a><span class="divider">/</span></li>
        <li class="active">login</li>
    </ul>
    <h3>Login</h3>
<div class="well">
  @if($errors->any())
  <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    @endif
    <form class="form-horizontal loginFrm"  method="post" action="{{route('user_check')}}">
      @csrf
      <div class="control-group">								
        <input  name="email" type="text" id="inputEmail" placeholder="Email">
      </div>
      <div class="control-group">
        <input name="password" type="password" id="inputPassword" placeholder="Password">
      </div>
      
<div class="control-group">	
    	
    <input type="submit" value=" Login" class="btn btn-success">
  </div>
</div>
</form>

<h3>Registration</h3>
<div class="well">
    <form class="form-horizontal loginFrm" method="post" action="{{route('user_store')}}" >
        @csrf
      <div class="control-group">								
            <input  name="firstname" type="text" placeholder="First name">
          </div>
          
        <div class="control-group">								
            <input  name="lastname" type="text"  placeholder="Last name">
          </div>
          
        <div class="control-group">								
        <input  name="email" type="text"  placeholder="Email">
      </div>
      <div class="control-group">
        <input name="password" type="password" placeholder="Password">
      </div>
      
<div class="control-group">	
    	
    <input type="submit" value="Register" class="btn btn-success">
  </div>
</div>
</form>

@endsection
