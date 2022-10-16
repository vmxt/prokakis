<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <!-- from the original code -->
        <!-- CSRF Token -->
        <meta property="og:title" content="Intellinz Ebos-SG App {{ now()->year }}" /> 
        <meta property="og:url" content="https://app-prokakis.com/" /> 
        <meta property="og:site_name" content="Intellinz"/> 
        <meta property="og:image" content="https://app-prokakis.com/public/img-resources/intellinz_green.png" /> 
        <meta property="og:type" content="website" /> 
        <meta property="og:description" content="1st Platform to Buy / Sell / Invest / Source Fund and Market Business Online with KYC Due Diligence, On-Going Business Intelligence Assessment, Protect yourself from Fraudulent Partners, Uncover Your Hidden Business Opportunities, Form New Partnerships for Growth, Minimise Infiltration of Criminal Syndicates, Safe and Secure Business Opportunities." /> 
        <!-- end from the original code -->
        
        <!-- START Twitter card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@EbosAccounts">
        <meta name="twitter:creator" content="@EbosAccounts">
        <meta name="twitter:title" content="Intellinz Ebos-SG App {{ now()->year }}">
        <meta name="twitter:description" content="INTELLINZ - 1st Platform to Buy / Sell / Invest / Source Fund and Market Business Online with KYC Due Diligence, On-Going Business Intelligence Assessment, Protect yourself from Fraudulent Partners, Uncover Your Hidden Business Opportunities, Form New Partnerships for Growth, Minimise Infiltration of Criminal Syndicates, Safe and Secure Business Opportunities.">
        <meta name="twitter:image" content="https://app-prokakis.com/public/images/intellinz_green_crop_twit.png">
        <!-- END Twitter Card -->

        <meta charset="utf-8" />
        <title>Intellinz | A KYC Due Diligence App | System Dashboard.</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta content="1st Platform to Buy / Sell / Invest / Source Fund and Market Business Online with KYC Due Diligence, On-Going Business Intelligence Assessment, Protect yourself from Fraudulent Partners, Uncover Your Hidden Business Opportunities, Form New Partnerships for Growth, Minimise Infiltration of Criminal Syndicates, Safe and Secure Business Opportunities." name="description" />
        <meta content="Ebos-SG App 2021" name="author" />
        
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
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&display=swap&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
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
        <link href="{{ asset('public/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('public/assets/layouts/layout3/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/layouts/layout3/css/themes/default.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('public/assets/layouts/layout3/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="https://app-prokakis.com//favicon.ico" />
        <!-- for new banner
        
            -->
        <link href="{{ asset('public/assets/global/css/bootstrap.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <!-- END HEAD --> 
        <script src="{{asset('public/assets/global/plugins/jquery-3.6.0.min.js')}}" type="text/javascript"></script>

     <style>

        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

.page-header{
    margin:0px !important;
}
  .fit {
   width:1% !important;
   white-space: nowrap !important;
 }
 
 .card{
     border-radius:5px;
 }
 
 .btn-company{
     background:#7cda24 !important;
 }
.modal:not(#agreement_modal){
    /*z-index:1000011010102 !important */
}
.loading{
    z-index:1000011010103 !important
}
h1,
.h1 {
  font-size: 36px;
  text-align: center;
  font-size: 5em;
  color: #404041;
}

.navbar-nav>li>.dropdown-menu {
  margin-top: 20px;
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
}

.navbar-default .navbar-nav>li>a {
  width: 200px;
  font-weight: bold;
}

.mega-dropdown {
  position: static !important;
  width: 100%;
}

.mega-dropdown-menu {
  padding: 20px 0px;
  width: 100%;
  box-shadow: none;
  -webkit-box-shadow: none;
}

.md-radio label>.check{
    background: green !important;
}

.text-dark{
    color:black !important;
}

.mega-dropdown-menu:before {
  content: "";
  border-bottom: 15px solid #fff;
  border-right: 17px solid transparent;
  border-left: 17px solid transparent;
  position: absolute;
  top: -15px;
  left: 285px;
  z-index: 10;
}

.mega-dropdown-menu:after {
  content: "";
  border-bottom: 17px solid #ccc;
  border-right: 19px solid transparent;
  border-left: 19px solid transparent;
  position: absolute;
  top: -17px;
  left: 283px;
  z-index: 8;
}

.mega-dropdown-menu > li > ul {
  padding: 0;
  margin: 0;
}

.mega-dropdown-menu > li > ul > li {
  list-style: none;
}

.mega-dropdown-menu > li > ul > li > a {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.428571429;
  color: #999;
  white-space: normal;
}

.mega-dropdown-menu > li ul > li > a:hover,
.mega-dropdown-menu > li ul > li > a:focus {
  text-decoration: none;
  color: #444;
  background-color: #f5f5f5;
}

.mega-dropdown-menu .dropdown-header {
  color: #428bca;
  font-size: 18px;
  font-weight: bold;
}

.mega-dropdown-menu form {
  margin: 3px 20px;
}

.mega-dropdown-menu .form-group {
  margin-bottom: 3px;
}

.bg-intellinz-light-green{
    background-color:#dff7d9 !important
}

.bg-company{
    background-color:#7cda24 !important;
}

button.bg-intellinz-light-green:hover, input.bg-intellinz-light-green:hover, a.bg-intellinz-light-green:hover{
    background-color:#7cda24 !important;
    color:white !important;
}

button.bg-intellinz-light-green, input.bg-intellinz-light-green, a.bg-intellinz-light-green{
    background-color:#dff7d9 !important;
    color:black !important;
    border: 1px solid #7cda24 !important;
    font-weight:bold;
}

.btn.red-mint:not(.btn-outline){
    border-color:none !important;
}

.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{
    border-color:black !important;
    background-color:black !important;
}



/*
    code for mega nav
*/

            .page-header .page-header-menu, .mega-menu-content {
                background: #000000;
            }
            i {color: white}
            
            
    @media (max-width: 760px) {
        #main_user_menu{
            margin-top:30px !important;
            
        }
        
        #main_user_menu:after{
                margin-top: 49px !important;
                right: 70 !important;
        }
    }
    
    @media (min-width: 520px){
        
    }
    
    @media (min-width: 768px){
        
    }
    

           @media (max-width: 991px) {
               .page-header .page-header-menu .hor-menu, .page-header .page-header-menu .hor-menu .navbar-nav {
                   margin-bottom: 20px;
               }

           }


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

        .autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9;
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important;
  color: #ffffff;
}

.menu_title{
  color: #7cda24;
  font-weight: bolder;
  font-size:16px !important;
}

.mega_large_image{
  width: 95%;
  height: 200px;
  object-fit: cover;
  display: inline-block;
  /*overflow: auto;*/
  border: 1px solid #6b7ec6;
  border-radius: 8px;
  margin-left:  20px;
    /*transition: transform .5s ease;*/
    /*transition: transform 5s, filter 3s ease-in-out;*/
  overflow: hidden
}

.mega_large_image:hover{
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
  /*transform: scale(1.5) rotate(2deg);*/
  filter: brightness(50%);
  border: 2px solid #f90;
}

.container_lg_img:hover .text-centered{
/*visibility : visible;*/
color: white;
 text-shadow: 2px 2px #000000;
}

.container_sm_img:hover .text-centered{
/*visibility : visible;*/
color: white;
 text-shadow: 2px 2px #000000;
}

.mega_small_image:hover{
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
  /*transform: scale(1.5) rotate(2deg);*/
    filter: brightness(40%);
  border: 2px solid #f90;
}

.text-centered {
  color: black;
  position: absolute;
  font-weight: bolder !important;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  white-space: nowrap;
 text-shadow: 2px 2px #cfcfcf;
}

.container_lg_img{
  /*overflow: hidden;  [1.2] Hide the overflowing of child elements */
  position: relative;
  margin-right: 20px;
  margin-bottom: 20px;
  cursor: pointer;
  /*box-shadow: rgba(0, 0, 0, 0.2) 3px 5px 5px;*/
}

.mega_small_image{
  width: 90%;
  height: 150px;
  object-fit: cover;
  display: inline-block;
  overflow: auto;
  margin: 15px;
  margin-left: 20px;
  border: 1px solid #6b7ec6;
  border-radius: 8px;
   /*transition: transform 5s, filter 3s ease-in-out;*/
}

.list-image{
 height: 100px !important;
}

.div_right{
  border-left: solid 1px #7cda24;
}

* {
    margin: 0;
    padding: 0;
}


.mail_icon_not{
      animation: beat .55s infinite alternate;
	  transform-origin: center;
  }
  
  @keyframes beat{
	to { transform: scale(1.4); }
}

.text-company{
 color:#7cda24 !important;   
}

.text-white{
    color:white !important;
}

body {
  font-family: 'Open Sans', 'sans-serif' !important;
  -webkit-font-smoothing:antialiased !important;
  background-color: whitesmoke !important;
}

.breadcrumb{
    background-color: none !important;
    background: none !important;
    margin-top:6px !important;
    margin-bottom:6px !important;
    color:black;
    list-style:none;
}

.breadcrumb i.fa-circle:before{
    content:" / " !important;
    color:black;
}

.breadcrumb .fa{
    font-size:16px !important;
    color:black !important;
    font-weight:bolder;
}

.breadcrumb a{
    color:black !important;
}

