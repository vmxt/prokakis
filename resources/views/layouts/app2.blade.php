<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <!-- from the original code -->
    <!-- CSRF Token -->
    <meta property="og:url"           content="<?php echo Request::fullUrl(); ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $companyProfile->company_name; ?>" />
    <meta property="og:description"   content="<?php echo $companyProfile->description; ?>" />
    <meta property="og:image"         content="https://app.prokakis.com/public/images/<?php echo $profileAvatar; ?>" />
    <!-- end from the original code -->

    <meta charset="utf-8" />
 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="<?php echo $companyProfile->description; ?>" name="description" />
    <meta content="<?php echo $companyProfile->company_name; ?>" name="author" />
 

    <title><?php echo $companyProfile->company_name .' | '.  $companyProfile->description; ?></title>


    <!-- Styles -->
   <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> 
   
   <title> Intellinz - <?php if(Session::get('brandName') != null){ echo Session::get('brandName'); } ?> </title>
    @yield('styles')
   
</head>
<body style="background-color: #D3D3D3;">
    <div id="app">
       
            @yield('content')
    </div>

   
  
    @yield('javascript')
</body>
    @yield('modal')

</html>
