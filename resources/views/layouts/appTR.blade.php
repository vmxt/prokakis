<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
   <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/css/monitoring.css') }}" rel="stylesheet">
</head>
   
          
<body>
   
    <div id="app">
       

            @yield('content')
    </div>

 
  
</body>
</html>
