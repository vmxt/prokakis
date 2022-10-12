<!DOCTYPE html>



<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="{{ app()->getLocale() }}">

    <!--<![endif]-->

    <!-- BEGIN HEAD -->



    <head>
        <link rel="canonical" href="https://app-prokakis.com/login" />
        <!-- from the original code -->

        <!-- CSRF Token -->

        <meta property="og:url"           content="http://app-prokakis.com" />

        <meta property="og:type"          content="website" />

        <meta property="og:title"         content="Intellinz Ebos-SG App {{ now()->year }}" />

        <meta property="og:description"   content="Login to Intellinz, Your Complete App to Help Protect yourself from Fraudulent Partners, Uncover Your Hidden Business Opportunities, With On-Going Business Intelligence Assessment, Find Safe and Secure Business Opportunities, Help To Form New Partnerships for Growth and Minimise Infiltration of Criminal Syndicates." />

        <meta property="og:image"         content="https://app-prokakis.com/public/img-resources/intellinz_green.png" />

        <!-- end from the original code -->
        
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@EbosAccounts">
        <meta name="twitter:creator" content="@EbosAccounts">
        <meta name="twitter:title" content="Intellinz Ebos-SG App {{ now()->year }}">
        <meta name="twitter:description" content="INTELLINZ - Login to Intellinz, Your Complete App to Help Protect yourself from Fraudulent Partners, Uncover Your Hidden Business Opportunities, With On-Going Business Intelligence Assessment, Find Safe and Secure Business Opportunities, Help To Form New Partnerships for Growth and Minimise Infiltration of Criminal Syndicates.">
        <meta name="twitter:image" content="https://app-prokakis.com/public/images/intellinz_green_crop_twit.png">



        <meta charset="utf-8" />

        <title>Intellinz Login Page | A KYC Business Due Diligence App.</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta name="csrf-token" content="{{ csrf_token() }}">



        <meta content="Login to Intellinz, Your Complete App to Help Protect yourself from Fraudulent Partners, Uncover Your Hidden Business Opportunities, With On-Going Business Intelligence Assessment, Find Safe and Secure Business Opportunities, Help To Form New Partnerships for Growth and Minimise Infiltration of Criminal Syndicates." name="description" />

        <meta content="Ebos-SG App {{ now()->year }}" name="author" />

        <script type='application/ld+json'>{
        "@context":"https://schema.org","@type":"WebSite",
        "@id":"https://app-prokakis.com/#website",
        "url":"https://app-prokakis.com/",
        "name":"Intellinz App",
        "potentialAction":{
            "@type":"SearchAction",
            "target":"https://app-prokakis.com/?s={search_term_string}",
            "query-input":"required name=search_term_string"}}</script>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        <link rel="preload" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" as="style" type="text/css" />

        <link href="{{ asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>

        <link href="{{ asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />


        <!-- END GLOBAL MANDATORY STYLES -->



        <!-- BEGIN THEME GLOBAL STYLES -->

        <link href="{{ asset('public/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />

        <link href="{{ asset('public/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->

        <link href="{{ asset('public/assets/layouts/layout3/css/layout.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('public/assets/layouts/layout3/css/themes/default.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />

        <link href="{{ asset('public/assets/layouts/layout3/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- END THEME LAYOUT STYLES -->

        <link rel="shortcut icon" href="favicon.ico" />

        
        <script src="{{asset('public/assets/global/plugins/jquery-3.6.0.min.js')}}" type="text/javascript"></script>

</head>

    <!-- override the css values above -->

     <style>

            .page-header .page-header-menu {

                background: #000000;

            }

            i {color: white}



           @media (max-width: 991px) {

               .page-header .page-header-menu .hor-menu, .page-header .page-header-menu .hor-menu .navbar-nav {

                   margin-bottom: 20px;

               }



           }



     </style>    



   



    <body class="page-container-bg-solid">

        <div class="page-wrapper">

       



            <div class="page-wrapper-row full-height">

                <div class="page-wrapper-middle">

                    <!-- BEGIN CONTAINER -->

                    <div class="page-container">

                        <!-- BEGIN CONTENT -->

                        <div class="page-content-wrapper">

                            <!-- BEGIN CONTENT BODY -->

                            <!-- BEGIN PAGE HEAD-->



                            <!-- END PAGE HEAD-->

                            <!-- BEGIN PAGE CONTENT BODY -->



                                <div class="page-content">

                                    <div class="container">

                                      

                                    @yield('content')



                                    <!-- END PAGE CONTENT INNER -->

                                    </div>

                                </div>





                     

                        <!-- END QUICK SIDEBAR -->

                    </div>

                    <!-- END CONTAINER -->

                </div>

            </div>



            </div>

    </body>



</html>