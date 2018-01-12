@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-default"> Go to Posts </a>
    <h1> {{$post->title}} </h1>
    <img style="width:50%;" src="/storage/post_images/{{$post->post_image}}">
      <br>
      <br>
      <br>
        <div> {!!$post->body!!}</div>
        <small>Posts created on {{$post->created_at}} and written by {{$post->user->name}}</small>
        <hr>
        @if(!Auth::guest())
          @if(Auth::user()->id == $post->user->id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
          {{Form::hidden('_method','DELETE')}}
          {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
        {!!Form::close()!!}
      @endif
      @endif
@endsection
