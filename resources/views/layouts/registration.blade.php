
<style>
        html,body,.login
        {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
        }
    
    </style>
    
    <link href="{{ asset('public/assets/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />
    
    
    
    <!DOCTYPE html>
    
    <!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en">
        <!--<![endif]-->
        <!-- BEGIN HEAD -->
    
        <head>
        <!-- from the original code -->
        <!-- CSRF Token -->
        <meta property="og:title" content="Prokakis Ebos-SG App 2020" /> 
        <meta property="og:url" content="https://app.prokakis.com/" /> 
        <meta property="og:site_name" content="Prokakis"/> 
        <meta property="og:image" content="https://app.prokakis.com/public/img-resources/ProKakisNewLogo.png" /> 
        <meta property="og:type" content="website" /> 
        <meta property="og:description" content="1st Platform to Buy / Sell / Invest / Source Fund and Market Business Online with KYB Due Diligence done all in one place to safeguard your business." />
        <!-- end from the original code -->
    
            <meta charset="utf-8" />
            <title>Prokakis Theme #3 | Dashboard</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1" name="viewport" />
            
            <meta name="csrf-token" content="{{ csrf_token() }}">
    
            <meta content="Uncover Your Hidden Business Opportunities, Protect yourself from Fraudulent Partners,Safe and Secure Business Opportunities, On-Going Business Intelligence Assessment, Form New Partnerships for Growth, Minimise Infiltration of Criminal Syndicates" name="description" />
            <meta content="Ebos-SG App 2019" name="author" />
    
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
            <!-- END GLOBAL MANDATORY STYLES -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <link href="{{ asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />
            <!-- END PAGE LEVEL PLUGINS -->
            
            <!-- BEGIN THEME GLOBAL STYLES -->
            <link href="{{ asset('public/assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
            <link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
            <!-- END THEME GLOBAL STYLES -->
            <!-- BEGIN THEME LAYOUT STYLES -->
            <link href="{{ asset('public/assets/layouts/layout3/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/assets/layouts/layout3/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
            <link href="{{ asset('public/assets/layouts/layout3/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
            <!-- END THEME LAYOUT STYLES -->
            <link rel="shortcut icon" href="favicon.ico" />
        <!-- END HEAD -->
    
        <!-- override the css values above -->
         <style>
                .page-header .page-header-menu {
                    background: #1a4275;
                }   
         </style>    
    
        
        <body class="page-container-bg-solid">
            <div class="page-wrapper">
                <div class="page-wrapper-row">
                                                <div class="login">
    
        <div class="logo"  style="margin-top: 0px; margin-bottom: 0px;">
        <a href="https://prokakis.com/">
            <img src="{{asset('public/img-resources/ProKakisNewLogo.png')}}" alt="Prokakis" id="logo" width="300px" > 
        </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content" style="margin-top: 0px;">
            <!-- BEGIN REGISTRATION FORM -->
            
        @yield('content')
        
            <!-- END REGISTRATION FORM -->
        </div>
        <!--[if lt IE 9]>
        <script src="../assets/global/plugins/respond.min.js"></script>
        <script src="../assets/global/plugins/excanvas.min.js"></script>
        <script src="../assets/global/plugins/ie8.fix.min.js"></script>
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script async="" src="//www.googletagmanager.com/gtm.js?id=GTM-W276BJ"></script><script async="" src="https://www.google-analytics.com/analytics.js"></script><script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
    
                $('#register-back-btn').click(function()
                {
                     window.history.back();
                });
    
                $('#tnc').click(function(event)
                {
                    event.preventDefault();
                    console.log('Test');
                    $('#registerbtn').prop("disabled", false);
                  
                });
    
            })
        </script>
     
        </div>
                                                <!-- END CONTENT -->
                           
                        
                            <!-- END QUICK SIDEBAR -->
                        </div>
                        <!-- END CONTAINER -->
                    </div>
                </div>
                        </div>
    
    
            <!--[if lt IE 9]>
            <script src="http://localhost/prokakis/public/assets/global/plugins/respond.min.js"></script>
            <script src="http://localhost/prokakis/public/assets/global/plugins/excanvas.min.js"></script>
            <script src="http://localhost/prokakis/public/assets/global/plugins/ie8.fix.min.js"></script>
            <![endif]-->
    
            <!-- BEGIN CORE PLUGINS -->
    
            <!-- <script src="http://localhost/prokakis/public/assets/global/plugins/jquery.min.js" type="text/javascript"></script> --> 
            
            <script src="{{ asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>  
            <script src="{{ asset('public/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script> 
           
        </body>
    
    </html>