<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
   <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> 
   
   <title> Prokakis - <?php if(Session::get('brandName') != null){ echo Session::get('brandName'); } ?> </title>
    @yield('styles')
   
</head>
<body style="background-color: #D3D3D3;">
    <div id="app">
       
            @yield('content')
    </div>

  
    @yield('javascript')
</body>
</html>
