<!DOCTYPE html>



<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="<?php echo e(app()->getLocale()); ?>">

    <!--<![endif]-->

    <!-- BEGIN HEAD -->



    <head>

        <!-- from the original code -->

        <!-- CSRF Token -->

        <meta property="og:url"           content="http://app-prokakis.com" />

        <meta property="og:type"          content="website" />

        <meta property="og:title"         content="Intellinz Ebos-SG App <?php echo e(now()->year); ?>" />

        <meta property="og:description"   content="Uncover Your Hidden Business Opportunities, Protect yourself from Fraudulent Partners,Safe and Secure Business Opportunities, On-Going Business Intelligence Assessment, Form New Partnerships for Growth, Minimise Infiltration of Criminal Syndicates" />

        <meta property="og:image"         content="https://app-prokakis.com/public/img-resources/ProKakisNewLogo.png" />

        <!-- end from the original code -->



        <meta charset="utf-8" />

        <title>Intellinz Login Page</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">



        <meta content="Uncover Your Hidden Business Opportunities, Protect yourself from Fraudulent Partners,Safe and Secure Business Opportunities, On-Going Business Intelligence Assessment, Form New Partnerships for Growth, Minimise Infiltration of Criminal Syndicates" name="description" />

        <meta content="Ebos-SG App 2019" name="author" />



        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css"/>

        <link href="<?php echo e(asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <link href="<?php echo e(asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/morris/morris.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/fullcalendar/fullcalendar.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/plugins/jqvmap/jqvmap/jqvmap.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->

        

        <!-- BEGIN THEME GLOBAL STYLES -->

        <link href="<?php echo e(asset('public/assets/global/css/components.min.css')); ?>" rel="stylesheet" id="style_components" type="text/css" />

        <link href="<?php echo e(asset('public/assets/global/css/plugins.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->

        <link href="<?php echo e(asset('public/assets/layouts/layout3/css/layout.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('public/assets/layouts/layout3/css/themes/default.min.css')); ?>" rel="stylesheet" type="text/css" id="style_color" />

        <link href="<?php echo e(asset('public/assets/layouts/layout3/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- END THEME LAYOUT STYLES -->

        <link rel="shortcut icon" href="favicon.ico" />

        <!-- for new banner

        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">

            -->

        <!-- END HEAD -->



    <!-- override the css values above -->

     <style>

            .page-header .page-header-menu {

                background: #1a4275;

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

                                      

                                    <?php echo $__env->yieldContent('content'); ?>



                                    <!-- END PAGE CONTENT INNER -->

                                    </div>

                                </div>





                     

                        <!-- END QUICK SIDEBAR -->

                    </div>

                    <!-- END CONTAINER -->

                </div>

            </div>



            </div>





        <!--[if lt IE 9]>

        <script src="<?php echo e(asset('public/assets/global/plugins/respond.min.js')); ?>"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/excanvas.min.js')); ?>"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/ie8.fix.min.js')); ?>"></script>

        <![endif]-->



        <!-- BEGIN CORE PLUGINS -->



        <!-- <script src="<?php echo e(asset('public/assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script> --> 

        

        <script src="<?php echo e(asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>  

        <script src="<?php echo e(asset('public/assets/global/plugins/js.cookie.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery.blockui.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>" type="text/javascript"></script>







    <!-- START NEW SCRIPTS FOR FIXING OF MENU BAR -->

        <!-- BEGIN CORE PLUGINS -->

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/js.cookie.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery.blockui.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>" type="text/javascript"></script>

        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <script src="<?php echo e(asset('public/assets/global/plugins/moment.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/morris/morris.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/morris/raphael-min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/counterup/jquery.waypoints.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/counterup/jquery.counterup.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/fullcalendar/fullcalendar.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/flot/jquery.flot.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/flot/jquery.flot.resize.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/flot/jquery.flot.categories.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jquery.sparkline.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')); ?>" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->

        <script src="<?php echo e(asset('public/assets/global/scripts/app.min.js')); ?>" type="text/javascript"></script>

        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <script src="<?php echo e(asset('public/assets/pages/scripts/dashboard.min.js')); ?>" type="text/javascript"></script>

        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->

        <script src="<?php echo e(asset('public/assets/layouts/layout3/scripts/layout.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/layouts/layout3/scripts/demo.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/layouts/global/scripts/quick-sidebar.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('public/assets/layouts/global/scripts/quick-nav.min.js')); ?>" type="text/javascript"></script>

        <!-- END THEME LAYOUT SCRIPTS -->

        <!-- END NEW SCRIPTS FOR FIXING OF MENU BAR -->

       

    </body>


                        <!-- BEGIN FOOTER -->

                        <!-- BEGIN INNER FOOTER -->
<center><p style="font-size:30px; color:white;">Copyright &copy; <script>document.write(new Date().getFullYear())</script> Intellinz</p></center>

                        <!-- END INNER FOOTER -->
                        <!-- END FOOTER -->


</html>