.breadcrumb span, .breadcrumb li:last-child{
    font-weight:bolder;
    color:#7cda24 !important;
}

.dropdown-menu-default > li{
    margin-top:10px !important;
    margin-bottom:5px !important;
}

.btn-primary{
    background-color:black !important;
    color:white !important;
}

.blue{
    background-color:black !important;
    color:white !important;
}

span.fa, i.fa{
    color:#7cda24 !important;
}

 .btn.blue:not(.btn-outline), .btn-primary{
        border-color: black !important;
    }
    
.btn.default{
    color:white !important;
    background:#484848 !important;
}

.form-control:focus {
        border-color: #7cda24 !important;
        /*box-shadow: 0 0 0 0.2rem #7cda24 !important;*/
}


option:hover {
  background-color: black !important;
  color:white !important;
}

.mega_small_image, .mega_large_image{
    border: 1px solid #7cda24 !important;
}

.badge-danger{
    background:red !important;
    font-weight:bold !important;
}
 .navbar-nav .open .dropdown-menu{
     position:absolute !important;
 }
 
 .page-footer{
     background-color:black !important;
     text-align: center;
     color:white;
 }
 
 .page-header-menu span{
     font-weight:600 !important;
 }
 
 .page-content-inner{
     border-radius:5px;
 }
 .btn.btn-outline.blue{
     border:1px solid black !important;
 }
 .page-header .page-header-menu .hor-menu .navbar-nav>li>a{
     font-weight:700 !important;
 }
 
 .btn{
     font-weight:bold !important;
 }
 
 .page-header .page-header-menu .hor-menu .navbar-nav>li.mega-menu-dropdown>.dropdown-menu .mega-menu-content .mega-menu-submenu li>a{
     font-weight:700 !important;
 }
 
 .page-header .page-header-top .top-menu .navbar-nav>li.dropdown-user .dropdown-menu>li>a{
     font-weight:700 !important;
     color:white !important;
 }
 
 .page-header .page-header-menu .hor-menu .navbar-nav>li .dropdown-menu li>a{
     font-weight:700 !important;
 }
     </style>

<!--Start of Tawk.to Script-->
<!--
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5bc03b2d61d0b770925118d4/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
-->
<!--End of Tawk.to Script-->

    <?php

    $user_id = Auth::id();
    $userType = App\User::validateAccountNavigations($user_id);
    $scope = "";
    ?>
    </head>

