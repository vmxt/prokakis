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

    <link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/dashboard.css') }}">
{{-- 
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script> --}}

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

        <div class="bootstrap row justify-content-center">
            <div class="bootstrap col-md-9">
               {{ $data->links() }}   

            @foreach($data as $val)
 
            @if($val['state'] == 'company')
                <!-- graph card -->
                <div class="bootstrap page-content-inner">
                    <div class="bootstrap mt-content-body">
                        <div class="bootstrap portlet light h-effect">
                                 <!--- \\\\\\\Post-->
                                <div class="bootstrap card gedf-card">
                                    <div class="bootstrap card-header">
                                        <div class="bootstrap d-flex justify-content-between align-items-center">
                                            <div class="bootstrap d-flex justify-content-between align-items-center">
                                                <div class="bootstrap mr-2">
<?php 
                        $avatar = \App\UploadImages::where('company_id', $val['content']['company_id'])->where('file_category', 'PROFILE_AVATAR')
                            ->orderBy('id', 'desc')
                            ->first();
                        $avat = '';
                        if (!isset($avatar->file_name)) 
                            $avat = asset('public/images/industry')."/guest.png";
                        else 
                            $avat = asset('public/images')."/".$avatar->file_name;
                        $avatarUrl = $avat;
                        $dt = Carbon\Carbon::parse($val['updated_at']);


?>
                                                    <img class="bootstrap rounded-circle" width="45" src="{{ $avatarUrl }}" alt="">
                                                </div>
                                                <div class="bootstrap ml-2">
                                                    <div class="bootstrap h5 m-0">{{ strtoupper($val['state']) }}</div>
                                                    <div class="bootstrap h7 text-muted">{{ $val['content']['company_name'] }}</div>
                                                </div>
                                            </div>
    {{--                                         <div>
                                                <div class="bootstrap dropdown">
                                                    <button class="bootstrap btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="bootstrap dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                                        <a class="bootstrap dropdown-item" href="#">View Profile</a>
                                                        <a class="bootstrap dropdown-item" href="#">Unfollow</a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>

                                    </div>
                                    <div class="bootstrap card-body">
                                        <div class="bootstrap text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{ $dt->diffForHumans() }}</div>
                                        <a class="bootstrap card-link" href="#">
                                            <h5 class="bootstrap card-title">Lorem ipsum dolor sit amet, consectetur adip.</h5>
                                        </a>

                                        <p class="bootstrap card-text">
                                            {{ $val['content']['description']  }}
                                        </p>
                                    </div>
{{--                                     <div class="bootstrap card-footer">
                                        <a href="#" class="bootstrap card-link"><i class="fa fa-gittip"></i> Like</a>
                                        <a href="#" class="bootstrap card-link"><i class="fa fa-comment"></i> Comment</a>
                                        <a href="#" class="bootstrap card-link"><i class="fa fa-mail-forward"></i> Share</a>
                                    </div> --}}
                                </div>
                                <!-- Post /////-->

                    
                           
                        </div>
                    </div>
                </div>
                 <!-- graph card -->
            @else
                <!-- graph card -->
                <div class="bootstrap page-content-inner">
                    <div class="bootstrap mt-content-body">
                        <div class="bootstrap portlet light h-effect">
                                 <!--- \\\\\\\Post-->
                                <div class="bootstrap card gedf-card">
                                    <div class="bootstrap card-header">
                                        <div class="bootstrap d-flex justify-content-between align-items-center">
                                            <div class="bootstrap d-flex justify-content-between align-items-center">
                                                <div class="bootstrap mr-2">
<?php 

                        $industryImage = App\OppIndustry::find($val['content']['industry']);
                        if($industryImage){
                            $avatarName = $industryImage->image;
                            $avatarUrl = asset('public/images/industry')."/".$avatarName;
                        }else{
                            $avatarUrl = asset('public/images/industry')."/guest.png";
                        }
                        $dt = Carbon\Carbon::parse($val['updated_at']);


?>
                                                    <img class="bootstrap rounded-circle" width="45" src="{{ $avatarUrl }}" alt="">
                                                </div>
                                                <div class="bootstrap ml-2">
                                                    <div class="bootstrap h5 m-0">{{ strtoupper($val['state']) }}</div>
                                                    <div class="bootstrap h7 text-muted">{{ $val['content']['opp_title'] }}</div>
                                                </div>
                                            </div>
    {{--                                         <div>
                                                <div class="bootstrap dropdown">
                                                    <button class="bootstrap btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="bootstrap dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                                        <a class="bootstrap dropdown-item" href="#">View Profile</a>
                                                        <a class="bootstrap dropdown-item" href="#">Unfollow</a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>

                                    </div>
                                    <div class="bootstrap card-body">
                                        <div class="bootstrap text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{ $dt->diffForHumans() }}</div>
                                        <a class="bootstrap card-link" href="#">
                                            <h5 class="bootstrap card-title">Lorem ipsum dolor sit amet, consectetur adip.</h5>
                                        </a>

                                        <p class="bootstrap card-text">
                                            {{ $val['content']['intro_describe_business']  }}
                                        </p>
                                    </div>
{{--                                     <div class="bootstrap card-footer">
                                        <a href="#" class="bootstrap card-link"><i class="fa fa-gittip"></i> Like</a>
                                        <a href="#" class="bootstrap card-link"><i class="fa fa-comment"></i> Comment</a>
                                        <a href="#" class="bootstrap card-link"><i class="fa fa-mail-forward"></i> Share</a>
                                    </div> --}}
                                </div>
                                <!-- Post /////-->

                    
                           
                        </div>
                    </div>
                </div>
                 <!-- graph card -->


            @endif
            @endforeach
            </div>
            <div class="bootstrap col-md-2" style="min-height:800px;">
                <!-- sidebar token credit -->
                <div class="bootstrap panel h-effect">
                    <div class="bootstrap panel-heading" style="text-align: center;">
                        <span class="bootstrap caption-subject font-blue-steel bold uppercase"> <i class="fa fa-users" style="color: black;"></i> Status </span>
                    </div>
                    <div class="bootstrap panel-body">
                        <div class="bootstrap card">
                            <ul class="bootstrap list-group list-group-flush">
                                <li class="bootstrap list-group-item">
                                    <div class="bootstrap h6 text-muted">Followers</div>
                                    <div class="bootstrap h5">3</div>
                                </li>
                                <li class="bootstrap list-group-item">
                                    <div class="bootstrap h6 text-muted">Following</div>
                                    <div class="bootstrap h5">{{ $followingCount }}</div>
                                </li>
                            </ul>
                        </div>
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
        });

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


    </script>
@endsection
