<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

      <title>{{config('app.name','LSAPP')}}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
  @include("incl.navbar")
        <div class ="container">
          @include('incl.validate')
          @yield('content')
        </div>


        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
</body>
</html>
