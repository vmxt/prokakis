<!doctype html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <!-- Fonts -->
    <!--<link rel="dns-prefetch" href="//fonts.gstatic.com">-->
    <!--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->
    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->

        <meta charset="utf-8" />
        <title>Ebosreputation Social Listener</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="public/assets/global/plugins/morris/morris.css" rel="stylesheet'" type="text/css" />
        <link href="public/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="public/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="public/assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="public/assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="public/assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

        <style type="text/css">
           .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('public/spinner/lg.rotating-balls-spinner.gif') 50% 50% no-repeat rgb(249,249,249);
            opacity: .8;
            }

        </style>


</head>


<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">

<!--
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
-->



 <!-- BEGIN HEADER -->
 <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">

                @include('layouts.header')

                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
      </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
     <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->


     <!-- BEGIN CONTAINER -->
     <div class="page-container">

            <!-- SIDEBAR STARTS -->
            @include('layouts.sidebar')
            <!-- END SIDEBAR -->

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">

                   <div class="loader"></div>

                    <!-- BEGIN PAGE HEADER-->

                   <!-- <h1 class="page-title"> Admin Dashboard 2
                        <small>statistics, charts, recent events and reports</small>
                    </h1>-->

                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="{{ route('home') }}">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Influencers</span>
                            </li>
                        </ul>

                        

                    </div>
                    <!-- END PAGE HEADER-->

                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light ">


                                <div class="portlet-body">


                                      @yield('content')


                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->

   <!-- BEGIN FOOTER -->
   @include('layouts.footer')
   <!-- END FOOTER -->

<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->

      <!-- BEGIN CORE PLUGINS -->
            <script src="public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
            <script src="public/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="public/assets/global/scripts/app.min.js" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="public/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="public/assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
            <script src="public/assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
            <script src="public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
            <script src="public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
            <!-- END THEME LAYOUT SCRIPTS -->
            <script>
                $(document).ready(function()
                {
                    $('#clickmewow').click(function()
                    {
                        $('#radio1003').attr('checked', 'checked');
                    });
                })

                $(window).load(function() {
                  $(".loader").fadeOut("slow");
                });
            </script>
</body>


</html>
