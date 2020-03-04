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

</head>
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
