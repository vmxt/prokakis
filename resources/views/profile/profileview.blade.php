<div id="vewprofile_container">
<style>
    html, body {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
    }
    
    .progress-bar{
    background-color:black !important;
    color:#7cda24 !important;
}


</style>

    <style>
        html, body {

            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            overflow: visible;

        }

            a, button, code, div, img, input, label, li, p, pre, select, span, svg, table, td, textarea, th, ul {

            }

        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 30px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        /* The hero image */
        .hero-image, .fb-profile-block-thumb {
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



            .fa {
                cursor: pointer;
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
    
    .popup-inner-previewcompany {
            /*max-width: 800px;*/
            width: 60%;
            height: 90%;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
            border-radius: 3px;
            background: #fff;
            z-index: 5;
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
            color: black;
            cursor: pointer;
        }

        .hero-text2 {
            text-align: justify;
            position: absolute;
            top:87%;
            left: 60%;
            transform: translate(-50%, -50%);
            color: black;
            width: 880px;
            float:right;
            margin-bottom: 15px;
            background-color: white;
            padding: 5px;
            border-radius: 5px;
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
            background-color: #7cda24;
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
            background-color: #dff7d9;
            border-color: #F0A22E;
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
            background-color: #F0A22E;
            border-color: #F0A22E;
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

        .coverArr {
            list-style:none;
            margin: 0;
            padding: 0;
        }

        .coverArr li {
            width: 25%;
            height: 10%            /* Show 4 logos per row */
            list-style: none;

            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;

            -webkit-flex-flow: row wrap;
            justify-content: space-around;
        }

        .forDesktop{
            display: none;
        }

        .forMobile{
            display: block;
        }

        .card-body ul li i{
            color: red;
        }

        .card-body ul li{
            font-size: 14px;
            display: flex;
        }

        .busineNews {
            line-height: 25px;
        }

        .read_more {
            margin-left: 15px;
        }

        .card-title h1{
            font-size: 4em;
            font-weight: 500;
        }

        @media (min-width: 320px) and (max-width: 641px){
            .portlet.light.portlet-fit>.portlet-body {
                padding: 0px 0px 0px;
            }

            .card-title h1{
                font-size: 2em;
                font-weight: 500;
            }

            .pie{
                margin: 0 auto;
            }

            .btn-full{
                width: 100% !important;
            }

            .col-record .title {
                font-size: 13px !important;
                margin: 0px 0 !important;
                text-transform: uppercase;
            }

    /*        .col-record .desc {
                margin-left: 15px !important;
            }*/

            .col-record {
                line-height: 20px;
            }

            .descBox{
                margin-left: 10px;
                margin-right: 10px;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 1);
                font-size: 13px;
            }


            .card-body ul li{
                font-size: 12px;
            }

            .niceDisplay{
                padding: 10px;
            }

        }

        @media (min-width: 640px){
            .forDesktop{
                display: block !important;
            }

            .forMobile{
                display: none;
            }

        }

        @media (max-width: 960px) and (min-width: 501px) {
            .coverArr li { width: 100%; } /* Show 2 logos per row on medium devices (tablets, phones in landscape) */
        }

        @media (max-width: 500px) {
            .coverArr li { width: 100%; } /* On small screens, show one logo per row */
        }

        /* start styles for new banner */
            .fb-profile-block {
                margin: auto;
                position: relative;
                width: 100%;
            }

            /*img {
                width: 100%;
                height: auto;
            }*/

            .fb-profile-block-thumb {
                display: block;
                height: 315px;
                position: relative;
                text-decoration: none;
                background-color:black !important;
            }

            .fb-profile-block-menu {
                border-radius: 0 0 3px 3px;
            }

            .profile-img a {
                bottom: 15px;
                box-shadow: none;
                display: block;
                left: 15px;
                padding: 1px;
                position: absolute;
                height: 160px;
                width: 160px;
                background: rgba(0, 0, 0, 0.3) none repeat scroll 0 0;
                z-index: 0;
            }

            .profile-img img {
                background-color: #fff;
                border-radius: 2px;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.07);
                height: 158px;
                padding: 5px;
                width: 158px;
                margin-top:0px !important;
            }

            .profile-name {
                bottom: 60px;
                left: 205px;
                position: absolute;
            }

            .profile-name h2, h5 {
                color: black;
                font-size: 24px;
                font-weight: 600;
                line-height: 30px;
                max-width: 275px;
                position: relative;
                text-transform: uppercase;
            }

            .fb-profile-block-menu {
                height: 100px;
                position: relative;
                width: 850px;
                overflow: hidden;
            }
            @media (min-width: 320px) and (max-width: 480px) {
                .fb-profile-block-menu{
                    height:120px;
                }
            }

            .block-menu {
                clear: right;
                padding-left: 205px;
            }
            @media (min-width: 320px) and (max-width: 480px) {
                .block-menu{
                    padding-left: 15px;
                    margin-top: 55px;
                }
            }

            .block-menu ul {
                margin: 0;
                padding: 0;
            }

            .block-menu ul li {
                display: inline-block;
            }

            .block-menu ul li a {
                border-right: 1px solid #e9eaed;
                float: left;
                font-size: 14px;
                font-weight: bold;
                height: 42px;
                line-height: 3.0;
                padding: 0 17px;
                position: relative;
                vertical-align: middle;
                white-space: nowrap;
                color: #4b4f56;
                text-transform: capitalize;
            }

            .block-menu ul li:first-child a {
                border-left: 1px solid #e9eaed;
            }
            .card-img {
                background-position: center; /* Center the image */
                background-repeat: no-repeat; /* Do not repeat the image */
                background-size: cover; /* Resize the background image to cover the entire container */
                background-color: white;
                padding-top:50px !important;
            }
         /* end styles for new banner */
        /*overlay effects*/
            .overlay {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 1140px;
                height: 315px;
                background: #0e06069e;
                opacity: 0;
                transition: .75s ease;
                overflow: hidden;
            }
        .ctr {
            position: absolute;
            transform: translate(-50%, -50%);
            text-align: center;
            padding-top: 180px;
        }
        .imghov:hover .overlay{
            opacity: 1;
        }

        @media (min-width: 320px) and (max-width: 480px) {
            .profile-img img�{
                margin-left: 35px;
            }
            .ctr{
                padding-top: 90;
            }
            .overlay {
                min-width: 736px;
                max-height: 414px;
                background: none;

            }

        }
            #banner {
                margin-bottom: 80px;!important;
            }
            @media (min-width: 320px) and (max-width: 480px) {
                #banner{
                    margin-bottom: 80px;
                }

            }
            
            .tabbable-line>.nav-tabs>li.active{
                border-bottom:4px solid #7cda24 !important;
            }
            
            .tabbable-line>.nav-tabs>li:hover{
                border-bottom:4px solid black !important;
            }

    .fb-profile-block-menu .card-title{
        font-size:22px;
        text-transform:uppercase;
    }
    
    .fb-profile-block-menu .card-text{
        font-size:15px;
        text-transform:uppercase;
        font-style:italic;
        color: #7cda24 !important;
        font-weight:bolder;
    }
    
    .pure-table td{
        text-transform: uppercase;
        font-size: 12px !important;
    }
    
    .pure-table td:first-child{
        font-weight:bold !important;
    }
    
    
    .pure-table-striped tr:nth-child(2n-1) td{
        background-color:#dff7d9 !important;
        /*color:white !important;*/
    }

    </style>

    <link rel="stylesheet" href="{{ asset('public/js-tabs/jquery-ui.css') }}" rel="stylesheet">

    <!-- START CONTAINER -->
    <div id="vewprofile_container2" class="" style="overflow: hidden; height: 100%">

        <!--START COVER IMAGE -->
        <div class="row justify-content-center">
            <!-- start new banner -->
            <div class="col-md-12" id="banner"  style="margin-bottom:80px;">
                <div class="card text-white fb-profile-block " id="theBanner" style="max-height: 380px; max-width: 1140px; position: relative;">
                    <div class="fb-profile-block-thumb" style="padding-top:150px">
                        <!-- THIS IS WHERE THE COVER PHOTO BEING PLACED -->
                        <?php if($profileCoverPhoto == ""){ ?>
                         <center style=""><h3 style=""><i class="fa fa-image">&nbsp;</i>NO IMAGE UPLOADED</h3></center>
                         <?php } ?>
                        <div class="overlay ctr">
                           
          <!--                   <?php 
                            ?>
                            @if(App\SpentTokens::validateLeftBehindToken($company_id_result) != false)
                            <button data-popup-open="popup-1" type="button" class="btn  blue btn-circle btn-sm addBanner">Click to change cover photo, brand name and slogan</button>
                            @else
                                <button onclick="notifytoPremium()" type="button" class="btn  blue btn-circle btn-sm addBanner">Click to change cover photo, brand name and slogan</button>
                            @endif -->
                          <button data-popup-open="popup-1" type="button" class="btn  blue btn-circle btn-sm addBanner">Click to change cover photo, brand name and slogan</button>
                        </div>
                    </div>

                    <div class="card-img">
                        <div class="profile-img">
                            <?php if($profileAvatar != null){  ?>
                            <a href="#"><img src="{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>"
                                             alt="Card image"> </a>
                            <?php } else { ?>
                            <a href="#"><img src="{{ asset('public/images/robot.jpg') }}" alt="Card image">
                                <?php } ?> </a>
                        </div>
                        <div class="fb-profile-block-menu imghov">
                            <div class="block-menu">
                                <h2 class="card-title" style="color: black"><b><?php echo substr($brand_slogan[0], 0, 60); ?></b></h2>
                                <p class="card-text" style="color: black; margin-top: 3px; margin-bottom: 0px;"><?php echo substr($brand_slogan[1], 0, 70); ?></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end new banner -->


            <!-- START MAIN CONTENT -->
            <div class="col-md-12">


                <!-- START METRONIC TAB -->
                <div class="portlet light" id="profile-tab">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <span class="caption-subject font-dark bold uppercase">PROFILE ACCOUNT</span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active profile-tab-1">
                                <a href="#tab-1" id='profile-tab-1' data-toggle="tab"> OVERVIEW </a>
                            </li>
                            <li class="profile-tab-2">
                                <a href="#tab-2" data-toggle="tab"> KEY MANAGEMENT </a>
                            </li>
                            <li class="profile-tab-3">
                                <a href="#tab-3" data-toggle="tab"> COMPANY INFORMATION </a>
                            </li>
                            <li class="profile-tab-4">
                                <a href="#tab-4" data-toggle="tab"> STRENGTH </a>
                            </li>
                            <li class="profile-tab-5">
                                <a href="#tab-5" data-toggle="tab"> FINANCIAL STATUS </a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <!-- START TAB-1 -->
                            <div class="tab-pane active" id="tab-1">
                                <div class="portlet light portlet-fit ">
                                    <div class="portlet-body">
                                        <div class="table-scrollable table-scrollable-borderless">
                            <!-- This is for Mobile -->
                                            <div class="forMobile">
                                                @if(isset($company_data->registered_company_name))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Propose Company Name </strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->registered_company_name}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->unique_entity_number))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Company Registration Number (UEN) </strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->unique_entity_number}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->year_founded))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Year Founded </strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->year_founded}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->business_type))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Business Type </strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->business_type}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->industry))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Industry</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->industry}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->description))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Description</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->description}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->registered_address))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Office Address</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->registered_address}}
                                                        </p>
                                                    </div>
                                                @endif
                                    
                                                @if(isset($company_data->office_phone))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Office Phone</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->office_phone}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->mobile_phone))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Mobile Phone</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->mobile_phone}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->company_email))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Email</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->company_email}}
                                                        </p>
                                                    </div>
                                                 @endif

                                                @if(isset($company_data->company_website))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Website</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->company_website}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->facebook))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Facebook</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->facebook}}
                                                        </p>
                                                    </div>
                                                 @endif

                                                @if(isset($company_data->twitter))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Twitter</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->twitter}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->linkedin))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Linkedin</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->linkedin}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->googleplus))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Google Plus</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->googleplus}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->otherlink))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Other Link</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->otherlink}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->financial_year_end))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Financial Information Currency</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->financial_year_end}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->years_establishment))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Years of establishment</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->years_establishment}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->no_of_staff))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Number of Staff</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->no_of_staff}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->gross_profit))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Gross Profit</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->gross_profit}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->net_profit))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Net Profit</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->net_profit}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->annual_tax_return))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Annual Tax Filling Rate</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->annual_tax_return}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->corporate_tax))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Corporate Tax Filling Rate</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->corporate_tax}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->asset_more_liability))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Asset more than Liability</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->asset_more_liability}}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if(isset($company_data->paid_up_capital))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Paid Up Capital</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->paid_up_capital}}
                                                        </p>
                                                    </div>
                                                @endif
                                            
                                                @if(isset($company_data->financial_year_end))
                                                    <div class="col-record">
                                                        <p class="title"><strong>Financial Year End</strong></p>
                                                        <p class="desc descBox">
                                                                {{ $company_data->financial_year_end}}
                                                        </p>
                                                    </div>
                                                @endif

                                            </div>
                            <!-- This is for Mobile -->



                                            <table class="table pure-table table-bordered pure-table-horizontal pure-table-striped forDesktop" style="width:100% !important">
                                               
                                                <tbody>
                                                <tr>
                                                    <td class="fit "><b>Propose Company Name</b></td>
                                                    <td class="fit ">
                                                        @if(isset($company_data->registered_company_name))
                                                            {{ $company_data->registered_company_name}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Company Registration Number (UEN) </b></td>
                                                    <td> @if(isset($company_data->unique_entity_number))
                                                            {{ $company_data->unique_entity_number}}
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Year Founded</b></td>
                                                    <td> @if(isset($company_data->year_founded))
                                                            {{ $company_data->year_founded}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Business Type</b></td>
                                                    <td> @if(isset($company_data->business_type))
                                                            {{ $company_data->business_type}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Industry</b></td>
                                                    <td> @if(isset($company_data->industry))
                                                            {{ $company_data->industry}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Description</b></td>
                                                    <td> @if(isset($company_data->description))
                                                            {{ $company_data->description}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Office Address</b></td>
                                                    <td> @if(isset($company_data->registered_address))
                                                            {{ $company_data->registered_address}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Office Phone</b></td>
                                                    <td> @if(isset($company_data->office_phone))
                                                            {{$company_data->office_phone}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Mobile Phone</b></td>
                                                    <td> @if(isset($company_data->mobile_phone))
                                                            {{ $company_data->mobile_phone}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Email</b></td>
                                                    <td> @if(isset($company_data->company_email))
                                                            {{ $company_data->company_email}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Website</b></td>
                                                    <td> @if(isset($company_data->company_website))
                                                            {{ $company_data->company_website}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Facebook</b></td>
                                                    <td> @if(isset($company_data->facebook))
                                                            {{ $company_data->facebook}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Twitter</b></td>
                                                    <td> @if(isset($company_data->twitter))
                                                            {{ $company_data->twitter}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Linkedin</b></td>
                                                    <td> @if(isset($company_data->linkedin))
                                                            {{ $company_data->linkedin}}
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Google Plus </b></td>
                                                    <td> @if(isset($company_data->googleplus))
                                                            {{ $company_data->googleplus}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Other Link </b></td>
                                                    <td> @if(isset($company_data->otherlink))
                                                            {{ $company_data->otherlink}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Financial Information Currency</b></td>
                                                    <td> @if(isset($company_data->financial_year_end))
                                                            {{ $company_data->financial_year_end}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Years of establishment</b></td>
                                                    <td> @if(isset($company_data->years_establishment))
                                                            {{ $company_data->years_establishment}}
                                                        @endif </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Number of Staff</b></td>
                                                    <td> @if(isset($company_data->no_of_staff))
                                                            {{ $company_data->no_of_staff}}
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Gross Profit</b></td>
                                                    <td>@if(isset($company_data->gross_profit))
                                                            {{$company_data->gross_profit}}
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Net Profit</b></td>
                                                    <td>@if(isset($company_data->net_profit))
                                                            {{$company_data->net_profit}}
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Annual Tax filling rate</b></td>
                                                    <td>@if(isset($company_data->annual_tax_return))
                                                            {{$company_data->annual_tax_return}}
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Corporate Tax filling rate</b></td>
                                                    <td>@if(isset($company_data->corporate_tax))
                                                            {{$company_data->corporate_tax}}
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Asset more than Liability</b></td>
                                                    <td>@if(isset($company_data->asset_more_liability))
                                                            {{$company_data->asset_more_liability}}
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Paid up capital</b></td>
                                                    <td>@if(isset($company_data->paid_up_capital))
                                                            {{$company_data->paid_up_capital}}
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Financial Year End</b></td>
                                                    <td>@if(isset($company_data->financial_year_end))
                                                            {{$company_data->financial_year_end}}
                                                        @endif  </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- END TAB-1 -->
                            <!-- START TAB-2 -->
                            <div class="tab-pane" id="tab-2">
                                <div class="form-group">
                                    <div id="keyPersonnels">
                                        <?php

                                        $out = '';
                                        $kp = 0;
                                        if (count((array)$keyPersons) > 0) {
                                            foreach ($keyPersons as $data) {
                                                $kp++;
                                                $out = $out . '<table class="table-bordered  table pure-table pure-table-horizontal pure-table-striped" style="width: 100%; padding-top: 5px;">
                                      <tr>
                                      <th width="40%"> ' . $kp . ' </th>
                                      <th> </th>
                                      </tr>
                                  ';

                                                $out = $out . '<tr>
                                          <td> First Name   </td>
                                          <td> ' . $data->first_name . ' </td>
                                         </tr>';

                                                $out = $out . '<tr>
                                         <td> Last Name   </td>
                                         <td> ' . $data->last_name . ' </td>
                                        </tr>';

                                                $out = $out . '<tr>
                                        <td> Identification / Passport   </td>
                                        <td> ' . $data->idn_passport . ' </td>
                                       </tr>';

                                                $out = $out . '<tr>
                                       <td> Nationality   </td>
                                       <td> ' . $data->nationality . ' </td>
                                       </tr>';

                                                $out = $out . '<tr>
                                       <td> Gender   </td>
                                       <td> ' . $data->gender . ' </td>
                                       </tr>';

                                                $out = $out . '<tr>
                                       <td> Date of Birth   </td>
                                       <td> ' . $data->date_of_birth . ' </td>
                                       </tr>';

                                                $out = $out . '<tr>
                                       <td> Majority Shareholder   </td>
                                       <td> ' . $data->shareholder . ' </td>
                                       </tr>';

                                                $out = $out . '<tr>
                                       <td> Directorship   </td>
                                       <td> ' . $data->is_directorship . ' </td>
                                       </tr>';

                                                $out = $out . '<tr>
                                       <td> Position   </td>
                                       <td> ' . $data->position . ' </td>
                                         </tr>';
                                                $out = $out . '</table>';
                                            }

                                            echo $out;
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <!-- END TAB-2 -->

                            <!-- START TAB-3 -->
                            <div class="tab-pane" id="tab-3">
                                <table class="table pure-table table-bordered pure-table-horizontal pure-table-striped forDesktop" style="width:100% !important">
                                               
                                    <tbody>
                                        <tr>
                                            <td class="fit "><b>Currency</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->currency))
                                                    {{ $company_data->currency}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Years of establishment</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->years_establishment))
                                                    {{ $company_data->years_establishment}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Number of Staff</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->no_of_staff))
                                                    {{ $company_data->no_of_staff}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Gross Profit</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->gross_profit))
                                                    {{ $company_data->gross_profit}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Net Profit</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->net_profit))
                                                    {{ $company_data->net_profit}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Annual Tax filling rate</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->annual_tax_return))
                                                    {{ $company_data->annual_tax_return}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Corporate Tax filling rate</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->corporate_tax))
                                                    {{ $company_data->corporate_tax}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Asset more than Liability</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->asset_more_liability))
                                                    {{ $company_data->asset_more_liability}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Paid up capital</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->paid_up_capital))
                                                    {{ $company_data->paid_up_capital}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Solvent Value</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->solvent_value))
                                                    {{ $company_data->solvent_value}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit "><b>Financial Year End</b></td>
                                            <td class="fit ">
                                                @if(isset($company_data->financial_year_end))
                                                    {{ $company_data->financial_year_end}}
                                                @else
                                                    <b>N/A</b>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                            <!-- END TAB-3 -->


                            <!-- START TAB-4 -->
                            <div class="tab-pane" id="tab-4">
                              
                                <?php  
                                
                                if(App\SpentTokens::validateLeftBehindToken($company_id_result) != false) { 
                                ?>
  

                                <div class="form-group">
                                    <div class="alert bg-dark text-company" role="alert">Saved Awards</div>

                                    <div >
                                        
                                        <?php if(count((array)$profileAwards) > 0) { ?>
                                        
                                        <ol>

                                            <?php foreach($profileAwards as $aw) {  ?>

                                            <li  style="padding:5px;" id="awardsSaved<?php echo $aw[0]; ?>">
                                                <div class="form-group">
                                                <span style="padding-right:10px;"><b><?php echo $aw[2]; ?></b></span>
                                                <span style="float:right">Expiry Date:<?php echo date("F j, Y", strtotime($aw[4])); ?> - <a target="_blank" href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" class="btn btn-primary">Download</a></span>
                                                </div>
                                            </li>

                                            <?php } ?>
                                        </ol>
                                        <?php }else{ ?>
                                            <h3 style="text-align:center"><b>NO AWARDS SAVED!</b></h3>
                                        <?php } ?>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="alert bg-dark text-company" role="alert">INVOICES</div>

                                    <div id="upload1">
                                        <?php if(count((array)$profilePurchaseInvoice) > 0) { ?>
                                        <div class="alert bg-intellinz-light-green text-company" role="alert">Saved Purchase Invoice</div>
                                        <ol>
                                            <?php foreach($profilePurchaseInvoice as $aw) {  ?>
                                            <li style="padding:5px;" id="purchaseInvoiceSaved<?php echo $aw[0]; ?>">
                                                    <div class="form-group">
                                                <span style="padding-right:10px;"><b><?php echo $aw[2]; ?></b></span>
                                                <span style="float:right"> <a target="_blank" href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" class="btn btn-primary">Download</a></span>
                                                    </div>
                                            </li>
                                            <?php } ?>
                                        </ol>
                                        <?php }else{ ?>
                                            <h3 style="text-align:center"><b>NO SAVED PURCHASED INVOICES!</b></h3>
                                        <?php } ?>

                                    </div>

                                    <div id="upload2">
                                        <?php if(count((array)$profileSalesInvoice) > 0) { ?>
                                        <div class="alert bg-intellinz-light-green text-company" role="alert">Saved Sales Invoice</div>
                                        <ol>
                                            <?php foreach($profileSalesInvoice as $aw) {  ?>
                                            <li style="padding:5px;" id="salesInvoiceSaved<?php echo $aw[0]; ?>">
                                                    <div class="form-group">
                                                <span style="padding-right:10px;"><b><?php echo $aw[2]; ?></b></span>
                                                <span style="float:right"> <a target="_blank" href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" class="btn btn-primary">Download</a></span>
                                                    </div>
                                            </li>
                                            <?php } ?>
                                        </ol>
                                        <?php }else{ ?>
                                            <h3 style="text-align:center"><b>NO SAVED SALE INVOICES!</b></h3>
                                        <?php } ?>

                                    </div>
                                </div>

                                <div class="form-group">
                                   <div class="alert bg-dark text-company" role="alert">CERTIFICATIONS</div>

                                    <div id="upload3">
                                        <?php if(count((array)$profileCertifications) > 0) { ?>
                                        <div class="alert bg-intellinz-light-green text-company" role="alert">Saved Certificates</b></div>
                                        <ol>
                                            <?php foreach($profileCertifications as $aw) {  ?>
                                            <li style="padding:5px;" id="certificatesSaved<?php echo $aw[0]; ?>">
                                                    <div class="form-group">
                                                <span style="padding-right:10px;"><b><?php echo $aw[2]; ?></b></span>
                                                <span style="float:right">Expiry Date:<?php echo date("F j, Y", strtotime($aw[4])); ?> - <a target="_blank" href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" class="btn btn-primary">Download</a></span>
                                                    </div>
                                            </li>
                                            <?php } ?>
                                        </ol>
                                        <?php }else{ ?>
                                            <h3 style="text-align:center"><b>NO CERTIFICATIONS SAVED!</b></h3>
                                        <?php } ?>


                                    </div>
                                </div>

                                <?php }else{ ?>
                                    <h3 style="float:right"><b>THIS USER IS NOT PREMIUM. NO STRENGTH DATA</b></h3>
                                <?php } ?>

                            </div>
                            <!-- END TAB-4 -->

                            <!-- START TAB-5 -->
                            <div class="tab-pane" id="tab-5">
                                <div class="alert bg-dark text-company" role="alert">Financial Information</div>
                                    <?php
                                        $param_months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
                                        $fa = App\FA_Results::getEntries($user_id);
                                        $totalMax = App\FA_Results::getTotalByMax($user_id);
                                        $month_param = "";
                                    ?>
                                    <div class="forMobile">
                                        @if($fa)
                                            @foreach($fa as $data)
                                                <div class="col-record">
                                                    <p class="title"><strong>
                                                    <?php 
                                                        if(isset( $param_months[$data->month_param] )){
                                                            $month_param = $param_months[$data->month_param];
                                                        }
                                                    ?>
                                                        {{ $month_param.' '.$data->year_param }}</strong></p>
                                                    <p class="desc descBox">
                                                           Total Scores: {{ App\FA_Results::getTotalByMonthYears($data->entry, $user_id, $data->month_param, $data->year_param) }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        @endif
                                                <div class="col-record">
                                                    <p class="title"><strong>Maximum Mark</strong></p>
                                                    <p class="desc descBox">
                                                           Total: {{ $totalMax }}
                                                    </p>
                                                </div>

                                    </div>

                                    <table class="table pure-table table-bordered pure-table-horizontal pure-table-striped  forDesktop" style="width: 100%;;">
                                        <?php
                                        if($fa){
                                         echo '<tr>';
                                        foreach($fa as $data){
                                        echo '<td>'.$month_param.' '.$data->year_param.'</td>';
                                        }
                                        echo '<td>Maximum Mark</td></tr>';

                                        echo '<tr>';
                                            foreach($fa as $data){
                                             echo '<td> <b>Total Scores: '.App\FA_Results::getTotalByMonthYears($data->entry, $user_id, $data->month_param, $data->year_param).'</b></td>';

                                            }
                                        $totalMax = (isset($totalMax)) ? $totalMax : 0;
                                         echo ' <td><b> Total: '.$totalMax.' </b></td> </tr>';
                                        } 
                                        ?>
                                    </table>
                                </div>
                            <!-- END TAB-5 -->
                        </div>
                    </div>
                </div>
                <!--END METRONIC TAB -->



            </div>


        </div>

    </div>

  <div class="popup" data-popup="popup-previewcompany">
        <div class="popup-inner-previewcompany">
    <iframe src="{{ $urlPreview }}" style="width: 100%; height: 100%"></iframe>
           
       {{--      <div id="preview_company">
            </div>
         --}}
            <a class="popup-close" data-popup-close="popup-previewcompany" href="#">x</a>
        </div>
    </div>
    <!-- END CONTAINER -->

    <div class="popup" data-popup="popup-1">
        <div class="popup-inner">

            <?php  
           // if(App\SpentTokens::validateLeftBehindToken($company_id_result) != false) { 
            ?>

            <h2>Find a file to upload as your new cover photo.</h2>

            <div class="form-group">
                <p><input type="file" name="bannerUpload" id="bannerUpload"></p>
                <p><span style="font-size: 12px;">For a better result please upload image at least in width of 851 pixels.</span>
                </p>
            </div>

            <br/>
            <?php //} ?>
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



    <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Edit Profile</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-b"></div>
                        <div class="form-group">
                                <label class="col-md-3 control-label">Company Name</label>
                                <input type="text" class="form-control input-sm" placeholder="Company Name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn green">Edit</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</div>