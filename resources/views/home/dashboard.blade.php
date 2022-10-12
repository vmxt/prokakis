@extends('layouts.app')

<style>
    


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
            border-color: ##7cda24;
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
            background-color: #dff7d9;
            border-color: ##7cda24;
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

        .:hover {
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

        . a{
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

@media (max-width: 1200px) {
  .pie{
    margin: 0 auto;
  }
  .card .col-md-4{
    width: 100%;
  }
  #home-enhance-profile{
    margin-top: 1px !important;
    margin-left: 39%;
  }

  .widget-row {
        column-count: 3;
  }

  .block-icon{
  }

  .widget-thumb {
    height: 25vh;
    }

}

@media (max-width: 720px) {
 .widget-row {
        column-count: 1;
  }
  .block-icon{
  }
}

@media (max-width: 520px) {
  #home-enhance-profile{
    margin-left: 35%;
  }
}
bg-dark
@media (max-width: 375px) {
  #home-enhance-profile{
    margin-left: 25%;
  }
}

@media (max-width: 320px) {
  #home-enhance-profile{
    margin-left: 20%;
  }
}

.red-mint{
    background-color:black !important;
    border-color:black !important;
}

.bg-dark{
    color:#7cda24 !important;
}

.list-group-item:hover{
    box-shadow: 0 0 11px #7cda24 !important; 
}

.widget-thumb{
    border:1px solid silver;
}

.widget-thumb-wrap{
    
}

.widget-thumb .widget-thumb-heading{
    color:black !important;
    min-height:2em;
}
.counter{
    color:black !important;
    font-size:35px;
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
            <div class="col-md-8 block-icon">
                <!-- graph card -->
                <div class="page-content-inner" style="border:1px solid silver"> 
                    <div class="mt-content-body">
                        <div class="portlet light ">
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
                                        <div class="alert bg-intellinz-light-green text-company"
                                             style="width: 100%; overflow: hidden; margin-left: 0px !important;"><p>
                                                <strong>Intellinz members are three times more likely
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
                                        <div>
                                        <a id="home-enhance-profile" href="{{ route('editProfile') }}" class="btn red-mint"
                                           style="margin-top: 15px;">Enhance
                                            Profile</a>
</div>
                    

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <!-- widgets -->

                <div class="row widget-row">
                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div id="home-pending" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 card">
                            <h4 class="widget-thumb-heading">PENDING PROFILE REQUEST</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-dark fa fa-clock-o"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden"></span>
                                    <span class="widget-thumb-body-stat" style="">
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
                        <div id="home-awaiting" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">AWAITING RESPONSE</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-dark fa fa-reply-all"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden"></span>
                                    <span class="widget-thumb-body-stat" style="">
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
                        <div id="home-oppor" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <a href='{{  url('/opportunity/chatbox') }}'>
                            <h4 class="widget-thumb-heading">OPPORTUNITY INBOX</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-dark fa fa-envelope" aria-hidden="true"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span>
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
                        <div id="home-ongoing" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">ONGOING MONITORING</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-dark fa fa-eye" aria-hidden="true"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> 
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
                        <div id="home-generated" class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">GENERATED REPORT</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-dark icon-layers"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> 
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
                        <div id='home-completed' class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">COMPLETED REPORT</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-dark fa fa-newspaper-o"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> 
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


            <div class="col-md-4 block-icon" style="min-height:800px;">
                <!-- sidebar token credit -->
                <div class="page-content-inner" style="border:1px solid silver">
                    <div class="mt-content-body">
                        <div class="portlet light ">
                            <div class="card" style="overflow: hidden;">
                                <div class="card-header" style="margin-bottom: 25px;">
                                    <center><span class="bold uppercase text-company ">Credit Status</span>
                                        <hr>
                                    </center>
                                </div>
                                <div class="card-body center" style="text-align: center;">
                                    <b class="" style="font-size: 20px;"> <?php
                                        $with_s = "";
                                        
                                        $user_id = Auth::id();
                                        $company_id_result = App\CompanyProfile::getCompanyId($user_id);
                                        $valid_token = 0;
                                        if (App\SpentTokens::validateTokenStocks($company_id_result) == false) {
                                            echo "0";
                                        } else {
                                            $consumedTokens = App\SpentTokens::validateTokenStocks($company_id_result);
                                            $valid_token = $consumedTokens;
                                            echo $consumedTokens;
                                            
                                            
                                            if($consumedTokens > 0){
                                                $with_s = "s";
                                            }
                                        }
                                        ?>  </b> <br/>
                                    Credit<?php echo $with_s; ?> Left <br/>
                                    <div class="col-sm-12">
                                        <a id='home-topup' href="{{ route('reportsBuyCredits') }}" class="btn red-mint"
                                           style="width: 100%;">Top Up</a>
                                    </div>
                                       
                                            <?php if($valid_token >= 120){ ?>
                                                <?php if( App\SpentTokens::validateLeftBehindToken($company_id_result) == false ){  ?>
                                                <a onclick="PromoOne('{{ $valid_token }}')" class="bg-intellinz-light-green btn yellow btn-full"
                                                    style="margin-top: 15px; width: 90%;"> <i class="fa" style="color: white;"></i> Upgrade To Premium Account 
                                                </a>
                                            <?php }else{ ?>
                                                <a onclick="alreadyPremium()" class="bg-intellinz-light-green btn yellow btn-full"
                                                    style="margin-top: 15px; width: 90%;"> <i class="fa" style="color: white;"></i> Upgrade To Premium Account 
                                                </a>
                                            <?php } ?>
                                            <?php }else{ ?>
                                                <a onclick="noCredits()" class="bg-intellinz-light-green btn yellow btn-full"
                                                    style="margin-top: 15px; width: 90%;"> <i class="fa" style="color: white;"></i> Upgrade To Premium Account 
                                                </a>
                                            <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Log activity sidebar -->

                <div class="panel " style="border:1px solid silver">
                    <div class="panel-heading bg-dark ">
                        <span class="caption-subject  bold uppercase text-white"> <i class="fa fa-tv"></i> recent activities</span>
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
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm bg-dark">
                                                    <i class="fa fa-bell-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div style="color:black !important" class="desc"> <?php echo $activity?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date"> <span style="font-size: 9px"><?php  echo $date; ?></span></div>
                                    </div>
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
    <script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>
 <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
// Instance the tour
var tour = new Tour({
  steps: [
  
  {
    element: "#home-enhance-profile",
    title: "Enhance Profile",
    content: "It will redirect you to a page where you can edit your company information",
    placement: 'right',
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
    content: "A notification regarding profile request that needs your approval",
    placement: 'bottom',
  },  
  {
    element: "#home-awaiting",
    title: "Awaiting Response",
    content: "A notification regarding profile request that needs your approval",
    placement: 'top',
  },  
  {
    element: "#home-oppor",
    title: "Opportunity Inbox",
    content: "A notification for incoming message reagrding your opportunity. Clicking this block will redirect you to the Intellinz chat page",
    placement: 'top',
  },
  {
    element: "#home-ongoing",
    title: "Ongoing Monitoring",
    content: "A notification for ongoing monitoring",
    placement: 'top',
  },
  {
    element: "#home-generated",
    title: "Generated Report",
    content: "Status for total reports that being generated",
    placement: 'top',
  },
  {
    element: "#home-completed",
    title: "Completed Report",
    content: "Status for total reports that being completed",
    placement: 'top',
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
  orphan: true,
  duration: false,
  delay: false,
  basePath: "",
  //placement: 'auto',
autoscroll: true,
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
            
            $(".widget-thumb").each(function() {
                $(this).css('height', $(".widget-thumb:eq(0)").css('height'));
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
        
    function alreadyPremium(){
        swal("Warning!", "You are already a premium account user.", "warning");
    }
        
    function noCredits(){
        swal({
                      title: 'Upgrading your account to premium failed!',
                      text: "Sorry, You dont have sufficient credit to upgrade your account. Upgrading needs 120 credits. Do you want to purchase a credits?",
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

                      });
    }

    function PromoOne(token){
            
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
