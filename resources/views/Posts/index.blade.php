@extends('layouts.app')

@section('content')
    <h1> Posts </h1>
    @if(count($posts)>0)
        @foreach ($posts as $post)
          <div class="well">
            <div class="row">
            <div class="col-md-4 col-sm-4">
              <img style="width:100%;height:10%;" src="/storage/post_images/{{$post->post_image}}" alt = 'ImagelessPost'>
            </div>
            <div class="col-sm-8 com-sm-8">
              <h2> <a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
              <small> Written on {{$post->created_at}} and written by {{$post->user->name}}</small>
        </div>
      </div>
    </div>
        @endforeach
        {{$posts->links()}}
    @else
          <p><b>Whoops!!</b> No Post found! </p>
    @endif
@endsection
