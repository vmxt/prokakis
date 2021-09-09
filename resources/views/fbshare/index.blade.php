@extends('layouts.app2')

@section('styles')

    <!-- bootstrap 4.1 -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



<!-- metronic links -->

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

    <link href="{{ asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <link href="{{ asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('public/assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('public/assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />

    <!-- END PAGE LEVEL PLUGINS -->



    <!-- BEGIN THEME GLOBAL STYLES -->

    <link href="{{ asset('public/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />

    <link href="{{ asset('/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->

    <link href="{{ asset('public/assets/layouts/layout3/css/layout.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('public/assets/layouts/layout3/css/themes/default.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />

    <link href="{{ asset('public/assets/layouts/layout3/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- END THEME LAYOUT STYLES -->

    <link rel="shortcut icon" href="favicon.ico" />



    <!-- font-awesome -->





@endsection



@section('content')

    <link href="{{ asset('public/mini-upload/assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">





    <style>



        html, body {

            width: 100%;

            height: 100%;

            margin: 0px;

            padding: 0px;

            overflow-x: hidden;

        }



        .niceDisplay {

            font-family: 'PT Sans Narrow', sans-serif;

            background-color: white;

            padding: 30px;

            border-radius: 3px;

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

        }



        /* The hero image */

        #coverPhoto {

            /* Use "linear-gradient" to add a darken background effect to the image (photographer.jpg). This will make the text easier to read */

            <?php if(isset($profileCoverPhoto)){ ?>

 background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url("{{ asset('public/banner/') }}/<?php echo $profileCoverPhoto; ?>");

        <?php } ?>



            /* Set a specific height */

            width:100%;

            height:auto;       



            /* Position and center the image to scale nicely on all screens */

            background-position: center;

            background-repeat: no-repeat;

            background-size: cover;

            /* position: relative;*/

        }



      



        .hero-text {

            text-align: center;

            position: absolute;

            top: 50%;

            left: 50%;

            transform: translate(-50%, -50%);

            color: white;

            cursor: pointer;

        }



        .hero-text2 {

            text-align: justify;

            position: absolute;

            top: 90%;

            left: 60%;

            transform: translate(-50%, -50%);

            color: white;

            width: 800px;



        }



        #brandMessage {

            font-size: 25px;

        }



        #sloganMessage {

            font-size: 15px;

        }



        .close {

            line-height: 12px;

            width: 18px;

            font-size: 8pt;

            font-family: tahoma;

            margin-top: 1px;

            margin-right: 15px;

            position: absolute;

            top: 0;

            right: 0;

        }





        * {

            margin: 0;

            padding: 0;

        }



     



     

        ul {

            list-style-type: none;

        }



        ul li {

            margin: 0 0 10px 0;

        }



        .spinnerCimg {

            margin-bottom: 100px;

        }



        .hr-sect {

            display: flex;

            flex-basis: 100%;

            align-items: center;

            color: rgba(0, 0, 0, 0.35);

            margin: 8px 0px;

        }

        .hr-sect::before,

        .hr-sect::after {

            content: "";

            flex-grow: 1;

            background: rgba(0, 0, 0, 0.35);

            height: 1px;

            font-size: 0px;

            line-height: 0px;

            margin: 0px 8px;

    </style>





    <div class="container" style="margin-top:2px;">



        <div class="row justify-content-center">

          

                <div class="card" style="height:800px; width: 100%;" id="coverPhoto">



                    <div class="card-img-overlay">



                        <div class="row" style="margin-top:0px; overflow: hidden">



                                <div class="col-md-4" style="color:#666; font-weight: bold;">

                             

                                        <div class="portlet light" style="float:left">

                                              

                                                        <?php if($profileAvatar != null){  ?>

                                                            <img class="img-circle" src="{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>"

                                                                 alt="Card image">

                                                            <?php } else { ?>

                                                            <img class="img-circle" src="{{ asset('public/images/robot.jpg') }}" alt="Card image" style="width: 158px; height: 168px;">

                                                            <?php } ?>



                                                    <div class="caption">

                                                        <span class="caption-subject bold uppercase"> <?php echo substr($brand_slogan[0], 0, 60); ?> </span>

                                                    </div>

                                                

                        

                                                <div class="portlet-body">

                                                        <p class="card-text"><?php echo substr($brand_slogan[1], 0, 70); ?></p> 

                        

                                                </div>

                                        </div>

                                

                                 </div>

                        

                        </div>



                    </div>



                </div>

          



             

        </div>



            <div class="container" style="padding-top:20px;"> 2020 &copy; <a href="https://www.intellinz.com/">Intellinz</a></div>

      

    </div>



   

  



@endsection

















