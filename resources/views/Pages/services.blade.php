@extends('layouts.app')


@section('content')
  <h1> {{$title}}</h1>
  <p> You can Post just about anything on BlogSite </p>
  <p> Some of the Trending Topics are  : </p>
    @if(count($services) > 0)
          <ul class="list-group">
            @foreach($services as $service)
                  <li class="list-group-item"> {{$service}} </li>
            @endforeach
          </ul>
    @endif
@endsection
