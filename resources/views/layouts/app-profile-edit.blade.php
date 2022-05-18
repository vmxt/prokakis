<!DOCTYPE html>



<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="{{ app()->getLocale() }}">

    <!--<![endif]-->

    <!-- BEGIN HEAD -->



    <head>

        <!-- from the original code -->

        <!-- CSRF Token -->

        <meta property="og:url"           content="http://ebos-app.prokakis.com" />

        <meta property="og:type"          content="website" />

        <meta property="og:title"         content="Intellinz Ebos-SG App {{ now()->year }}" />

        <meta property="og:description"   content="Uncover Your Hidden Business Opportunities, Protect yourself from Fraudulent Partners,Safe and Secure Business Opportunities, On-Going Business Intelligence Assessment, Form New Partnerships for Growth, Minimise Infiltration of Criminal Syndicates" />

        <meta property="og:image"         content="https://prokakis.com/wp-content/uploads/2018/06/New-ProKakis-1b.jpg" />

        <!-- end from the original code -->



        <meta charset="utf-8" />

        <title>Intellinz App | Dashboard</title>

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

        <link rel="shortcut icon" href="https://app-prokakis.com/favicon.ico" />

        <!-- for new banner

        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">

            -->

        <!-- END HEAD -->



    <!-- override the css values above -->

     <style>
             @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

            .page-header .page-header-menu {

                background: #000000;

            }

            i {color: white}



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





     </style>    



    <?php 

   

    $user_id = Auth::id();

    $userType = App\User::validateAccountNavigations($user_id);

    

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

                                    <a href="{{ route('home') }}" style="margin-top: 25px;">

                                        <img src="https://app-prokakis.com/public/img-resources/intellinz_green.png" alt="Intellinz" id="logo" width="200px">

                                    </a>

                                </div>

                                <!-- END LOGO -->

                                <!-- BEGIN RESPONSIVE MENU TOGGLER -->

                                <a href="javascript:;" class="menu-toggler"></a>

                                <!-- END RESPONSIVE MENU TOGGLER -->

                                <!-- BEGIN TOP NAVIGATION MENU -->

                                <div class="top-menu">



                                        <?php 

                                          if(App\User::securePage($user_id) != 5){  

                                              

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

                                        if( count($noti) > 0 )

                                        {

                                        ?>

                                        <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">

                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                                <span class="circle"><?php echo App\Mailbox::getNumberEmailWithNoti($user_id);  ?> </span>

                                                <span class="corner"></span>

                                            </a>

                                           

                                            <ul class="dropdown-menu">

                                                <li class="external">

                                                    <h3>You have

                                                     <strong> <?php echo App\Mailbox::getNumberEmailWithNoti($user_id); ?> New</strong> Messages</h3>

                                                    <a href="{{ route('mailCompose')}}">view all</a>

                                                </li>

                                              

                                                <li>

                                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">

                                                        <?php 



                                                             foreach($noti as $n){

                                                               $noti_profilePic = App\CompanyProfile::getProfileImage($n->sender_id);  

                                                               $noti_user = App\User::find($n->sender_id);

                                                        ?>

                                                        <li>

                                                            <a href="{{ url('/mailbox/setReply/'.$n->id) }}">

                                                                <span class="photo">



                                                                    <img src="{{ asset('public/images/') }}/<?php echo $noti_profilePic; ?>" class="img-circle" alt=""> </span>



                                                                <span class="subject">

                                                                    <span class="from"><?php echo $noti_user->firstname . '  ' .$noti_user->lastname; ?> </span>

                                                                </span>

                                                                <span class="message"><?php echo $n->subject; ?> </span>

                                                            </a>

                                                        </li>

                                                       <?php 

                                                               }

                                                         ?>

                                                      

                                                    </ul>

                                                 

                                                </li>

                                            </ul>

                                        </li>

                                        <?php  } ?>





                                        <!-- END INBOX DROPDOWN -->

                                        <!-- BEGIN USER LOGIN DROPDOWN -->

                                        <li id='nav-login-dropdown' class="dropdown dropdown-user dropdown-dark">

                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                                <?php 
                                                if($userType == 1){ 
                                                    $profilePic = App\CompanyProfile::getProfileImage(Auth::id()); 
                                                    if($profilePic != null){
                                                    ?>

                                                    <img class="img-circle" alt="" src="{{ asset('public/images/') }}/<?php echo $profilePic; ?>">

                                                    <?php } else { ?>

                                                    <img  class="img-circle" alt="" src="{{ asset('public/images/robot.jpg') }}">

                                                    <?php } 
                                                } elseif($userType == 2){
                                                    $profilePicSC = App\CompanyProfile::getProfileImageSC(Auth::id()); 
                                                    if($profilePicSC != null){
                                                    ?>

                                                    <img  class="img-circle alt=" src="{{ asset('public/images/') }}/<?php echo $profilePicSC; ?>">

                                                    <?php } else { ?>

                                                    <img  class="img-circle alt=" src="{{ asset('public/images/robot.jpg') }}">

                                                    <?php }   
                                                } elseif($userType == 3){
                                                    $profilePicMC = App\CompanyProfile::getProfileImageMC(Auth::id()); 
                                                    if($profilePicMC != null){
                                                    ?>

                                                    <img  class="img-circle" alt="" src="{{ asset('public/images/') }}/<?php echo $profilePicMC; ?>">

                                                    <?php } else { ?>

                                                    <img  class="img-circle" alt="" src="{{ asset('public/images/robot.jpg') }}">

                                                    <?php } 
                                                }
                                                ?>



                                                <span class="username username-hide-mobile"><?php echo App\CompanyProfile::getProfileFirstname(Auth::id()); ?></span>

                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-default">
                        <?php   
                                            $user_id = Auth::id();
                                            $u = App\User::find($user_id);
                        if($u->m_id == null || $u->m_id == 0){  
                                            ?>
                                        </li>

                                                            <li id='nav-login-account-credit'>
                                                    <a href="{{ route('getTokenActivated') }}">
                                                        <i class="icon-wrench"></i> Manage Account </a>
                                                </li>   

                                                <li aria-haspopup="true" id="nav-buy-credit">
                                                    <a href="{{ url('/reports/buyCredits') }}" class="nav-link  "><i class="fa fa-dollar"></i> Buy Credits</a>
                                                </li>

                                                <li id='nav-login-company'>

                                                    <a href="{{ route('viewingProfile') }}">
                                                        <i class="icon-user"></i> My Company </a>
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

                        <li>

                                                  <a href="{{ route('setPasswordData') }}" >
                                                      <i class="icon-key"></i> Change Password </a>
                                                </li>

                                                <li>
                                                    <?php 
                                                    if($currentCurrency = App\CurrencyAccounts::where('user_id',$user_id)->first()){
                                                        $currentCurrency = $currentCurrency->getCurrency->c_code;
                                                    }else{
                                                        //default USD = 3
                                                        $currentCurrency = App\CurrencyMonetary::find(3)->c_code;
                                                        // if(!$currentCurrency){
                                                    }
                                                 // }
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

                        <li>
                                                  <a href="{{ route('setSubaccounts') }}" >
                                                      <i class="icon-user"></i> User Control </a>
                                                </li>
                        <?php } ?>

                                                <li id='nav-login-logout'>
                                                    <a href="{{ url('logout') }}">
                                                        <i class="icon-building-o"></i> Log Out </a>
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

                        <div class="page-header-menu">

                            <div class="container">

                                <!-- BEGIN HEADER SEARCH BOX -->

                                  <form id="search_box" class="search-form" action="{{ route('searchByCompany') }}" method="GET">
                                {{ csrf_field() }}
                                    <div class="input-group">
                                        <input type="text" style="background:white;" class="form-control" placeholder="Search company..." name="seach_entry_key">
                                        <span class="input-group-btn" style="background:white;">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
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
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown {{ (request()->segment(2) == '/') ? 'active' : '' }}">
                                            @guest
                                                <a class="navbar-brand" href="https://app-prokakis.com/home">
                                                    <i class="fa fa-home"></i>  Home
                                                    <span class="arrow"></span>
                                                </a>
                                            @else
                                                <a href="https://app-prokakis.com/home">
                                                    <i class="fa fa-home"></i>  Home
                                                    <span class="arrow"></span>
                                                </a>

                                        </li>
                                      <?php if($userType == 1){  ?>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown {{(request()->segment(1) == 'home') ? 'active' : '' ||
                                        (request()->segment(1) == 'businessnews') ? 'active' : '' || (request()->segment(1) == 'alertedRecords') ? 'active' : ''}} ">

                                                <a  href="{{ url('/home') }}" >
                                                    <i class=" fa fa-dashboard" style="color: white"></i>System Dashboard
                                                    <span class="arrow"></span>
                                                </a>
                                                <ul class="dropdown-menu pull-left">
                                                        <li aria-haspopup="true" class=" ">
                                                               <a href="{{ url('/businessnews/list') }}" class="nav-link  ">
                                                               <i class="icon-bulb" style="color: white"></i> Business News</a>
                                                        </li>

                                                        <li aria-haspopup="true" class=" ">
                                                               <a href="{{ url('/alertedRecords') }}" class="nav-link  ">
                                                               <i class="icon-magnifier" style="color: white"></i> Investor Alert List</a>
                                                        </li>
                                                </ul>

                                        </li>

                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown {{ (request()->segment(2) == 'view') ? 'active' : '' ||
                                        (request()->segment(2) == 'edit') ? 'active' : '' ||
                                        (request()->segment(2) == 'contacts') ? 'active' : '' ||
                                        (request()->segment(2) == 'billing') ? 'active' : '' ||
                                        (request()->segment(2) == 'paymentHistory') ? 'active' : '' ||
                                        (request()->segment(2) == 'deactivatePage') ? 'active' : '' }}">

                                            <a  href="#">
                                                <i class="fa fa-user" style="color: white"></i> Company <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a class="nav-link" href="{{ url('/profile/view') }}"> <i class="fa fa-video-camera" style="color: white"></i> View Company</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                        <a class="nav-link" href="{{ url('/profile/edit') }}"> <i class="fa fa-edit" style="color: white"></i> Edit Company</a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/profile/contacts') }}" class="nav-link "><i class="fa fa-phone-square" style="color: white"></i> Contacts </a>
                                                </li>
                                               <!-- <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/profile/billing') }}" class="nav-link  "><i class="fa fa-money" style="color:white;"></i> Billing</a>
                                                </li> -->
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/profile/paymentHistory') }}" class="nav-link"><i class="fa fa-cc-paypal" style="color: white"></i> Payments History</a>
                                                </li>
                                                <!--<li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/profile/socialAccounts') }}" class="nav-link"> <i class="fa fa-facebook-official" style="color: white"></i> Social Media Accounts</a>
                                                </li> -->
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/profile/deactivatePage') }}" class="nav-link  "><i class="fa fa-warning" style="color: red;"></i> Deactivate Company</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown {{(request()->segment(1) == 'opportunity') ? 'active' : '' ||
                                        (request()->segment(2) == 'explore') ? 'active' : ''}}">

                                            <a href="#">
                                                <i class=" fa fa-lightbulb-o" style="color: white"></i> Opportunities
                                                <span class="arrow"></span>
                                            </a>

                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a  href="{{ url('/opportunity') }}" class="nav-link  "><i class="icon-bulb" style="color: white"></i> My Opportunities </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/opportunity/explore') }}" class="nav-link  "><i class="icon-magnifier" style="color: white;"></i> Explore</a>
                                                </li>
                                            </ul>

                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown {{(request()->segment(2) == 'status') ? 'active' : '' ||
                                        (request()->segment(2) == 'list') ? 'active' : '' ||
                                        (request()->segment(2) == 'buyTokens') ? 'active' : '' ||
                                        (request()->segment(2) == 'requesters') ? 'active' : ''}}">

                                            <a href="#">
                                                <i class="fa fa-file-text-o" style="color: white"></i> Report
                                                <span class="arrow"></span>
                                            </a>

                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/reports/status') }}" class="nav-link  "><i class="icon-hourglass" style="color: white;"></i> Report Status </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/monitoring/list') }}" class="nav-link  "><i class="icon-eye" style="color:white"></i> Ongoing Monitoring </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/reports/buyTokens') }}" class="nav-link  "><i class="fa fa-dollar" style="color: white;"></i> Buy Tokens</a>
                                                </li>

                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{ url('/reports/requesters') }}" class="nav-link  "><i class="fa fa-user" style="color: white;"></i> Report Requesters </a>
                                                </li>


                                            </ul>
                                        </li>

                                        <?php } elseif($userType == 2) { ?>

                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                <a  href="{{ url('/homeSubConsul') }}" >
                                                    <i class="icon-grid"></i> System Dashboard
                                                    <span class="arrow"></span>
                                                </a>

                                               <!-- <ul class="dropdown-menu pull-left">
                                                    <li aria-haspopup="true" class=" ">
                                                                <a href="{{ url('/businessnews') }}" class="nav-link  ">
                                                                    <i class="icon-bulb"></i> Opportunities and News</a>
                                                            </li>
                                                </ul> -->
                                            </li>

                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                <a href="{{ url('/consultants/viewprofile') }}" >
                                                    <i class="icon-user"></i> Profile <span class="arrow"></span>
                                                </a>

                                                <ul class="dropdown-menu pull-left">
                                                    <li aria-haspopup="true" class=" ">
                                                        <a  href="{{ url('/consultants/viewprofile') }}" class="nav-link  "> <i class="icon-camcorder"></i> View Profile </a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/editprofile') }}" class="nav-link  "> <i class="icon-note"></i> Edit Profile </a>
                                                    </li>

                                                  <!--  <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/billing') }}" class="nav-link  "> <i class="icon-map"></i> Billing </a>
                                                    </li> -->

                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/commission') }}" class="nav-link  "> <i class=" icon-layers"></i> Commission History </a>
                                                    </li>

                                                </ul>

                                            </li>

                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                <a href="" >
                                                    <i class="icon-notebook" style="color: white"></i>  Reports
                                                    <span class="arrow"></span>
                                                </a>

                                                <ul class="dropdown-menu pull-left">
                                                    <li aria-haspopup="true" class=" ">
                                                        <a  href="{{ url('/consultants/pending-projects') }}" class="nav-link  "> <i class="icon-pin"></i> Pending Reports </a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/ongoing-projects') }}" class="nav-link  ">  <i class="icon-target"></i> On-Going Reports</a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{ url('/consultants/archived-projects') }}" class="nav-link  "> <i class="icon-briefcase"></i> Archived Reports</a>
                                                    </li>

                                                </ul>

                                            </li>

                                            <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                                <a href="{{ url('/opportunity/explore') }}">
                                                    <i class="icon-layers" style="color:white;"></i> <span class="font-white">Opportunities</span>
                                                </a>
                                                <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="{{url('/opportunity/details')}}" class="nav-link  ">
                                                        Opportunity Details</a>
                                                </li>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{url('/opportunity/approval/pending')}}" class="nav-link  ">
                                                        Pending Opportunities</a>
                                                    </li>
                                                    <li aria-haspopup="true" class=" ">
                                                        <a href="{{url('/opportunity/approval/approved')}}" class="nav-link  ">
                                                        Approved Opportunities</a>
                                                    </li>
                                                </ul>
                                            </li>


                                        <?php }elseif($userType == 3){ ?>

                                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                    <a href="{{ url('/home') }}" >
                                                        <i class="icon-grid"></i> Dashboard
                                                        <span class="arrow"></span>
                                                    </a>
                                                 <!--   <ul class="dropdown-menu pull-left">

                                                            <li aria-haspopup="true" class=" ">
                                                                    <a href="{{ url('/businessnews') }}" class="nav-link  ">
                                                                    <i class="icon-bulb"></i> Opportunities and News</a>
                                                            </li>
                                                    </ul> -->
                                                </li>

                                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                    <a href="{{ url('/opportunity') }}" >
                                                        <i class="icon-user"></i> Profile
                                                        <span class="arrow"></span>
                                                    </a>

                                                    <ul class="dropdown-menu pull-left">
                                                            <li aria-haspopup="true" class=" ">
                                                                    <a  href="{{ route('viewProfileMC') }}" class="nav-link  "> <i class="icon-camcorder"></i> View Profile </a>
                                                                </li>
                                                                <li aria-haspopup="true" class=" ">
                                                                    <a href="{{ route('editProfileMC') }}" class="nav-link  "> <i class="icon-note"></i> Edit Profile </a>
                                                                </li>
                                                    </ul>

                                                </li>

                                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                        <a href="{{ url('/opportunity') }}" >
                                                            <i class="icon-folder" style="color: white"></i> Job Orders
                                                            <span class="arrow"></span>
                                                        </a>

                                                    </li>

                                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                    <a  href="{{ url('/') }}" >
                                                        <i class="icon-notebook" style="color: white"></i>  Project
                                                        <span class="arrow"></span>
                                                    </a>

                                                    <ul class="dropdown-menu pull-left">
                                                            <li aria-haspopup="true" class=" ">
                                                                <a  href="{{ route('projectOverviewMC') }}" class="nav-link  "> <i class="icon-magnifier"></i> Overview Projects </a>
                                                            </li>
                                                            <li aria-haspopup="true" class=" ">
                                                                <a  href="{{ url('/mconsultants/projectPending') }}" class="nav-link  "> <i class="icon-pin"></i> Pending Projects </a>
                                                            </li>
                                                            <li aria-haspopup="true" class=" ">
                                                                <a href="{{ url('/mconsultants/projectOngoing') }}" class="nav-link  ">  <i class="icon-target"></i> On-Going Projects</a>
                                                            </li>
                                                            <li aria-haspopup="true" class=" ">
                                                                <a href="{{ url('/mconsultants/projectCompleted') }}" class="nav-link  "> <i class="icon-briefcase"></i> Completed Projects</a>
                                                            </li>
                                                    </ul>

                                                </li>



                                       <?php } elseif($userType == 4){ ?>

                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                                                <a href="{{ url('/home') }}" >
                                                    Dashboard
                                                    <span class="arrow"></span>
                                                </a>
                                                <ul class="dropdown-menu pull-left">

                                                        <li aria-haspopup="true" class=" ">
                                                                <a href="{{ url('/thomson') }}" class="nav-link  ">
                                                                <i class="icon-bulb" style="color: white"></i> Thomson Reuters </a>
                                                        </li>

                                                        <li aria-haspopup="true" class="">
                                                            <a href="{{ url('/opportunity/explore') }}">
                                                                <i class="icon-layers" style="color:white;"></i> <span class="font-white">Opportunities</span>
                                                            </a>
                                                        </li>
                                                </ul>
                                            </li>



                                       <?php } elseif($userType == 5){  ?>

                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                            <a href="{{ url('#') }}">
                                                <svg color="white" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tachometer-alt" class="svg-inline--fa fa-tachometer-alt fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M288 32C128.94 32 0 160.94 0 320c0 52.8 14.25 102.26 39.06 144.8 5.61 9.62 16.3 15.2 27.44 15.2h443c11.14 0 21.83-5.58 27.44-15.2C561.75 422.26 576 372.8 576 320c0-159.06-128.94-288-288-288zm0 64c14.71 0 26.58 10.13 30.32 23.65-1.11 2.26-2.64 4.23-3.45 6.67l-9.22 27.67c-5.13 3.49-10.97 6.01-17.64 6.01-17.67 0-32-14.33-32-32S270.33 96 288 96zM96 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm48-160c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm246.77-72.41l-61.33 184C343.13 347.33 352 364.54 352 384c0 11.72-3.38 22.55-8.88 32H232.88c-5.5-9.45-8.88-20.28-8.88-32 0-33.94 26.5-61.43 59.9-63.59l61.34-184.01c4.17-12.56 17.73-19.45 30.36-15.17 12.57 4.19 19.35 17.79 15.17 30.36zm14.66 57.2l15.52-46.55c3.47-1.29 7.13-2.23 11.05-2.23 17.67 0 32 14.33 32 32s-14.33 32-32 32c-11.38-.01-20.89-6.28-26.57-15.22zM480 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"></path></svg>
                                                <span class="font-white">Dashboard</span> <span class="arrow"></span>
                                            </a>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="{{ url('#') }}">
                                                <svg color="white" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cogs" class="svg-inline--fa fa-cogs fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M512.1 191l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0L552 6.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zm-10.5-58.8c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.7-82.4 14.3-52.8 52.8zM386.3 286.1l33.7 16.8c10.1 5.8 14.5 18.1 10.5 29.1-8.9 24.2-26.4 46.4-42.6 65.8-7.4 8.9-20.2 11.1-30.3 5.3l-29.1-16.8c-16 13.7-34.6 24.6-54.9 31.7v33.6c0 11.6-8.3 21.6-19.7 23.6-24.6 4.2-50.4 4.4-75.9 0-11.5-2-20-11.9-20-23.6V418c-20.3-7.2-38.9-18-54.9-31.7L74 403c-10 5.8-22.9 3.6-30.3-5.3-16.2-19.4-33.3-41.6-42.2-65.7-4-10.9.4-23.2 10.5-29.1l33.3-16.8c-3.9-20.9-3.9-42.4 0-63.4L12 205.8c-10.1-5.8-14.6-18.1-10.5-29 8.9-24.2 26-46.4 42.2-65.8 7.4-8.9 20.2-11.1 30.3-5.3l29.1 16.8c16-13.7 34.6-24.6 54.9-31.7V57.1c0-11.5 8.2-21.5 19.6-23.5 24.6-4.2 50.5-4.4 76-.1 11.5 2 20 11.9 20 23.6v33.6c20.3 7.2 38.9 18 54.9 31.7l29.1-16.8c10-5.8 22.9-3.6 30.3 5.3 16.2 19.4 33.2 41.6 42.1 65.8 4 10.9.1 23.2-10 29.1l-33.7 16.8c3.9 21 3.9 42.5 0 63.5zm-117.6 21.1c59.2-77-28.7-164.9-105.7-105.7-59.2 77 28.7 164.9 105.7 105.7zm243.4 182.7l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0l8.2-14.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zM501.6 431c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.6-82.4 14.3-52.8 52.8z"></path></svg>
                                                <span class="font-white">Settings</span> <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
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
                                            </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown">
                                            <a href="{{ route('approvalPageAdmin') }}">
                                                <svg color="white" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="users" class="svg-inline--fa fa-users fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path></svg>
                                                <span class="font-white">Accounts</span> <span class="arrow"></span>
                                            </a>

                                        </li>

                                        <li aria-haspopup="true" class="">
                                            <a href="{{ url('/accountsCompanies') }}">
                                                <i class="icon-bar-chart" style="color:white;"></i> <span class="font-white">Companies</span>
                                            </a>
                                        </li>

                                        <li aria-haspopup="true" class="">
                                                <a href="{{ url('/manage-registration-links') }}">
                                                    <i class="icon-share" style="color:white;"></i> <span class="font-white">Registration Links</span>
                                                </a>
                                        </li>

                                        <li aria-haspopup="true" class="">
                                            <a href="{{ url('/opportunity/explore') }}">
                                                <i class="icon-layers" style="color:white;"></i> <span class="font-white">Opportunities</span>
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

                    <ul class="nav navbar-nav">

                        &nbsp;

                    </ul>



                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->

                        @guest

                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                            </li>

                            <li class="nav-item">

                                @if (Route::has('register'))

                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                                @endif

                            </li>

                        @else

                            <li class="nav-item">

                            <!-- <a href="#">

                                    {{ Auth::user()->firtsname }} <span class="caret"></span>

                                </a> -->



                                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                    {{ __('Logout') }}

                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                    @csrf

                                </form>



                            </li>

                        @endguest

                    </ul>

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

                <div class="page-wrapper-row">

                    <div class="page-wrapper-bottom">

                        <!-- BEGIN FOOTER -->



                        <!-- BEGIN INNER FOOTER -->

                        <div class="page-footer">

                            <div class="container"> 2018 &copy; Intellinz

                            </div>

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

             $userId = Auth::id();

             $rs_company = App\CompanyProfile::where('user_id',  $userId)->get();

           

             if( count($rs_company) < 3){ 

            ?>

           

            <button id="showProfile" class="btn">+ Create New</button>

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

                        <td><input type="submit" class="btn btn-primary" value="Save Profile"></td>

                    </tr> 

                </table>    

                </form>

            </div>

            <br /><br />

            <?php } ?>

            <div class="alert alert-info">Select a company profile!</div>

          

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

    

        <!--[if lt IE 9]>

        <script src="{{asset('public/assets/global/plugins/respond.min.js')}}"></script>

        <script src="{{asset('public/assets/global/plugins/excanvas.min.js')}}"></script>

        <script src="{{asset('public/assets/global/plugins/ie8.fix.min.js')}}"></script>

        <![endif]-->



        <!-- BEGIN CORE PLUGINS -->



       <!-- <script src="{{asset('public/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script> -->



        <script src="{{asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>  

        <script src="{{asset('public/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>

        

        <!--

        <script src="{{asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

        -->





        <!-- START OF FIXING PROFILE DROP-DOWN MENU-->

        <!-- BEGIN CORE PLUGINS -->

<!--

       <script src="{{asset('public/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>



        <script src="{{asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

-->



        <!--END OF FIXING PROFILE DROP-DOWN MENU-->





    <!-- START NEW SCRIPTS FOR FIXING OF MENU BAR -->

        <!-- BEGIN CORE PLUGINS -->

<!--

        <script src="{{asset('public/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>

-->

        

        <!-- <script src="{{asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

        -->

        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

    

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->

<!--         <script src="{{asset('public/assets/global/scripts/app.min.js')}}" type="text/javascript"></script> -->



        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        

        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->

 <!--       

        <script src="{{asset('public/assets/layouts/layout3/scripts/layout.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('public/assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>

 -->       

        <!-- END THEME LAYOUT SCRIPTS -->

        <!-- END NEW SCRIPTS FOR FIXING OF MENU BAR -->


<script>

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

</script>

       

    </body>



</html>