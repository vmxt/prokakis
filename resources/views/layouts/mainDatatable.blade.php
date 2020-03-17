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
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ asset('public/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('public/assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('public/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('public/assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/layouts/layout2/css/themes/blue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('public/assets/layouts/layout2/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>


        <style type="text/css">
           .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('{{ asset("public/spinner/lg.rotating-balls-spinner.gif") }}') 50% 50% no-repeat rgb(249,249,249);
            opacity: .8;
            }

        </style>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?= env('FACEBOOK_CLIENT_ID')?>',
      cookie     : true,
      xfbml      : true,
      version    : '<?= env('FACEBOOK_API_VERSION')?>'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

</head>


<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">

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


                    @yield('breadcrumbs')

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
            
            <script src="{{ asset('public/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>

            <script src="{{ asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="{{ asset('public/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="{{ asset('public/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="{{ asset('public/assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="{{ asset('public/assets/layouts/layout2/scripts/layout.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/layouts/layout2/scripts/demo.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
            <!-- END THEME LAYOUT SCRIPTS -->
            <script>
                $(document).ready(function()
                {
                    $('#clickmewow').click(function()
                    {
                        $('#radio1003').attr('checked', 'checked');
                    });

                    $('#search_keyword_selections').change(function()
                    {
                        $('#searchKeywordsList').submit();
                    });

                })

                $(window).load(function() {
                  $(".loader").fadeOut("slow");
                });
            </script>
</body>


</html>