<?php 
                                                $build_pending = App\OpportunityBuildingCapability::where('is_verify', "0")->where('status', 1)->get();
                                        		$sell_pending = App\OpportunitySellOffer::where('is_verify', "0")->where('status', 1)->get();
                                        		$buy_pending = App\OpportunityBuy::where('is_verify', "0")->where('status', 1)->get();
                                        		
                                        		$merged = $build_pending->merge($sell_pending)->merge($buy_pending);
                                        		
                                        		$pending_count = "";
                                        		if($merged->count() > 0){
                                        		    $pending_count = $merged->count();
                                        		}
                                            ?>

    <body class="page-container-bg-solid">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                @if(auth()->check())
                <!-- START NAVIGATION HEADER AND NAVIGATION MENU -->
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <div class="page-header">
                        <!-- BEGIN HEADER TOP -->
                        <div class="page-header-top">
                            <div class="container">
                                <!-- BEGIN LOGO -->
                                <div class="page-logo">
                                    <a href="{{ route('login') }}" style="margin-top: 25px;">
                                        <img src="{{asset('public/img-resources/intellinz_green.png')}}" alt="Intellinz" id="logo" width="200px">
                                    </a>
                                </div>
                                <!-- END LOGO -->
                                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                                <a href="javascript:;" class="menu-toggler"></a>
                                <!-- END RESPONSIVE MENU TOGGLER -->
                                <!-- BEGIN TOP NAVIGATION MENU -->
                                <div class="top-menu">

                                        <?php
                                           if(App\User::securePage($user_id) == 2 || App\User::securePage($user_id) == 3){

                                            if(Session::get('SwitchedAccount') == '' &&  App\User::securePage($user_id) != 1) {
                                            ?>
                                                <form action="{{ route('switchAccount') }}" method="POST" class="btn">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="switch_type" value="to-company">
                                                <input type="submit" class="btn btn-danger" value="SWITCH TO COMPANY">
                                                </form>

                                            <?php } ?>

                                            <?php if(Session::get('SwitchedAccount') != '' &&  App\User::securePage($user_id) != 1) {

                                                ?>
                                                    <form action="{{ route('switchAccount') }}" method="POST" class="btn">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="switch_type" value="to-consultant">
                                                    <input type="submit" class="btn btn-danger" value="SWITCH TO CONSULTANT">
                                                    </form>
                                        <?php }
                                        }
                                        ?>


                                    <ul class="nav navbar-nav pull-right">
                                        <!-- BEGIN NOTIFICATION DROPDOWN -->

                                        <!-- BEGIN INBOX DROPDOWN -->
                                        <?php
                                        $noti = App\Mailbox::getEmailUnderNoti($user_id);
                                        
                                        $usr = App\User::find($user_id);
                                        
                                        if ($usr->user_type != 5 && $usr->user_type != 4) {
                                        
                                        ?>
                                        
                                        <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_chat_bar">
                                            <?php 
                                            $company_id_result = App\CompanyProfile::getCompanyId($user_id);
                                            
                                            if(isset($company_id_result)){
                                                $resBuild = App\ChatHistory::getChatHistoryBuildOpportunityUnseenTotal($company_id_result);
                                        		$resSell = App\ChatHistory::getChatHistorySellOpportunityUnseenTotal($company_id_result);
                                        		$resBuy = App\ChatHistory::getChatHistoryBuyOpportunityUnseenTotal($company_id_result);
                                        		$oppoInbox = (int) $resBuild + (int) $resSell + (int) $resBuy;
                                        		
                                        		if($oppoInbox == 0){
                                        		    $oppoInbox = "";
                                        		}
                                    		
                                    		?>
                                            <a href="{{ url('/opportunity/chatbox') }}" class="dropdown-toggle text-company" data-toggle="" data-hover="" data-close-others="">
                                                <i style="font-size:25px !important" class="fa fa-comments-o text-company"></i>
                                                <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $oppoInbox }}</span>
                                            </a>
                                            <?php } ?>
                                        </li>
                                        
                                        <?php } ?>
                                        
                                        <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                                            
                                            <a href="javascript:;" class="dropdown-toggle text-company" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                <i style="font-size:25px !important" class="icon-envelope text-company"></i>
                                                <span class="badge badge-danger counter counter-lg mail_icon_not"><?php echo App\Mailbox::getNumberEmailWithNoti($user_id);  ?></span>
                                            </a>

                                            <ul class="dropdown-menu" style="z-index:121423423423">
                                                <li class="external">
                                                    <h3>You have
                                                     <strong class="text-white"> <?php echo (App\Mailbox::getNumberEmailWithNoti($user_id) != null) ? App\Mailbox::getNumberEmailWithNoti($user_id) : "0"; ?> New</strong> Messages</h3>
                                                    <a class="text-company" href="{{ route('mailCompose')}}">VIEW ALL</a>
                                                </li>

                                                <li>
                                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                                        <?php
                                                        if($noti->count() > 0){
                                                             foreach($noti as $n){
                                                                 $noti_user = App\User::find($n->sender_id);
                                                               $noti_profilePic = App\CompanyProfile::getProfileImage($n->sender_id);
                                                        ?>
                                                        <li>
                                                            <a href="{{ url('/mailbox/setReply/'.$n->id) }}">
                                                                <span class="photo">
                                                             <?php       if($noti_profilePic != null){
                                                                    ?>
                                                                    <img src="{{ asset('public/images/') }}/<?php echo $noti_profilePic; ?>" class="img-circle" alt=""> </span>
                                                                    <?php } else { ?>
                                                                    <img src="{{ asset('public/images/robot.jpg') }}" class="img-circle" alt=""> </span>
                                                                    <?php }?>
                                                                    

                                                                <span  class="subject">
                                                                    <span  class="from text-company"><?php echo $noti_user->firstname . '  ' .$noti_user->lastname; ?> </span>
                                                                </span>
                                                                <span  class="message text-white"><?php echo $n->subject; ?> </span>
                                                            </a>
                                                        </li>
                                                       <?php
                                                               }
                                                        }
                                                         ?>

                                                    </ul>

                                                </li>
                                            </ul>
                                        </li>


                                        <!-- END INBOX DROPDOWN -->
                                        <!-- BEGIN USER LOGIN DROPDOWN -->
                                        <li id='nav-login-dropdown' style="z-index:1000011010101" class="dropdown dropdown-user dropdown-dark">
                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                <?php
                                                $main_profile_pic = "";
                                                
                                                if($userType == 1){
                                                    $profilePic = App\CompanyProfile::getProfileImage(Auth::id());
                                                    if($profilePic != null){
                                                        $main_profile_pic = $profilePic;
                                                    ?>
                                                    <img class="img-circle" alt="" src="{{ asset('public/images/') }}/<?php echo $profilePic; ?>">
                                                    <?php } else { 
                                                        $main_profile_pic = "robot.jpg";
                                                    ?>
                                                    <img  class="img-circle" alt="" src="{{ asset('public/images/robot.jpg') }}">
                                                    <?php }
                                                } else if($userType == 2){
                                                    $profilePicSC = App\CompanyProfile::getProfileImageSC(Auth::id());
                                                    if($profilePicSC != null){
                                                        $main_profile_pic = $profilePicSC;
                                                    ?>
                                                    <img  class="img-circle alt=" src="{{ asset('public/images/') }}/<?php echo $profilePicSC; ?>">
                                                    <?php } else {
                                                        $main_profile_pic = "robot.jpg";
                                                    ?>
                                                    <img  class="img-circle alt=" src="{{ asset('public/images/robot.jpg') }}">
                                                    <?php }
                                                } else if($userType == 3){
                                                    $profilePicMC = App\CompanyProfile::getProfileImageMC(Auth::id());
                                                    if($profilePicMC != null){
                                                        $main_profile_pic = $profilePicMC;
                                                    ?>
                                                    <img  class="img-circle" alt="" src="{{ asset('public/images/') }}/<?php echo $profilePicMC; ?>">
                                                    <?php } else { 
                                                        $main_profile_pic = "robot.jpg";
                                                    ?>
                                                    <img  class="img-circle" alt="" src="{{ asset('public/images/robot.jpg') }}">
                                                    <?php }
                                                }
                                                ?>

                                                <span style="color:black" class=" username username-hide-mobile"><?php
                                                $user_id = Auth::id();
                                                
                                                $usr = App\User::find($user_id);
                                                $accStatus = '';
                                                if ($usr->user_type == 1) {
                                                    if( App\SpentTokens::validateAccountActivation($company_id_result) == false ){
                                                        $accStatus = '(<b class="text-company">FREE</b> ACCOUNT)';   
                                                    } else{
                                                        $accStatus = '(<b class="text-company">PREMIUM</b> ACCOUNT)'; 
                                                    } 
                                                }
                
                                              echo App\CompanyProfile::getProfileFirstname(Auth::id()); ?> <?php echo $accStatus; ?></span>
                                            </a>
                                            <ul id="main_user_menu" class="dropdown-menu dropdown-menu-default">
                        <?php   
                                            $user_id = Auth::id();
                                            $u = App\User::find($user_id);
                        if($u->m_id == null || $u->m_id == 0){  
                                            ?>

                                                            <li id='nav-login-account-credit'>
                                                    <a href="{{ route('getTokenActivated') }}">
                                                        <i class="icon-wrench"></i> Manage Account </a>
                                                </li>   

                                                <li aria-haspopup="true" id="nav-buy-credit">
                                                    <a href="{{ url('/reports/buyCredits') }}" class="nav-link  "><i class="fa fa-dollar" style="color: #7cda24"></i> Buy Credits</a>
                                                </li>

                                                <li id='nav-login-company'>

                                                    <a href="{{ route('viewingProfile') }}">
                                                        <i class="icon-user" style="color: #7cda24"></i> My Company </a>
                                                </li>


                                                <li id="nav-login-inbox">
                                                    <a href="{{ route('mailCompose') }}">
                                                        <i class="icon-envelope-open"></i> My Inbox
                                                        <?php
                                                        $inboxCount = App\Mailbox::getNumberEmailWithNoti($user_id);
                                                        if($inboxCount > 0){
                                                        ?>
                                                        <span class="badge badge-danger"> <?php echo $inboxCount; ?> </span>
                                                        <?php } ?>
                                                    </a>
                                                </li>

                                                <li id='nav-login-switch-company'>

                                                    <a href="{{ route('viewingProfile') }}"  data-popup-open="popup-company" >
                                                        <i class="icon-list"></i> Switch a Company </a>
                                                </li>

                                                <li id='nav-login-referral'>

                                                    <a href="{{ route('referralsList') }}" >
                                                        <i class="icon-rocket"></i> Referrals </a>
                                                </li>

                                                <li id='nav-login-share-friend'>

                                                    <a href="{{ route('createReferals') }}" >
                                                        <i class="icon-heart"></i> Share to Friend </a>
                                                </li>

                                                <li id='nav-login-rewards'>

                                                  <a href="{{ route('CompanyCreditPoints') }}" >
                                                      <i class="fa fa-trophy"></i> Rewards </a>
                                              </li>

                                                <li id="nav-change-pass">

                                                  <a href="{{ route('setPasswordData') }}" >
                                                      <i class="icon-key"></i> Change Password </a>
                                                </li>

                                                <li id="nav-currency">
                                                    <?php 
                                                    if($currentCurrency = App\CurrencyAccounts::where('user_id',$user_id)->first()){
                                                        $currentCurrency = $currentCurrency->getCurrency->c_code;
                                                    }else{
                                                        //default USD = 3
                                                        $currentCurrency = App\CurrencyMonetary::find(3)->c_code;
                                                    }
                                                    ?>
                                                  <a data-toggle="modal" data-target="#myModal-currency"  >
                                                      <i class="fa fa-dollar"></i> Currency ( {{ $currentCurrency }} )</a>
                                                </li>

                                                <li class="divider"> </li>
                                                <li id='nav-login-tour'>
                                                  <?php 
                                                        $scope = "-";
                                                        $tour = App\TourDetail::where('user_id',  $user_id)->first();
                                                        if(request()->segment(1) == 'home' ){
                                                            $scope = 'home';
                                                        }else{
                                                            $scope = request()->segment(1)."/".request()->segment(2);
                                                        }
                     
                                                  ?>
                                                  @if( isset($tour->scope) AND strpos($tour->scope , $scope) !== false )
                                                    <input type="hidden" id="is_tour" value="0">
                                                    <a onclick='updateTour()' href="#">
                                                        <i  class="fa fa-toggle-on"></i> Tour (OFF)
                                                    </a>
                                                  @else
                                                   <input type="hidden" id="is_tour" value="1">
                                                   <a onclick='updateTour()' href="#">
                                                        <i  class="fa fa-toggle-off"></i> Tour (ON)
                                                    </a>
                                                  @endif
                                                </li>

                                                <li id="nav-user-control">
                                                  <a href="{{ route('setSubaccounts') }}" >
                                                      <i class="icon-user" style="color: #7cda24"></i> User Control </a>
                                                </li>
                        <?php } ?>

                                                <li id='nav-login-logout'>
                                                    <a href="{{ url('logout') }}">
                                                        <i class="icon-building-o" style="color: #7cda24"></i> Log Out </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- END USER LOGIN DROPDOWN -->
                                    </ul>
                                </div>
                                <!-- END TOP NAVIGATION MENU -->
                            </div>
                        </div>
                        <!-- END HEADER TOP -->
                        <!-- BEGIN HEADER MENU -->
                        <div class="page-header-menu" style="height:100%">
                            <div class="container">
                                <!-- BEGIN HEADER SEARCH BOX -->
                                <form id="search_box" class="search-form" action="{{ route('searchByCompany') }}" method="GET">
                                {{ csrf_field() }}
                                    <div class="input-group">

                                        <input type="text" title="Click on the magnifier icon to submit search" style="background:white; font:strong;" class="form-control" placeholder="Search company..." name="seach_entry_key" id="seach_entry_key">
                                        <span class="input-group-btn" style="background:white;">
                                            <a href="javascript:;" class="btn submit " title="After selecting an item, you may press enter in the keyboard or click on the magnifier icon to submit search">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </span>

                                    </div>
                                </form>

                         <!-- END HEADER SEARCH BOX -->
                                <!-- BEGIN MEGA MENU -->
                                <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                                <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->

                                <div class="hor-menu  ">
                                    <ul class="nav navbar-nav">
                                        <li aria-haspopup="true" id="nav-home-page" class="menu-dropdown classic-menu-dropdown {{(request()->segment(1) == 'home') ? 'active' : '' }}">
                                            @guest
                                                <a class="navbar-brand" href="{{ route('login') }}">
                                                    <i class="fa fa-home" style="color: #7cda24"></i>  Home
                                                    <span class="arrow"></span>
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}">
                                                    <i class="fa fa-home" style="color: #7cda24"></i>  Home
                                                    <span class="arrow"></span>
                                                </a>

                                        </li>
                                      <?php if($userType == 1){  ?>


                                        <li aria-haspopup="true" id='nav-system-dashboard' class=" menu-dropdown mega-menu-dropdown {{(request()->segment(1) == 'dashboard') ? 'active' : '' ||
                                        (request()->segment(1) == 'businessnews') ? 'active' : '' || (request()->segment(1) == 'alertedRecords') ? 'active' : ''}}  ">
                                            <a href="{{ route('dashboard') }}">
                                                <i class=" fa fa-dashboard" style="color: #7cda24"></i>Dashboard
                                                <span class="arrow"></span>
                                                </a>
                                            <ul class="dropdown-menu" style="min-width: 710px">
                                                <li>
                                                    <div class="mega-menu-content">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                              <h4 class="menu_title"> Dashboard </h4>
                                                                <ul class="mega-menu-submenu">
                                                        <li aria-haspopup="true" id="nav-business-news">
                                                               <a href="{{ url('/businessnews/list') }}" class="nav-link  ">
                                                               <i class="icon-bulb" style="color: #7cda24"></i> Business News</a>
                                                        </li>

                                                        <li aria-haspopup="true" id="nav-investor-alert-list">
                                                               <a href="{{ url('/alertedRecords') }}" class="nav-link  ">
                                                               <i class="icon-magnifier" style="color: #7cda24"></i> Investor Alert List</a>
                                                        </li>
                                                        
                                                        <li aria-haspopup="true" id="nav-high-risk-list">
                                                               <a href="<?php echo env("APP_URL"); ?>/highRisk/panama" class="nav-link  ">
                                                               <i class="icon-magnifier" style="color: #7cda24"></i> High Risk Profile</a>
                                                        </li>
                                                </ul>
                                                            </div>

                                                            <div class="col-md-9 div_right"  >
                                                              <h4 class="menu_title"> Popular Categories </h4>
                                                              <div class="mega-menu-submenu col-md-12 container_lg_img">
                                                                <a href="{{ route('opportunityExploreIndex') }}">
                                                                  <img class="mega_large_image" src="{{ asset('public/banner/explore_oppo.png') }}" alt="Top Up" />
                                                                  <div class="text-centered" >
                                                                    <h3 class="text-centered">Explore Opportunities</h3>
                                                                  </div>
                                                                </a>
                                                              </div>
                                                              <div class="mega-menu-submenu col-md-4 container_sm_img">
                                                                <a href="{{ route('reportsBuyTokens') }}">
                                                                  <img class="mega_small_image" src="{{ asset('public/banner/top_up.png') }}" alt="Top Up" />
                                                                  <div class="text-centered" >
                                                                  <h4 class="text-centered">Top Up</h4>
                                                                  </div>
                                                                </a>
                                                              </div>

                                                              <div class="mega-menu-submenu col-md-4 container_sm_img">
                                                                <a href="{{ route('viewingProfile') }}">
                                                                  <img class="mega_small_image" src="{{ asset('public/banner/view_profile.png') }}" alt="Top Up" />
                                                                  <div class="text-centered" >
                                                                    <h4 class="text-centered">View Profile</h4>
                                                                  </div>
                                                                </a>
                                                              </div>

                                                              <div class="mega-menu-submenu col-md-4 container_sm_img">
                                                                <a href="{{ route('businessnewsList') }}">
                                                                  <img class="mega_small_image" src="{{ asset('public/banner/business_news.png') }}" alt="Top Up" />
                                                                  <div class="text-centered" >
                                                                    <h4 class="text-centered">Business News</h4>
                                                                  </div>
                                                                </a>
                                                              </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>

                                        <li aria-haspopup="true" id="company-nav" class="menu-dropdown mega-menu-dropdown {{ (request()->segment(2) == 'view') ? 'active' : '' ||
                                        (request()->segment(2) == 'edit') ? 'active' : '' ||
                                        (request()->segment(2) == 'contacts') ? 'active' : '' ||
                                        (request()->segment(2) == 'billing') ? 'active' : '' ||
                                        (request()->segment(2) == 'paymentHistory') ? 'active' : '' ||
                                        (request()->segment(2) == 'deactivatePage') ? 'active' : '' }}">

                                            <a  href="#">
                                                <i class="fa fa-user" style="color: #7cda24"></i> Company <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" >
                                                    <a class="nav-link" href="{{ url('/profile/view') }}"> <i class="fa fa-video-camera" style="color: #7cda24"></i> View Company</a>
                                                </li>
                                                <li aria-haspopup="true" class="company-edit">
                                                        <a class="nav-link" href="{{ url('/profile/edit') }}"> <i class="fa fa-edit" style="color: #7cda24"></i> Edit Company</a>
                                                </li>
                                                <li aria-haspopup="true" class="company-edit">
                                                        <a class="nav-link" href="{{ url('/company/goXeroAnalytics') }}"> <i class="fa fa-bar-chart" style="color: #7cda24"></i> Xero Analytics</a>
                                                </li>
                                                <li aria-haspopup="true" class="company-contact">
                                                    <a href="{{ url('/profile/contacts') }}" class="nav-link "><i class="fa fa-phone-square" style="color: #7cda24"></i> Contacts </a>
                                                </li>
                                               <!-- <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/profile/billing') }}" class="nav-link  "><i class="fa fa-money" style="color:white;"></i> Billing</a>
                                                </li> -->
                                                <li aria-haspopup="true" class="company-payment">
                                                    <a href="{{ url('/profile/paymentHistory') }}" class="nav-link"><i class="fa fa-cc-paypal" style="color: #7cda24"></i> Payments History</a>
                                                </li>
                                                <!--<li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/profile/socialAccounts') }}" class="nav-link"> <i class="fa fa-facebook-official" style="color: #7cda24"></i> Social Media Accounts</a>
                                                </li> -->
                                                <li aria-haspopup="true" class="company-deactivate">
                                                    <a href="{{ url('/profile/deactivatePage') }}" class="nav-link  "><i class="fa fa-warning" style="color: red !important;"></i> Deactivate Company</a>
                                                </li>
                                            </ul>

                                            <ul class="dropdown-menu" style="min-width: 710px">
                                              <li>
                                                  <div class="mega-menu-content">
                                                      <div class="row">
                                                          <div class="col-md-3">
                                                            <h4 class="menu_title"> Company </h4>
                                                              <ul class="mega-menu-submenu">
                                                                <li aria-haspopup="true" id="nav-company-view">
                                                                    <a class="nav-link" href="{{ url('/profile/view') }}"> <i class="fa fa-video-camera" style="color: #7cda24"></i> View Company</a>
                                                                </li>
                                                                <li aria-haspopup="true" id="nav-company-edit">
                                                                        <a class="nav-link" href="{{ url('/profile/edit') }}"> <i class="fa fa-edit" style="color: #7cda24"></i> Edit Company</a>
                                                                </li>
                                                                <li aria-haspopup="true" class="company-edit">
                                                        <a class="nav-link" href="{{ url('/company/goXeroAnalytics') }}"> <i class="fa fa-bar-chart" style="color: #7cda24"></i> Xero Analytics</a>
                                                </li>
                                                                <li aria-haspopup="true" id="nav-company-contact">
                                                                    <a href="{{ url('/profile/contacts') }}" class="nav-link "><i class="fa fa-phone-square" style="color: #7cda24"></i> Contacts </a>
                                                                </li>
                                                               <!-- <li aria-haspopup="true" class=" ">
                                                                    <a href="{{ url('/profile/billing') }}" class="nav-link  "><i class="fa fa-money" style="color:white;"></i> Billing</a>
                                                                </li> -->
                                                                <li aria-haspopup="true" id="nav-company-payment">
                                                                    <a href="{{ url('/profile/paymentHistory') }}" class="nav-link"><i class="fa fa-cc-paypal" style="color: #7cda24"></i> Payments History</a>
                                                                </li>
                                                                <!--<li aria-haspopup="true" class=" ">
                                                                    <a href="{{ url('/profile/socialAccounts') }}" class="nav-link"> <i class="fa fa-facebook-official" style="color: #7cda24"></i> Social Media Accounts</a>
                                                                </li> -->
                                                                <li aria-haspopup="true" id="nav-company-deactivate">
                                                                    <a href="{{ url('/profile/deactivatePage') }}" class="nav-link  "><i class="fa fa-warning" style="color: red !important;"></i> Deactivate Company</a>
                                                                </li>
                                                              </ul>
                                                          </div>
                                                          <div class="col-md-9 div_right"  >
                                                            <h4 class="menu_title"> Popular Categories </h4>
                                                            <div class="mega-menu-submenu col-md-12 container_lg_img">
                                                              <a href="{{ route('opportunityExploreIndex') }}">
                                                                  <img class="mega_large_image" src="{{ asset('public/banner/explore_oppo.png') }}" alt="Top Up" />
                                                                  <div class="text-centered" >
                                                                    <h4 class="text-centered">Explore Opportunities</h4>
                                                                </div>
                                                              </a>
                                                            </div>
                                                            <div class="mega-menu-submenu col-md-4 container_sm_img">
                                                              <a href="{{ route('reportsBuyTokens') }}">
                                                                  <img class="mega_small_image" src="{{ asset('public/banner/top_up.png') }}" alt="Top Up" />
                                                                  <div class="text-centered" >
                                                                  <h4 class="text-centered">Top Up</h4>
                                                                </div>
                                                              </a>
                                                            </div>

                                                            <div class="mega-menu-submenu col-md-4 container_sm_img">
                                                              <a href="{{ route('viewingProfile') }}">
                                                                  <img class="mega_small_image" src="{{ asset('public/banner/view_profile.png') }}" alt="Top Up" />
                                                                  <div class="text-centered" >
                                                                    <h4 class="text-centered">View Profile</h4>
                                                                </div>
                                                              </a>
                                                            </div>

                                                            <div class="mega-menu-submenu col-md-4 container_sm_img">
                                                              <a href="{{ route('businessnewsList') }}">
                                                                  <img class="mega_small_image" src="{{ asset('public/banner/business_news.png') }}" alt="Top Up" />
                                                                  <div class="text-centered" >
                                                                    <h4 class="text-centered">Business News</h4>
                                                                </div>
                                                              </a>
                                                            </div>

                                                          </div>
                                                      </div>
                                                  </div>
                                              </li>
                                            </ul>

                                        </li>
                                        <li aria-haspopup="true" id='nav-opportunities' class="menu-dropdown mega-menu-dropdown {{(request()->segment(1) == 'opportunity') ? 'active' : '' ||
                                        (request()->segment(2) == 'explore') ? 'active' : ''}}">
                                        <?php 
                                            $user_id = Auth::id();
                                            $company_id = App\CompanyProfile::getCompanyId($user_id);

                                                $build_list = App\OpportunityBuildingCapability::where('company_id', '!=', $company_id)
                                                ->where('status', 1)->where('is_verify', 1)
                                                ->orderBy('updated_at','desc')
                                                ->get();

                                                $sell_list = App\OpportunitySellOffer::where('company_id', '!=', $company_id)
                                                ->where('status', 1)->where('is_verify', 1)
                                                ->orderBy('updated_at','desc')
                                                ->get();

                                                $buy_list = App\OpportunityBuy::where('company_id', '!=', $company_id)
                                                ->where('status', 1)->where('is_verify', 1)
                                                ->orderBy('updated_at','desc')
                                                ->get();

                                            $getRequestReportByUser = App\RequestReport::getRequestReportByUser();

                                        ?>
                                            <a href="#">
                                                <i class=" fa fa-lightbulb-o" style="color: #7cda24"></i> Opportunities
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu" style="max-width: 810px">
                                              <li>
                                                  <div class="mega-menu-content">
                                                      <div class="row">
                                                          <div class="col-md-4">
                                                            <h4 class="menu_title"> Opportunities </h4>
                                                              <ul class="mega-menu-submenu">
                                                <li aria-haspopup="true" id="nav-my-opportunities">
                                                                        <a  href="{{ url('/opportunity') }}" class="nav-link  ">
                                                                          <i class="icon-bulb" style="color: #7cda24"></i> My Opportunities 
                                                                        </a>
                                                </li>

                                                <li aria-haspopup="true" id="nav-explore">
                                                                      <a href="{{ url('/opportunity/explore') }}" class="nav-link  ">
                                                                        <i class="icon-magnifier" style="color: #7cda24"></i> Explore
                                                                      </a>
                                                                  </li>
                                                              </ul>

                                                          </div>

                                                          <div class="col-md-8 div_right"  >
                                                            <h5 class="menu_title"> Build Opportunity </h5>
                                                            <?php 
                                                              $build_count = 0;
                                                              if($build_list):
                                                              foreach ($build_list as $item):
                                                                if($build_count < 3):
                                                                  $d_status = App\CompanyProfile::getDeactivateInfo($item->company_id);
                                                                  $company = App\CompanyProfile::find($item->company_id);
                                                                  if ( $company->count() > 0 && $d_status == true):
                                                                  $industryImage = App\OppIndustry::find($item->industry);

                                                                  if($industryImage){
                                                                      $avatarName = $industryImage->image;
                                                                      $avatarUrl = asset('public/images/industry')."/".$avatarName;
                                                                    } else {
                                                                      $avatarUrl = asset('public/images/industry')."/guest.png";
                                                                    }

                                                                  $build_count++;
                                                            ?>
                                                            <div class="mega-menu-submenu col-md-4 container_sm_img" 
                                                                        {{-- title="<?=$item->opp_title?>" --}}
                                                                        title="<?=$item->opp_title?>"
                                                                        data-toggle="popover" 
                                                                        data-trigger="hover"
                                                                        data-content="<?=$item->business_goal?>"
                                                                        data-placement="left">
                                                              <a href="{{ route('opportunityExploreIndex')."?type=build&ids=".$item->id }}" >
                                                                <img class="mega_small_image list-image" alt="profile image" 
                                                                  src="{{ $avatarUrl }}">
                                                              </a>
                                                            </div>
                                                            <?php 
                                                                endif;
                                                                endif;
                                                              endforeach;
                                                          endif;
                                                            ?>


                                                            <h5 class="menu_title"> Sell Opportunity </h5>
                                                            <?php 
                                                              $sell_count = 0;
                                                              if($sell_list):
                                                              foreach ($sell_list as $item):
                                                                if($sell_count < 3):
                                                                  $d_status = App\CompanyProfile::getDeactivateInfo($item->company_id);
                                                                  $company = App\CompanyProfile::find($item->company_id);
                                                                  if (count((array) $company) - 1 > 0 && $d_status == true):
                                                                  $industryImage = App\OppIndustry::find($item->industry);

                                                                  if($industryImage){
                                                                      $avatarName = $industryImage->image;
                                                                      $avatarUrl = asset('public/images/industry')."/".$avatarName;
                                                                    } else {
                                                                      $avatarUrl = asset('public/images/industry')."/guest.png";
                                                                    }
                                                                  $sell_count++;
                                                            ?>
                                                            <div class="mega-menu-submenu col-md-4 container_sm_img" 
                                                                        title="<?=$item->opp_title?>"
                                                                        data-toggle="popover" 
                                                                        data-trigger="hover"
                                                                        data-content="<?=$item->business_goal?>"
                                                                        data-placement="left">
                                                              <a href="{{ route('opportunityExploreIndex')."?type=sell&ids=".$item->id }}" >
                                                                <img class="mega_small_image list-image" alt="profile image" 
                                                                  src="{{ $avatarUrl }}">
                                                              </a>
                                                            </div>
                                                            <?php 
                                                                endif;
                                                                endif;
                                                              endforeach;
                                                            endif;
                                                            ?>
                                                            <h5 class="menu_title"> Buy Opportunity </h5>
                                                            <?php 
                                                              $buy_count = 0;
                                                              if($buy_list ):
                                                              foreach ($buy_list as $item):
                                                                if($buy_count < 3):
                                                                  $d_status = App\CompanyProfile::getDeactivateInfo($item->company_id);
                                                                  $company = App\CompanyProfile::find($item->company_id);
                                                                  if (count((array) $company) > 0 && $d_status == true):
                                                                    $industryImage = App\OppIndustry::find($item->industry);

                                                                    if($industryImage){
                                                                        $avatarName = $industryImage->image;
                                                                        $avatarUrl = asset('public/images/industry')."/".$avatarName;
                                                                    } else {
                                                                        $avatarUrl = asset('public/images/industry')."/guest.png";
                                                                    }
                                                                  $buy_count++;
                                                            ?>
                                                            <div class="mega-menu-submenu col-md-4 container_sm_img" 
                                                                        title="<?=$item->opp_title?>"
                                                                        data-toggle="popover" 
                                                                        data-trigger="hover"
                                                                        data-content="<?=$item->business_goal?>"
                                                                        data-placement="left">
                                                              <a href="{{ route('opportunityExploreIndex')."?type=buy&ids=".$item->id }}" >
                                                                  <img class="mega_small_image list-image" alt="profile image" 
                                                                  src="{{ $avatarUrl }}">
                                                              </a>
                                                            </div>
                                                            <?php 
                                                                endif;
                                                                endif;
                                                              endforeach;
                                                              endif;
                                                            ?>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </li>
                                            </ul>

                                        </li>
                                        <li aria-haspopup="true" id='nav-report' class="menu-dropdown mega-menu-dropdown {{(request()->segment(2) == 'status') ? 'active' : '' ||
                                        (request()->segment(2) == 'list') ? 'active' : '' ||
                                        (request()->segment(2) == 'buyCredits') ? 'active' : '' ||
                                        (request()->segment(2) == 'requesters') ? 'active' : ''}}">

                                            <a href="#">
                                                <i class="fa fa-file-text-o" style="color: #7cda24"></i> Report
                                                
                                                <?php 
                                                    $process_count = App\RequestReport::getRecordsProcessedCount($company_id_result);
                                                    
                                                    if($process_count > 0){
                                                ?>
                                                <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $process_count }}</span>
                                                
                                                <?php } ?>
                                            </a>

                                            <ul class="dropdown-menu" style="min-width: 710px">
                                                <li>
                                                    <div class="mega-menu-content">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                              <h4 class="menu_title"> Report </h4>
                                                                <ul class="mega-menu-submenu">
                                                <li aria-haspopup="true" id="nav-report-status">
                                                    <a href="{{ url('/reports/status') }}" class="nav-link  "><i class="icon-hourglass" style="color: #7cda24"></i> Report Status
                                                        <?php 
                                                            if($process_count > 0){
                                                        ?>
                                                        <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $process_count }}</span>
                                                        
                                                        <?php } ?>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" id="nav-ongoing-monitoring">
                                                    <a href="{{ url('/monitoring/list') }}" class="nav-link  "><i class="icon-eye" style="color: #7cda24"></i> Ongoing Monitoring </a>
                                                </li>
