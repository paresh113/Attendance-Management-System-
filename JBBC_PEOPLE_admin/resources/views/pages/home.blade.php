@extends('layouts.master')

@section('content')
<!-- <form class="form-inline" action="home">
  <label for="id">user id :</label>
  <input type="email" id="email" placeholder="Enter Id" name="email">
  
  <label for="pwd">Password:</label>
  <input type="password" id="pwd" placeholder="Enter password" name="pswd">
  <label>
    <input type="checkbox" name="remember"> Remember me
  </label> 
  <button type="submit">Submit</button>
</form> -->
<form method="POST" action="{{ route('signIn') }}">
  @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Employee ID</label>
    <input type="email" class="form-control" id="emp_id" name="emp_id" aria-describedby="emailHelp" placeholder="Enter Id" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="emp_pass" name="emp_pass" placeholder="Enter Password" required>
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection