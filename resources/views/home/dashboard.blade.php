@extends('layouts.app')

<style>
    html, body {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
    }


</style>

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">
    <style>
        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            font-weight: bold;
            font-size: 15px;
            background-color: white;
            padding: 30px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            color: orangered;
        }

        .btn-x3 {
            font-size: 15px;
            border-radius: 5px;
            width: 25%;
            background-color: orangered;
            margin-top: 10px;
        }

        .close {
            line-height: 12px;
            width: 18px;
            font-size: 8pt;
            font-family: tahoma;
            margin-top: 20px;
            margin-right: 20px;
            position: absolute;
            top: 0;
            right: 0;
        }


        * {
            margin: 0;
            padding: 0;
        }

        .pie {
            background-color: #f0a22e99;
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
            background-color: #F0A22E;
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

        .panel-body {
            overflow-x: scroll;
            max-height: 400px;
        }
        .panel-body::-webkit-scrollbar { width: 0 !important }

        .h-effect:hover {
          -moz-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
          -webkit-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
          /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
          box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 1) !important;
          cursor: default !important;
        }
   /*     .widget-thumb-icon:hover {
            cursor: pointer;
           background-color: #31708f !important;

        }*/
        .panel-body ul:hover {
          -moz-box-shadow: 0 0 1px 1px #31708f !important;
          -webkit-box-shadow: 0 0 1px 1px #31708f !important;
          /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
          box-shadow: 0 0 5px 0 #31708f !important;
          cursor: default !important;
        }

        .h-effect a{
            text-decoration: none;
        }

        .page-header .page-header-top .top-menu .navbar-nav>li.dropdown>.dropdown-menu{
            z-index: 5;
        }

        .intro-tour-overlay {
            /*display: none;*/
            background: #666;
            opacity: 0.5;
            z-index: 1000;
            min-height: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

    </style>

    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Dashboard</span>
            </li>
        </ul>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- graph card -->
                <div class="page-content-inner">
                    <div class="mt-content-body">
                        <div class="portlet light h-effect">
                            <div class="card">
                                <div class="note note-success">
                                    <h4 class="block"><strong>ENHANCE YOUR COMPANY PROFILE COMPLETION SCORE</strong></h4>
                                </div>
                                <div class="row">
                                    <div class="col col-md-4">
                                        <div class="pie">
                                            <div class="clip1">
                                                <div class="slice1"></div>
                                            </div>
                                            <div class="clip2">
                                                <div class="slice2"></div>
                                            </div>
                                            <div class="status"></div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-8" style="margin-top: 5px;">
                                        <div class="alert alert-info"
                                             style="width: 100%; overflow: hidden; margin-left: 0px !important;"><p>
                                                <strong>Prokakis members are three times more likely
                                                to engage with you if your company profile is over 30% complete.
                                                Be sure to include accurate information.</strong>
                                            </p>
                                        </div>

                    <?php 
                                        $user_id = Auth::id();
                                        $company_id_result = App\CompanyProfile::getCompanyId($user_id);

                                        if( App\SpentTokens::validateLeftBehindToken($company_id_result) == false ){  ?>  
                                         <br />  
                                        <?php } ?>

                                        <a id="home-enhance-profile" href="{{ route('editProfile') }}" class="btn red-mint"
                                           style="margin-top: 15px;">Enhance
                                            Profile</a>

                    

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- widgets -->

                <div class="row widget-row">
                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div id="home-pending" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 h-effect">
                            <h4 class="widget-thumb-heading">PENDING PROFILE REQUEST</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue fa fa-clock-o"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden"></span>
                                    <span class="widget-thumb-body-stat" style="margin-top: 20px;">
                                            <span class="counter"
                                                  data-count=" <?php if (!empty($pendingRequestReport)) {
                                                      echo $pendingRequestReport;
                                                  } ?>"></span>

                                        </span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div id="home-awaiting" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 h-effect">
                            <h4 class="widget-thumb-heading">AWAITING RESPONSE</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue fa fa-reply-all"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden"></span>
                                    <span class="widget-thumb-body-stat" style="margin-top: 20px;">
                                            <span class="counter" data-count=" <?php
                                            if (!empty($awaitingresponsetogenreport)) {
                                                if ($awaitingresponsetogenreport == 0) {
                                                    echo "0";
                                                } else echo $awaitingresponsetogenreport;
                                            }?>"></span>

                                        </span>

                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div id="home-oppor" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 h-effect">
                            <a href='{{  url('/opportunity/chatbox') }}'>
                            <h4 class="widget-thumb-heading">OPPORTUNITY INBOX</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue fa fa-envelope" aria-hidden="true"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> <br>
                                    <span class="widget-thumb-body-stat">
                                            <span class="counter">{{ $oppoInbox }}</span>

                                        </span>
                                </div>
                            </div>
                            </a>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                </div>


                <div class="row widget-row">
                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div id="home-ongoing" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 h-effect">
                            <h4 class="widget-thumb-heading">ONGOING MONITORING</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue fa fa-eye" aria-hidden="true"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> <br>
                                    <span class="widget-thumb-body-stat">
                                            <span class="counter" data-count=" <?php if (!empty($ongoingMonitoring)) {
                                                echo $ongoingMonitoring;
                                            } ?>"></span>

                                        </span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div id="home-generated" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 h-effect">
                            <h4 class="widget-thumb-heading">GENERATED REPORT</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue icon-layers"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> <br>
                                    <span class="widget-thumb-body-stat"> <span class="counter"
                                                                                data-count="<?php if (!empty($generatedreport)) {
                                                                                    echo $generatedreport;
                                                                                } ?>"></span></span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div id='home-completed' class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 h-effect">
                            <h4 class="widget-thumb-heading">COMPLETED REPORT</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue fa fa-newspaper-o"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> <br>
                                    <span class="widget-thumb-body-stat">
                                            <span class="counter" data-count=" <?php if (!empty($process_report)) {
                                                echo $process_report;
                                            } ?>"></span>

                                        </span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                </div>
            </div>


            <div class="col-md-4" style="min-height:800px;">
                <!-- sidebar token credit -->
                <div class="page-content-inner">
                    <div class="mt-content-body">
                        <div class="portlet light h-effect">
                            <div class="card" style="overflow: hidden;">
                                <div class="card-header" style="margin-bottom: 25px;">
                                    <center><span class="bold uppercase font-blue">Credit Status</span>
                                        <hr>
                                    </center>
                                </div>
                                <div class="card-body center" style="text-align: center;">
                                    <b class="font-prokakis-blue" style="font-size: 20px;"> <?php

                                        $user_id = Auth::id();
                                        $company_id_result = App\CompanyProfile::getCompanyId($user_id);
                                        $valid_token = 0;
                                        if (App\SpentTokens::validateTokenStocks($company_id_result) == false) {
                                            echo "0";
                                        } else {
                                            $consumedTokens = App\SpentTokens::validateTokenStocks($company_id_result);
                                            $valid_token = $consumedTokens;
                                            echo $consumedTokens;
                                        }
                                        ?>  </b> <br/>
                                    Credit Left <br/>
                                    <div class="col-sm-12">
                                        <a id='home-topup' href="{{ route('reportsBuyTokens') }}" class="btn red-mint"
                                           style="width: 100%;"> Top Up</a>
                                    </div>
                                        @if($c_promo == 0)   
                                        <?php if( App\SpentTokens::validateLeftBehindToken($company_id_result) == false ){  ?>    
                                        <a onclick="PromoOne('{{ $valid_token }}')" class="btn yellow"
                                            style="margin-top: 15px; width: 90%;"> <i class="fa" style="color: white;"></i> Upgrade To Premium Account 
                                        </a>
                                        <?php } ?>
                                        @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Log activity sidebar -->

                <div class="panel h-effect">
                    <div class="panel-heading">
                        <span class="caption-subject font-blue-steel bold uppercase"> <i class="fa fa-tv"></i> recent activities</span>
                    </div>
                    <div class="panel-body">
                        <?php
                        $log = App\AuditLog::where('user_id', Auth::id())->orderBy('id', 'desc')->take(100)->get();
                        if (count((array)$log) > 0) {
                        foreach ($log as $l) {
                        $date = date("F j, Y, g:i a", strtotime($l->created_at));
                        $activity = $l->action . ' at ' . $l->model.' module, '. $l->details;
                        ?>
                        <ul class="feeds list-group" style="border-style:none; margin-bottom: 5px;">
                            <li class="list-group-item">
                                <a href="javascript:;">
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-bell-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc"> <?php echo $activity?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date"> <span style="font-size: 9px"><?php  echo $date; ?></span></div>
                                    </div>
                                </a>
                            </li>

                        </ul>
                        <?php }
                        }?>
                    </div>


                </div>
            </div>
        </div>
    </div>
 {{-- <div class='intro-tour-overlay'></div> --}}
    <script src="{{ asset('public/jq1110/jquery.min.js') }}"></script>
    <script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>
 <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
// Instance the tour
var tour = new Tour({
  steps: [
  {
    element: "#nav-home-page",
    title: "HOME",
    content: "This is your homepage"
  },
  {
    element: "#nav-system-dashboard",
    title: "SYSTEM DASHBOARD",
    content: "This has a list of the system dashboard links and utilities.",
    onNext: function(){
        $('#nav-system-dashboard').addClass('open');
      }
  },
  {
    element: "#nav-business-news",
    title: "BUSINESS NEWS",
    content: "Here you can create an article, or give upcoming news about your company"
  },
  {
    element: "#nav-investor-alert-list",
    title: "INVESTOR ALERT LIST",
    content: "Here you can view a list of investors",
    onNext: function(){
        $('#nav-system-dashboard').removeClass('open');
        $('#nav-system-dashboard').removeClass('active');
    }
  },
  {
    element: "#company-nav",
    title: "COMPANY",
    content: "This has a list of company links and utilities",
    onNext: function(){
        $('#company-nav').addClass('open');
    }
  },
  {
    element: "#nav-company-view",
    title: "VIEW COMPANY",
    content: "You can view your company profile here"
  },
  {
    element: "#nav-company-edit",
    title: "EDIT COMPANY",
    content: "You can edit your company details here"
  },
  {
    element: "#nav-company-contact",
    title: "CONTACTS",
    content: "You can edit company contact information here"
  },
  {
    element: "#nav-company-payment",
    title: "PAYMENT HISTORY",
    content: "You can view your complete payment and credit history here"
  },
  {
    element: "#nav-company-deactivate",
    title: "DEACTIVATE COMPANY",
    content: "You can completely deactivate your company here",
    onNext: function(){
        $('#company-nav').removeClass('open');
        $('#company-nav').removeClass('active');

    },
  },
  {
    element: "#nav-opportunities",
    title: "OPPORTUNITIES",
    content: "This has a list of links and utilities about opportunities on the Prokakis system",
    onNext: function(){
        $('#nav-opportunities').addClass('open');
    },
  },
  {
    element: "#nav-my-opportunities",
    title: "MY OPPORTUNITIES",
    content: "Here you can view, edit or add an opportunity you have for your company"
  },
  {
    element: "#nav-explore",
    title: "EXPLORE OPPORTUNITIES",
    content: "Here you can view the most recent build, sell and buy opportunities on the Prokakis system",
    onNext: function(){
        $('#nav-opportunities').removeClass('open');
        $('#nav-opportunities').removeClass('active');
    },
  },
  {
    element: "#nav-report",
    title: "REPORT",
    content: "This has a list of utilities and links for reports, monitoring and your tokens",
    onNext: function(){
        $('#nav-report').addClass('open');
    },
  },
  {
    element: "#nav-report-status",
    title: "REPORT STATUS",
    content: "Here you can view the status of a requested report submission"
  },
  {
    element: "#nav-ongoing-monitoring",
    title: "ONGOING MONITORING",
    content: "Here you can update, download and monitor your reports"
  },
  {
    element: "#nav-buy-credit",
    title: "BUY CREDITS",
    content: "Here you can see the token packages and purchase more credits"
  },
  {
    element: "#nav-report-requester",
    title: "REPORT REQUESTER",
    content: "Here you can view the company information of someone who is requesting a report from you",
    onNext: function(){
        $('#nav-report').removeClass('open');
        $('#nav-report').removeClass('active');
    },
  },
  {
    element: "#nav-login-dropdown",
    title: "USER MENU",
    content: "Click here to show the links for your account",
    placement: 'left',
    onNext: function(){
        $('#nav-login-dropdown').addClass('open');
    },
  },
  {
    element: "#nav-login-account-credit",
    title: "ACCOUNT AND CREDIT",
    content: "Here you can view your credit balance and account status",
    placement: 'left'
  },
  {
    element: "#nav-login-company",
    title: "MY COMPANY",
    content: "Here you can view the profile of your company",
    placement: 'left'
  }, 
  {
    element: "#nav-login-inbox",
    title: "MY INBOX",
    content: "Here you can view, compose and send messages to other companies on the Prokakis system",
    placement: 'left'
  },  
  {
    element: "#nav-login-switch-company",
    title: "SWITCH A COMPANY",
    content: "Here you can switch to one of your other registered companies",
    placement: 'left'
  },   
  {
    element: "#nav-login-referrals",
    title: "REFERRALS",
    content: "Here you can view the affiliate program and the status of your referrals",
    placement: 'left'
  },  
  {
    element: "#nav-login-share-friend",
    title: "SHARE TO FRIEND",
    content: "Here you can email a friend with your referral link so they can join you on the Prokakis system",
    placement: 'left'
  },  
  {
    element: "#nav-login-logout",
    title: "LOGOUT",
    content: "This will log you out of the prokakis system",
    placement: 'left',
    onNext: function(){
        $('#nav-login-dropdown').removeClass('open');
        return false;
    },
  },  
  {
    element: "#home-enhance-profile",
    title: "Enhance Profile",
    content: "It will redirect you to a page where you can edit your company information"

  },  
  {
    element: "#home-topup",
    title: "Top Up",
    content: "It will redirect you to a page where you can purchase credit",
    placement: 'left',
  }, 
  {
    element: "#home-pending",
    title: "Pending Profile Request",
    content: "A notification regarding profile request that needs your approval"
  },  
  {
    element: "#home-awaiting",
    title: "Awaiting Response",
    content: "A notification regarding profile request that needs your approval"
  },  
  {
    element: "#home-oppor",
    title: "Opportunity Inbox",
    content: "A notification for incoming message reagrding your opportunity. Clicking this block will redirect you to the prokakis chat page"
  },
  {
    element: "#home-ongoing",
    title: "Ongoing Monitoring",
    content: "A notification for ongoing monitoring"
  },
  {
    element: "#home-generated",
    title: "Generated Report",
    content: "Status for total reports that being generated"
  },
  {
    element: "#home-completed",
    title: "Completed Report",
    content: "Status for total reports that being completed"
  },
],

  container: "body",
  smartPlacement: true,
  keyboard: true,
  // storage: window.localStorage,
  storage: false,
  debug: true,
  backdrop: true,
  backdropContainer: 'body',
  backdropPadding: 0,
  redirect: true,
  orphan: false,
  duration: false,
  delay: false,
  basePath: "",
  placement: 'auto',

  afterGetState: function (key, value) {},
  afterSetState: function (key, value) {},
  afterRemoveState: function (key, value) {},
  onStart: function (tour) {},
  onEnd: function (tour) {
     $('.menu-dropdown').removeClass('open');
     updateTour('end');
  },
  onShow: function (tour) {},
  onShown: function (tour) {},
  onHide: function (tour) {},
  onHidden: function (tour) {},
  onNext: function (tour) {},
  onPrev: function (tour) {},
  onPause: function (tour, duration) {},
  onResume: function (tour, duration) {},
  onRedirectError: function (tour) {}

});

// Initialize the tour
tour.init();

// Start the tour
if( $('#is_tour').val() == 1 ){
    tour.start();
}

        $(document).ready(function () {
            $(".close").click(function () {
                $(".jumbotron").remove();
            });

            progressBarUpdate(<?php echo $completenessProfile; ?>, 100);

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

    <script>
        $('.counter').each(function () {
            var $this = $(this),
                countTo = $this.attr('data-count');

            $({countNum: $this.text()}).animate({
                    countNum: countTo
                },

                {

                    duration: 8000,
                    easing: 'linear',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                        //alert('finished');
                    }

                });


        });

    function PromoOne(token){
            if(token <= 0){
                swal({
                      title: 'Upgrading your account to premium failed!',
                      text: "Sorry, You dont have sufficient token to upgrade your account. Do you want to purchase a token?",
                      icon: 'warning',
                      buttons: [
                          'No, cancel it!',
                          'Yes, Purchase Now!'
                        ],
                   dangerMode: false,
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            document.location = "{{ route('reportsBuyTokens') }}"
                        } else {
                            swal("Cancelled", "Upgrading to premium was cancelled :)", "error");
                        }

                      })

                    return false;
            }

            swal({

                title: "Are you sure to upgrade your account?",

                text: "You are about to upgrade to premium account.",

                icon: "warning",

                buttons: [

                  'No, cancel it!',

                  'Yes, I am sure!'

                ],

                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {

                  swal({

                    title: 'Upgrading to premium account',

                    text: 'Done on setting to premium',

                    icon: 'success'

                  }).then(function() {
                    document.location = "{{ route('promoOneToken') }}"
                  });

                } else {

                  swal("Cancelled", "Upgrading to premium was cancelled :)", "error");

                }

              })


        }


    </script>
@endsection