<!--                                                 <li aria-haspopup="true" id="nav-buy-credit">
                                                    <a href="{{ url('/reports/buyCredits') }}" class="nav-link  "><i class="fa fa-dollar" style="color: #7cda24"></i> Buy Credits</a>
                                                </li> -->

                                                <li aria-haspopup="true" id="nav-report-requester">
                                                    <a href="{{ url('/reports/requesters') }}" class="nav-link  "><i class="fa fa-user" style="color: #7cda24;"></i> Report Requesters </a>
                                                </li>
                                                                </ul>
                                                            </div>

                                                            <div class="col-md-8 div_right"  >
                                                              <h5 class="menu_title"> Top Advisors </h5>
                                                            <?php
                                                            $report_count = 0;
                                                            if($getRequestReportByUser):
                                                            foreach( $getRequestReportByUser as $val ):
                                                              if($report_count < 10):
                                                                $viewer = base64_encode('viewer' . $val->company_id);
                                                                $token = base64_encode(date('YmdHis'));
                                                                $company_id_result = App\CompanyProfile::getCompanyId(Auth::id());
                                                                $report_count++; 
                                                            ?>
                                                              <div class="mega-menu-submenu col-md-3 container_sm_img" 
                                                                        title="<?=$val->company_name?>"
                                                                        data-toggle="popover" 
                                                                        data-trigger="hover"
                                                                        data-content="<?=$val->lastname.", ".$val->firstname." (".$val->total_count.")" ?>"
                                                                        data-placement="left">
                                                                @if( $build_list->where('view_type','2') OR $sell_list->where('view_type','2') OR $buy_list->where('view_type','2') )
                                                                  @if(App\SpentTokens::validateLeftBehindToken($company_id_result) != false && App\SpentTokens::validateLeftBehindToken($val->company_id) != false)
                                                                      <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$val->company_id.'/'.$val->id.'/'.$token) }}">
                                                                          <img class="mega_small_image list-image" src="{{ asset('public/banner/28_1583997690_smallPlant.jpeg') }}" alt="Top Up" />
                                                                      </a>
                                                                  @else
                                                                      <a href="#" onclick="encourageToPremiumMenu();" > 
                                                                        <img class="mega_small_image list-image" src="{{ asset('public/banner/28_1583997690_smallPlant.jpeg') }}" alt="Top Up" />
                                                                    </a>
                                                                  @endif
                                                                @else
                                                                  @if(App\SpentTokens::validateLeftBehindToken($val->company_id) == false 
                                                                  && App\SpentTokens::validateLeftBehindToken($company_id_result) != false)
                                                                      <a href="#" onclick="checkAlertByPremiumMenu('<?php echo $val->company_id; ?>', '<?php echo $company_id_result; ?>');">
                                                                  <img class="mega_small_image list-image" src="{{ asset('public/banner/28_1583997690_smallPlant.jpeg') }}" alt="Top Up" />
                                                                </a>
                                                                  @endif
                                                                @endif
                                                              </div>
                                                            <?php 
                                                              endif;
                                                            endforeach;
                                                            endif;
                                                            ?>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                        </li>
                                        @if(request()->segment(2) == 'explore')
                                        <li aria-haspopup="true" id='create-opportunities' class="menu-dropdown mega-menu-dropdown">
                                            <a href="{{ url('/opportunity/select') }}">
                                                <i class="fa fa-plus" style="color: #7cda24"></i> Create an Opportunity
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                        @endif
                                        <?php } elseif($userType == 2) { ?>

                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                <a  href="{{ url('/homeSubConsul') }}" >
                                                    <i class="icon-grid" style="color: #7cda24"></i><span class=""> Dashboard</span>
                                                    <span class="arrow"></span>
                                                </a>

                                                 <ul class="dropdown-menu pull-left">
                                                    <li aria-haspopup="true" class=" ">
                                                        <a  href="{{ url('/accounts') }}" class="nav-link  "> <i class="fa fa-users" style="color: #7cda24"></i> View All Accounts </a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                            <a  href="{{ url('/company/companychart?type=primary_country') }}" class="nav-link  "> <i class="fa fa-bar-chart"></i> Company Charts </a>
                                                        </li>
                                                </ul>
                                            </li>

                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                <a href="{{ url('/consultants/viewprofile') }}" >
                                                    <i class="icon-user" style="color: #7cda24"></i> <span class=""> Profile</span> <span class="arrow"></span>
                                                </a>

                                                <ul class="dropdown-menu pull-left">
                                                    <li aria-haspopup="true" class=" ">
                                                        <a  href="{{ url('/consultants/viewprofile') }}" class="nav-link  "> <i class="icon-camcorder" style="color: #7cda24"></i> View Profile </a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/editprofile') }}" class="nav-link  "> <i class="icon-note" style="color: #7cda24"></i> Edit Profile </a>
                                                    </li>

                                                  <!--  <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/billing') }}" class="nav-link  "> <i class="icon-map"></i> Billing </a>
                                                    </li> -->

                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/commission') }}" class="nav-link  "> <i class=" icon-layers" style="color: #7cda24"></i> Commission History </a>
                                                    </li>

                                                </ul>

                                            </li>
                                            

                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                                
                                                <?php 
                                                
                                                    $crcount = App\ConsultantProjects::where('assigned_consultant_id', Auth::id())->where('project_status', 'PENDING')->count();
                                                    $corcount = App\ConsultantProjects::where('assigned_consultant_id', Auth::id())->where('project_status', 'ONGOING')->count();
                                                    
                                                    $cmain_count = ($crcount + $corcount);
                                                    
                                                    if($crcount <= 0){
                                                        $crcount = "";
                                                    }
                                                    
                                                    if($corcount <= 0){
                                                        $corcount = "";
                                                    }
                                                    
                                                    if($cmain_count <= 0){
                                                        $cmain_count = "";
                                                    }
                                                    
                                                
                                                ?>

                                                <a href="" >
                                                    <i class="icon-notebook" style="color: #7cda24"></i>  <span class=""> Reports <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $cmain_count }}</span></span>
                                                    <span class="arrow"></span>
                                                </a>

                                                <ul class="dropdown-menu pull-left">
                                                    <li aria-haspopup="true" class=" ">
                                                        <a  href="{{ url('/consultants/pending-projects') }}" class="nav-link  "> <i class="icon-pin" style="color: #7cda24"></i> Pending Reports <?php if($crcount != ""){ ?> <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $crcount }}</span>  <?php } ?></a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/ongoing-projects') }}" class="nav-link  ">  <i class="icon-target" style="color: #7cda24"></i> On-Going Reports <?php if($corcount != ""){ ?> <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $corcount }}</span>  <?php } ?></a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/archived-projects') }}" class="nav-link  "> <i class="icon-briefcase" style="color: #7cda24"></i> Archived Reports</a>
                                                    </li>

                                                </ul>

                                            </li>
                                            
                                    

                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="{{ url('/opportunity/explore') }}">
                                                <i class="icon-layers" style="color: #7cda24"></i> <span class="">Opportunities 
                                                <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $pending_count }}</span></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                              <li aria-haspopup="true" class=" ">
                                                <a href="{{url('/opportunity/details')}}" class="nav-link  ">
                                                    Opportunity Details</a>
                                               </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/opportunity/approval/pending')}}" class="nav-link  ">
                                                    Pending Opportunities 
                                                    <?php if($pending_count != ""){ ?>
                                                    <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $pending_count }}</span>
                                                    <?php } ?>
                                                    </span></a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/opportunity/approval/approved')}}" class="nav-link  ">
                                                    Approved Opportunities</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/opportunity/opportunitychart')}}" class="nav-link  ">
                                                    Opportunity Chart</a>
                                                </li>
                                            </ul>
                                        </li>
                                        

                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="#">
                                                <i class="icon-layers" style="color: #7cda24"></i> <span class="">Business News</span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/businessnews/approval/pending')}}" class="nav-link  ">
                                                    Pending Business News</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/businessnews/approval/approved')}}" class="nav-link  ">
                                                    Approved Business News</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/businessnews/approval/rejected')}}" class="nav-link  ">
                                                    Rejected Business News</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <?php }elseif($userType == 3){ ?>

                                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                    <a href="{{ url('/home') }}" >
                                                        <i class="icon-grid" style="color: #7cda24"></i> Dashboard
                                                        <span class="arrow"></span>
                                                    </a>
                                                    <ul class="dropdown-menu pull-left">
                                                        <li aria-haspopup="true" class=" ">
                                                            <a  href="{{ url('/accounts') }}" class="nav-link  "> <i class="fa fa-users"></i> View All Accounts </a>
                                                        </li>
                                                        <li aria-haspopup="true" class=" ">
                                                            <a  href="{{ url('/company/companychart?type=primary_country') }}" class="nav-link  "> <i class="fa fa-bar-chart"></i> Company Charts </a>
                                                        </li>
                                                    </ul>
                                                </li>

                                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                    <a href="{{ url('/opportunity') }}" >
                                                        <i class="icon-user" style="color: #7cda24"></i> Profile
                                                        <span class="arrow"></span>
                                                    </a>

                                                    <ul class="dropdown-menu pull-left">
                                                            <li aria-haspopup="true" class=" ">
                                                                    <a  href="{{ route('viewProfileMC') }}" class="nav-link  "> <i class="icon-camcorder" style="color: #7cda24"></i> View Profile </a>
                                                                </li>
                                                                <li aria-haspopup="true" class=" ">
                                                                    <a href="{{ route('editProfileMC') }}" class="nav-link  "> <i class="icon-note" style="color: #7cda24"></i> Edit Profile </a>
                                                                </li>
                                                    </ul>

                                                </li>

                                                <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                                        <a href="{{ url('/opportunity/explore') }}">
                                                            <i class="icon-layers" style="color: #7cda24"></i> <span class="">Opportunities
                                                                <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $pending_count }}</span></span>
                                                            </span>
                                                        </a>
                                                        <ul class="dropdown-menu pull-left">
                                                          <li aria-haspopup="true" class=" ">
                                                            <a href="{{url('/opportunity/details')}}" class="nav-link  ">
                                                                Opportunity Details</a>
                                                           </li>
                                                            <li aria-haspopup="true" class=" ">
                                                                <a href="{{url('/opportunity/approval/pending')}}" class="nav-link  ">
                                                                Pending Opportunities 
                                                                <?php if($pending_count != ""){ ?>
                                                                <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $pending_count }}</span>
                                                                <?php } ?>
                                                                </span></a>
                                                            </li>
                                                            <li aria-haspopup="true" class=" ">
                                                                <a href="{{url('/opportunity/approval/approved')}}" class="nav-link  ">
                                                                Approved Opportunities</a>
                                                            </li>
                                                            <li aria-haspopup="true" class=" ">
                                                                <a href="{{url('/opportunity/opportunitychart')}}" class="nav-link  ">
                                                                Opportunity Chart</a>
                                                            </li>
                                                        </ul>
                                                    </li>

                                       <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="#">
                                                <i class="icon-layers" style="color: #7cda24"></i> <span class="">Rewards</span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/rewards/approval/pending')}}" class="nav-link  ">
                                                    Pending Rewards</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/rewards/approval/approved')}}" class="nav-link  ">
                                                    Approved Rewards</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="#">
                                                <i class="icon-layers" style="color: #7cda24"></i> <span class="">Business News</span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/businessnews/approval/pending')}}" class="nav-link  ">
                                                    Pending Business News</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/businessnews/approval/approved')}}" class="nav-link  ">
                                                    Approved Business News</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/businessnews/approval/rejected')}}" class="nav-link  ">
                                                    Rejected Business News</a>
                                                </li>
                                            </ul>
                                        </li>

                                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                                    
                                                    <?php 
                                                    
                                                    $rcount = App\RequestApproval::select('request_approval.id')
                                                        ->leftJoin('consultant_project as b','b.request_approval_id','=','request_approval.id')
                                                        ->where("main_consultant", "=", Auth::id())
                                                        ->whereNull('b.id')->count();
                                                        
                                                    if($rcount <= 0){
                                                        $rcount = "";
                                                    }
                                                    
                                                    ?>

                                                    <a  href="{{ url('/') }}" >
                                                        <i class="icon-notebook" style="color: #7cda24"></i>  Reports <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $rcount }}</span>
                                                        <span class="arrow"></span>
                                                    </a>

                                                    <ul class="dropdown-menu pull-left">
                                                            <li aria-haspopup="true" class=" ">
                                                                <a  href="{{ route('projectOverviewMC') }}" class="nav-link  "> <i class="icon-magnifier" style="color: #7cda24"></i> Overview Reports <?php if($rcount != ""){ ?> <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $rcount }}</span> <?php } ?> </a> 
                                                            </li>
                                                            <li aria-haspopup="true" class=" ">
                                                                <a  href="{{ url('/mconsultants/projectPending') }}" class="nav-link  "> <i class="icon-pin" style="color: #7cda24"></i> Pending Reports </a>
                                                            </li>
                                                            <li aria-haspopup="true" class=" ">
                                                                <a href="{{ url('/mconsultants/projectOngoing') }}" class="nav-link  ">  <i class="icon-target" style="color: #7cda24"></i> On-Going Reports</a>
                                                            </li>
                                                            <li aria-haspopup="true" class=" ">
                                                                <a href="{{ url('/mconsultants/projectCompleted') }}" class="nav-link  "> <i class="icon-briefcase" style="color: #7cda24"></i> Completed Reports</a>
                                                            </li>
                                                    </ul>

                                                </li>



                                       <?php } elseif($userType == 4){ ?>

                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                    <a href="{{ url('/home') }}" >
                                                        <i class="icon-grid" style="color: #7cda24"></i> <span class="">Dashboard</span>
                                                        <span class="arrow"></span>
                                                    </a>
                                                <ul class="dropdown-menu pull-left">

                                                        <li aria-haspopup="true" class=" ">
                                                                <a href="{{ url('/thomson') }}" class="nav-link  ">
                                                                <i class="icon-bulb" style="color: #7cda24"></i> Refinitive </a>
                                                        </li>

                                                        <li aria-haspopup="true" class=" ">
                                                                <a href="{{ url('/thomson/history') }}" class="nav-link  ">
                                                                <i class="icon-bulb" style="color: #7cda24"></i> Refinitive History </a>
                                                        </li>

                                                        <li aria-haspopup="true" class="">
                                                            <a href="{{ url('/opportunity/explore') }}">
                                                                <i class="icon-layers" style="color: #7cda24"></i> <span class="">Opportunities</span>
                                                            </a>
                                                        </li>
                                                </ul>
                                            </li>

                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="#">
                                                <i class="icon-layers" style="color: #7cda24"></i> <span class="">Business News</span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/businessnews/approval/pending')}}" class="nav-link  ">
                                                    Pending Business News</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/businessnews/approval/approved')}}" class="nav-link  ">
                                                    Approved Business News</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/businessnews/approval/rejected')}}" class="nav-link  ">
                                                    Rejected Business News</a>
                                                </li>
                                            </ul>
                                        </li>
                                       <?php } elseif($userType == 5){  ?>

                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                            <a href="{{ url('#') }}">
                                                <i class="fa fa-dashboard"></i>
                                                <span class="">Dashboard</span> <span class="arrow"></span>
                                                   
                                            </a>
                                                <ul class="dropdown-menu pull-left">
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{url('/coreAccountsHistory')}}" class="nav-link  ">
                                                                Core Accounts History</a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{url('/userAccountsHistory/All')}}" class="nav-link  ">
                                                                User Accounts History</a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                            <a  href="{{ url('/company/companychart?type=primary_country') }}" class="nav-link  "> <i class="fa fa-bar-chart"></i> Company Charts </a>
                                                        </li>
                                                </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="{{ url('#') }}">
                                                <i class="fa fa-gear"></i>
                                                <span class="">Settings</span> <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">

                        <li aria-haspopup="true" class=" ">
                                                <a href="{{url('/transferCompany')}}" class="nav-link  ">
                                                    Company Transfer and Credit</a>
                                               </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/sysconfig')}}" class="nav-link  ">
                                                        Configure Variables</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/sysconfig/assignConsultants')}}" class="nav-link  ">
                                                        Consultant Mapping</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/sysconfig/reportTemplate')}}" class="nav-link  ">
                                                        Configure Report Templates</a>
                                                </li>
                        
                        <li aria-haspopup="true" class=" ">
                                                  <a href="{{url('/req-list')}}" class="nav-link  ">
                                                      Company Request Ownership and Removal</a>
                                              </li>

                                              <li aria-haspopup="true" class=" ">
                                                  <a href="{{url('/auditTrailLog/view')}}" class="nav-link  ">
                                                      View Audit Trail</a>
                                              </li>


                                            </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="{{ route('approvalPageAdmin') }}">
                                                <i class="fa fa-users"></i>
                                                <span class="">Accounts</span> <span class="arrow"></span>
                                            </a>

                                        </li>

                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="#">
                                                <i class="icon-bar-chart" style="color: #7cda24"></i> <span class="">Companies</span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/accountsCompanies') }}" class="nav-link  ">
                                                    List of Companies</a>
                                                </li>
                                                <li aria-haspopup="true" class="nav-link  ">
                                                    <a href="{{ url('/xero/loadAgreements') }}" class="nav-link  ">
                                                    Xero Settings</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li aria-haspopup="true" class="">
                                                <a href="{{ url('/manage-registration-links') }}">
                                                    <i class="icon-share" style="color: #7cda24"></i> <span class="">Registration Links</span>
                                                </a>
                                        </li>

                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="{{ url('/opportunity/explore') }}">
                                                <i class="icon-layers" style="color: #7cda24"></i> <span class="">Opportunities
                                                    <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $pending_count }}</span></span>
                                                </span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                              <li aria-haspopup="true" class=" ">
                                                <a href="{{url('/opportunity/details')}}" class="nav-link  ">
                                                    Opportunity Details</a>
                                               </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/opportunity/approval/pending')}}" class="nav-link  ">
                                                    Pending Opportunities 
                                                    <?php if($pending_count != ""){ ?>
                                                    <span class="badge badge-danger counter counter-lg mail_icon_not">{{ $pending_count }}</span>
                                                    <?php } ?>
                                                    </span></a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/opportunity/approval/approved')}}" class="nav-link  ">
                                                    Approved Opportunities</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/opportunity/opportunitychart')}}" class="nav-link  ">
                                                    Opportunity Chart</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        


                                       <?php } elseif($userType == 8) { ?>

                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                          <a  href="{{ url('/homeSA') }}" >
                                              <i class="icon-grid" style="color: #7cda24"></i> System Dashboard
                                              <span class="arrow"></span>
                                          </a>

                                       
                                      </li>

                                       <?php }  ?>

                                        @endguest
                                    </ul>
                                </div>
                                <!-- END MEGA MENU -->
                            </div>
                        </div>
                        <!-- END HEADER MENU -->

                    </div>
                    <!-- END HEADER -->
                </div>
                <!-- END NAVIGATION HEADER AND NAVIGATION MENU -->
                <!-- Menu for login and register -->
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <!--<ul class="nav navbar-nav">
                        &nbsp;
                    </ul> -->

                    <!-- Right Side Of Navbar -->
                    <!-- <ul class="navbar-nav ml-auto"> -->
                        <!-- Authentication Links -->
                    <!-- @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item"> -->
                            <!-- <a href="#">
                                    {{ Auth::user()->firtsname }} <span class="caret"></span>
                                </a> -->

                            <!-- <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </li>
                        @endguest
                    </ul> -->
                </div>
                <!-- End Menu for login and register -->
            </div>


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
                                        <!-- BEGIN PAGE BREADCRUMBS

                                        <ul class="page-breadcrumb breadcrumb">
                                            <li>
                                                <a href="index.html">Home</a>
                                                <i class="fa fa-circle"></i>
                                            </li>
                                            <li>
                                                <span>Dashboard</span>
                                            </li>
                                        </ul>
                                        <!-END PAGE BREADCRUMBS -->
                                        <!-- BEGIN PAGE CONTENT INNER -->

                                    @yield('content')

                                    <!-- END PAGE CONTENT INNER -->
                                    </div>
                                </div>


                            <!-- END PAGE CONTENT BODY -->
                            <!-- END CONTENT BODY -->
                        </div>
                    @else
                        @yield('content')
                    @endif
                        <!-- END CONTENT -->


                        <!-- END QUICK SIDEBAR -->
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
            @if(auth()->check())
                <div class="">
                    <div class="">
                        <!-- BEGIN FOOTER -->

                        <!-- BEGIN INNER FOOTER -->
                        <div class="page-footer">
                            <p class="uppercase">Copyright <b class="text-company">&copy;</b> <script>document.write(new Date().getFullYear())</script> <b class="text-company">Intellinz</b></p>
                        </div>
                        <div class="scroll-to-top">
                            <i class="icon-arrow-up"></i>
                        </div>
                        <!-- END INNER FOOTER -->
                        <!-- END FOOTER -->
                    </div>
                </div>
                @endif
        </div>



    <div class="popup" data-popup="popup-company">
        <div class="popup-inner">

            <?php
              $numC = App\Configurations::where('code_name','company_creation')->first();
             $rsC = json_decode($numC->json_value, true);
             $numAccount = 3;
             $userId = Auth::id();
             $usr = App\User::find($userId);
            if($rsC){
                 foreach($rsC as $k => $v){
                  if(isset($usr->email)){
                    if($v == $usr->email){
                      $numAccount = $k;
                      break;
                    }
                  }
                }
            }
             $rs_company = App\CompanyProfile::where('user_id',  $userId)->where('status', 1)->get();

            if(sizeof($rs_company) < $numAccount){            ?>

            <button id="showProfile" class="btn btn-primary"><i class="fa fa-plus"></i> Create New</button>
            <div id="add_company_profile">
                <form action="{{ route('homeAddCompany') }}" method="POST">
                        {{ csrf_field() }}
                <table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%; padding-top: 5px;">
                    <tr>
                        <td>Company Name</td>
                        <td>Company Website</td>
                        <td valign="top"><center><input type="button" id="closeCreateProfile" class="btn" value="Close" /></center></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" name="company_name" id="company_name"></td>
                        <td><input type="text" class="form-control" name="company_website" id="company_website"></td>
                        <td><input type="submit" class="btn btn-primary" value="Save Company"></td>
                    </tr>
                </table>
                </form>
            </div>
            <br /><br />
            <?php } ?>
            <div class="alert bg-intellinz-light-green text-company"><b>Select a company!</b></div>

            <table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%; padding-top: 5px;">
                    <tr>
                            <th><b>Company Name</b></th>
                            <th><b>Website</b></th>
                            <th>Date Created</th>
                            <th></th>
                        </tr>

                    <?php foreach($rs_company as $d){ ?>
                    <tr>
                        <td><?php echo $d->registered_company_name; ?></td>
                        <td><?php echo $d->company_website; ?></td>
                        <td><?php
                            $old_date_timestamp = strtotime($d->created_at);
                            $new_date = date('F d, Y h:i A', $old_date_timestamp);
                            echo $new_date;
                            ?></td>
                        <td>
                                <form action="{{ route('homeSelectCompany') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="selected_company_id" value="<?php echo $d->id; ?>">
                                        <input type="submit" class="btn btn-primary" value="SELECT">
                                </form>
                        </td>
                    </tr>
                    <?php } ?>
                </table>


            <a class="popup-close" data-popup-close="popup-company" href="#">x</a>
        </div>
    </div>

    <script>


                $("#showProfile").click(function(){
                  $("#add_company_profile").show();
                });

                $("#closeCreateProfile").click(function(){
                    $("#add_company_profile").hide();
                });

                $("#add_company_profile").hide();



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


    </script>

        <script src="{{asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('public/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
        
        <script src="{{asset('public/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('public/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('public/assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('public/assets/layouts/layout3/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/layouts/layout3/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- END NEW SCRIPTS FOR FIXING OF MENU BAR -->

<script>

function updateTour(is_end = 'none'){
  formData = new FormData();
  formData.append("auth_id", {{ Auth::id() }} );
  formData.append("scope", '<?=  $scope ?>');
  formData.append("is_end", is_end);

  $.ajax({
      url: "{{ route('updateTour') }}",
      type: "POST",
      data: formData,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      processData: false,
      contentType: false,

      success: function (data) {
          
        if(is_end ==  'none'){
          location.reload();
        }
// alert("weee");
        // console.log(data);
      }
  });
}

 function checkAlertByPremiumMenu(companyOpp, companyViewer)
        {   
            swal({
                title: "This profile is a free account.", 
                text:  "Are you sure to proceed? Because we will send an email notification to this profile. To encourage them buy token and become a premium account.",
                icon:  "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {
                  swal({
                    title: 'Email will be sent to this profile, to encourage them to become premium account.',
                    text:  'To interact fully and avail the system priviledge must become a premium account',
                    icon:  'success'
                  }).then(function() {
                    
                    formData = new FormData();
                    formData.append("companyOpp", companyOpp);
                    formData.append("companyViewer", companyViewer);
                    
                        $.ajax({
                            url: "{{ route('AlertFreeAccount') }}",
                            type: "POST",
                            data: formData,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            processData: false,
                            contentType: false,

                            success: function (data) {
                                console.log(data);
                                window.open(data, '_blank');
                                document.location = '{{ url("opportunity/explore") }}';
                                
                              
                            }
                        });
                  
                  });
                } else {
                  swal("Cancelled", "Alerting this profile to become premium account was cancelled :)", "error");
                }
              });

        }

        function encourageToPremiumMenu(){
            swal({
                title:"This requires premium account to open this profile.", 
                text: "Are you sure to proceed? and I will redirect you to Dashboard page and find the upgrade button at Token Credit section.",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {
                  swal({
                    title: 'You need to re-fill token to become a Premium Account',
                    text:  'Check Token Credit section and look for the Upgrade To Premium Account button.',
                    icon:  'success'
                  }).then(function() {
                         //document.location = '{{ url("reports/buyTokens") }}';
             document.location = '{{ url("/home") }}';
                  
                  });
                } else {
                  swal("Cancelled", "To become premium account was cancelled :)", "error");
                }
              });

        }

jQuery(document).on('click', '.mega-dropdown', function(e) {
  e.stopPropagation()
})
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();

          });
          a.appendChild(b);

        }
        if( (i+1) == arr.length ){

          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<center><strong>-Show All-</strong></center>";
        //  b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='show-all'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();

          });
          a.appendChild(b);

        }
      }


  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");

  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
      //  alert('hi');
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }

  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

$(document).ready(function()
{
    
    $('[data-toggle="popover"]').popover();   
   $.getJSON('https://app-prokakis.com/getCompanyNames', function(dataA) {
     autocomplete(document.getElementById("seach_entry_key"), dataA);
  });

  $("#seach_entry_key").on('keyup', function (e) {
    if (e.keyCode === 13) {
        // Do something
          $( "#search_box" ).submit();
    }
   });

});


function updateCurrency(){
    let sel = $('#currency-selector').val();
  
        formData = new FormData();
        formData.append("currency_id", sel);
        formData.append("user_id", {{ Auth::id() }} );
        $.ajax({
            url: "{{ route('updateCurrency') }}",
            type: "POST",
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $('#myModal-currency-close').click();
                swal({
                  title: 'Success!',
                  icon:  'success'
                }).then(function() {
                    location.reload()
                  });
            }
        });

}
</script>

    <!-- Modal -->
    <div id="myModal-currency" class="modal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update Currency</h4>
          </div>
          <div class="modal-body">
                    <div class="card">
                        <div class="card-body center">
                            <div class="portlet light" >

                                <div class="portlet-body">

                                    <div class="form-group">

                                        <label for="currency"><b>Please select your default currency? </b></label>

                                            <?php 
                                                        $currencyList = App\CurrencyMonetary::where('status','0')->get();
                                                        $currentCurrency = App\CurrencyAccounts::where('user_id',$user_id)->first()
                                            ?>            
                                                        <select  class="currency-selector" id="currency-selector">
                                                            @foreach($currencyList as $list)
                                                            <option <?php if(isset($currentCurrency->currency_id) && $currentCurrency->currency_id == $list->id){echo "selected";} ?> value='{{ $list->id }}' >{{  $list->c_code }} ( {{ $list->c_text }} )</option>
                                                            @endforeach
                                                        </select>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
          </div>
          <div class="modal-footer">
                   <a onClick="updateCurrency()" target="_blank" class="btn blue btn_options"> <span class="fa fa-floppy-o"></span> &nbsp; Update</a>
                    <button id="myModal-currency-close" type="button" class="btn btn-default" data-dismiss="modal">close</button>
          </div>
        </div>

      </div>
    </div>
    </body>
    
</html>