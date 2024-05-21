<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{(isset($description)?$description:'')}}" >
    <meta content="" name="author">
    <meta name="keywords" content="{{(isset($keywords)?$keywords:'')}}">
	
    <title>{{isset($title)?$title:env('APP_NAME')}}</title>
    <link rel="icon" type="image/png" href="{{asset(isset($favicon)?$favicon:'')}}">
    <link rel="icon" type="image/jpg" href="{{asset(isset($favicon)?$favicon:'')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.links')

    @yield('css')
  </head>
  <body>

    <input type="hidden" id="web_base_url" value="{{url('/')}}"/>
    
    @yield('content')

    @include('layouts.footer')
    @include('layouts.script')
    @yield('js')
    
    <script type="text/javascript">
        console.clear();
    </script>
  </body>
</html>