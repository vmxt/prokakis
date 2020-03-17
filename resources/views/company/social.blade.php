@extends('layouts.app2')
@section('styles')
    <!-- bootstrap 4.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- metronic links -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
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
            height: 50%;

            /* Position and center the image to scale nicely on all screens */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            /* position: relative;*/
        }

        /* Outer */
        .popup {
            width: 100%;
            height: 100%;
            display: none;
            position: fixed;
            top: 0px;
            left: 0px;
            background: rgba(0, 0, 0, 0.75);
        }

        /* Inner */
        .popup-inner {
            max-width: 700px;
            width: 90%;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
            border-radius: 3px;
            background: #fff;
        }

        /* Close Button */
        .popup-close {
            width: 30px;
            height: 30px;
            padding-top: 4px;
            display: inline-block;
            position: absolute;
            top: 0px;
            right: 0px;
            transition: ease 0.25s all;
            -webkit-transform: translate(50%, -50%);
            transform: translate(50%, -50%);
            border-radius: 1000px;
            background: rgba(0, 0, 0, 0.8);
            font-family: Arial, Sans-Serif;
            font-size: 20px;
            text-align: center;
            line-height: 100%;
            color: #fff;
        }

        .popup-close:hover {
            -webkit-transform: translate(50%, -50%) rotate(180deg);
            transform: translate(50%, -50%) rotate(180deg);
            background: rgba(0, 0, 0, 1);
            text-decoration: none;
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

        .pie {
            background-color: #ecc0b7;
            width: 200px;
            height: 200px;
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            position: relative;
        }

        .clip1 {
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
            height: 200px;
            clip: rect(0px, 200px, 200px, 100px);
        }

        .slice1 {
            position: absolute;
            width: 200px;
            height: 200px;
            clip: rect(0px, 100px, 200px, 0px);
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            background-color: #f7e5e1;
            border-color: #f7e5e1;
            -moz-transform: rotate(0);
            -webkit-transform: rotate(0);
            -o-transform: rotate(0);
            transform: rotate(0);
        }

        .clip2 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            clip: rect(0, 100px, 200px, 0px);
        }

        .slice2 {
            position: absolute;
            width: 200px;
            height: 200px;
            clip: rect(0px, 200px, 200px, 100px);
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            background-color: #f7e5e1;
            border-color: #f7e5e1;
            -moz-transform: rotate(0);
            -webkit-transform: rotate(0);
            -o-transform: rotate(0);
            transform: rotate(0);
        }

        .status {
            position: absolute;
            height: 30px;
            width: 200px;
            line-height: 60px;
            text-align: center;
            top: 50%;
            margin-top: -35px;
            font-size: 50px;
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
        }
    </style>


    <div class="container" style="margin-top:2px;">
        <div class="row justify-content-center">
            <div class="col-md-12" style="margin-bottom:10px;" >
                <div class="card text-white" style="height: 400px; width: 1110px;" id="coverPhoto">

                    <div class="card-img-overlay">
                        <div class="row" style="margin-top:0px; overflow: hidden">

                                <div class="col-md-4" style="margin-top:90px; color:#666; font-weight: bold;">
                             
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

                <div class="col-md-3" style="margin-bottom:50px;">
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet light">
                      
                        <div class="portlet-body">
                            <ul>
                               <!-- <li><i class="fa fa-flag"></i><b>Founded: </b><span style="float: right">2012</span> </li>
                                <li><i class="fa fa-users"></i><b>No. of employees: </b> <span style="float: right">1 - 50</span></li>
                                <li><i class="fa fa-map-marker"></i><b>Country: </b><span style="float: right"> Singapore</span></li>  -->
                                <li><i class="fa fa-globe"></i><b>Website: </b> 
                                <?php if(isset($companyProfile->company_website)){ ?>
                                     <span style="float: right"><a href="<?php echo $companyProfile->company_website; ?>"><?php echo $companyProfile->company_website; ?></a> </span> 
                                <?php } ?>
                                </li>
                               
                               <li><i class="fa fa-envelope"></i><b>Email: </b> 
                               <?php if(isset($companyProfile->company_email)){ ?>
                               <span style="float: right">
                                    <?php echo $companyProfile->company_email; ?>
                               </span>
                               <?php } ?>
                               </li> 
                            </ul>
                            <div class="hr-sect" style="margin-top: 25px; margin-bottom: 25px;">Social Media Accounts</div>
                            <ul>
                                <li> <i class="fa fa-facebook"></i>facebook.com <?php echo (isset($companyProfile->facebook))? $companyProfile->facebook: ''; ?></li>
                                <li> <i class="fa fa-twitter"></i>twitter.com <?php echo (isset($companyProfile->twitter))? $companyProfile->twitter: ''; ?></li>
                                <li> <i class="fa fa-linkedin"></i>linkedin.com <?php echo (isset($companyProfile->linkedin))? $companyProfile->linkedin : ''; ?></li>
                                <li> <i class="fa fa-instagram"></i>instagram.com <?php echo (isset($companyProfile->otherlink))? $companyProfile->otherlink : ''; ?></li>  
                            </ul>
                        </div>
                    </div>
                    <!-- END Portlet PORTLET-->
                </div>

                <div class="col-md-9">


                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="caption-subject bold uppercase"> business news</span>
                            </div>
                        </div>
                        
                        <div class="portlet-body">
                            <?php
                            if (isset($businessNewsOpportunity->content_business)) {
                                echo $businessNewsOpportunity->content_business;
                            }
                            else {
                                echo '<span style=\"text-align: center\"> -- No Business News Available --</span>';
                            }
                            ?>
                        </div>
                    </div>

                </div>
        </div>

    </div>
    <div class="popup" data-popup="popup-1">
        <div class="popup-inner">

            <h2>Find a file to upload as your new cover photo.</h2>

            <div class="form-group">
                <p><input type="file" name="bannerUpload" id="bannerUpload"></p>
                <p><span style="font-size: 12px;">For a better result please upload image at least in width of 851 pixels.</span>
                </p>
            </div>
            <br/>
            <div class="form-group">
                <label for="bannerBrandName">Company Brand</label> <br/><span style="font-size: 12px;">For best result limit your characters upto 50</span>
                <p><input type="text" style="width:100%" name="bannerBrandName" id="bannerBrandName"
                          placeholder="Enter Brand Name" value="<?php if (isset($brand_slogan[0])) {
                        echo $brand_slogan[0];
                    } ?>"></p>

            </div>

            <div class="form-group">
                <label for="bannerSlogan">Company Slogan</label> <br/><span style="font-size: 12px;">For best result limit your characters upto 70.</span>
                <p><input type="text" style="width:100%" name="bannerSlogan" id="bannerSlogan"
                          placeholder="Enter Company Slogan" value="<?php if (isset($brand_slogan[0])) {
                        echo $brand_slogan[1];
                    } ?>"></p>

            </div>

            <div class="form-group">
                <p>
                    <button align="right" id="ajxUpdate" type="button" class="btn btn-outline-primary">Update</button>
                </p>
            </div>
            <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->
            <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
        </div>
    </div>

    <script src="{{ asset('public/jq1110/jquery.min.js') }}"></script>



    <script>
        $(document).ready(function () {

            $("#updateBannerButton").hide();
            $(".popup").hide();

            $("div.hero-image").mouseover(function () {
                $("#updateBannerButton").show();
            });

            $("div.hero-image").mouseenter(function () {
                $("#updateBannerButton").show();
            });

            $("div.hero-image").click(function () {
                $("#updateBannerButton").show();
            });

            $("div.hero-image").mouseleave(function () {
                $("#updateBannerButton").hide();
            });

            $(".close").click(function () {
                $(".jumbotron").remove();
            });


            $("#ajxUpdate").click(function () {

                var fileB = $("#bannerUpload")[0].files[0];
                var brand = $("#bannerBrandName").val();
                var slogan = $("#bannerSlogan").val();

                formData = new FormData();
                formData.append("uploadBanner", fileB);
                formData.append("uploadBannerBrand", brand);
                formData.append("uploadBannerSlogan", slogan);

                $.ajax({
                    url: "{{ route('uploadingBanner') }}",
                    type: "POST",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    processData: false,
                    contentType: false,

                    success: function (data) {
                        $(".popup").hide(350);
                        document.location = "{{ route('viewingProfile') }}"
                    }
                });

            });


            //----- OPEN
            $('[data-popup-open]').on('click', function (e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-open');
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                e.preventDefault();
            });

            //----- CLOSE
            $('[data-popup-close]').on('click', function (e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-close');
                $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                e.preventDefault();
            });

        });


        function rotate(element, degree) {
            element.css({
                '-webkit-transform': 'rotate(' + degree + 'deg)',
                '-moz-transform': 'rotate(' + degree + 'deg)',
                '-ms-transform': 'rotate(' + degree + 'deg)',
                '-o-transform': 'rotate(' + degree + 'deg)',
                'transform': 'rotate(' + degree + 'deg)',
                'zoom': 1
            });
        }

        function progressBarUpdate(x, outOf) {
            var firstHalfAngle = 180;
            var secondHalfAngle = 0;

            // caluclate the angle
            var drawAngle = x / outOf * 360;

            // calculate the angle to be displayed if each half
            if (drawAngle <= 180) {
                firstHalfAngle = drawAngle;
            } else {
                secondHalfAngle = drawAngle - 180;
            }

            // set the transition
            rotate($(".slice1"), firstHalfAngle);
            rotate($(".slice2"), secondHalfAngle);

            // set the values on the text
            $(".status").html(x + "%");
        }


    </script>

@endsection

@section('javascript')
    <!-- bootstrap 4.1 -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- <script src="{{asset('public/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script> -->

    <script src="{{asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

@endsection







