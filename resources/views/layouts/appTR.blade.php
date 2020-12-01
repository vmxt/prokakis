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
          @include('staff.reports.footer' )
          @include('staff.reports.header' )
          
<body>
<style>
    .btn-x4 {
    font-size: 15px;
    border-radius: 5px;
    width: 15%;
    background-color: orangered;
    }
</style>
    <div id="app">
       

            @yield('content')
    </div>

 
  
</body>
</html>
