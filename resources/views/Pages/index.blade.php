@extends('layouts.app')
@section('content')
  <h1> {{$title}} </h1>

  <div class="jumbotron text-center">
  <p> Get Started With <h1><strong>BlogSite</strong></h1></p>
  <p><a class= "btn btn-primary btn-lg" href="/register">Register</a> <a class= "btn btn-primary btn-lg" href="/login">Login</a></p>
</div>
@endsection
