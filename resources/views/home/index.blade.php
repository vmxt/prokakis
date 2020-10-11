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
            display: none;
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


    .hero-image {
        <?php if(isset($profileCoverPhoto)){ ?>
            background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url("{{ asset('public/banner/') }}/<?php echo $profileCoverPhoto; ?>");
        <?php } ?>

        height: 300px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        margin-bottom: 20px;
    }

    .hr-sect {
        display: flex;
        flex-basis: 100%;
        align-items: center;
        color: black;
        margin: 8px 0px;
        font-size: 20px;
    }
    .hr-sect::before,
    .hr-sect::after {
        content: "";
        flex-grow: 1;
        background: rgba(0, 0, 0, 0.35);
        height: 1px;
        font-size: 2px;
        line-height: 0px;
        margin: 0px 8px;
    }

    .hr-sect strong{
        color: #1a4275;
    }

    .card-flex{
        display: flex;
    }

    .viewBtn{
        position: absolute;
        right: 2%;
    }

    .viewBtn a{
        font-size: 1vw !important;
        margin-top: -5px;
    }
    .embed-container { padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }

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
        bottom: -70px;
        
    }

    .profile-img img {
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.07);
        height: 158px;
        padding: 5px;
        width: 158px;
    }

    @media (min-width: 320px) and (max-width: 480px) {
        .profile-img img {
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
    </style>
        <div class="container">
            <div class="bootstrap row justify-content-center">
{{--                 <div class="bootstrap col-md-12">
                    <div class="hero-image" >
                    </div>
                </div> --}}
            <div class="col-md-12" id="banner"  style="margin-bottom:80px;">
                <div class="card text-white fb-profile-block imghov" id="theBanner" style="max-height: 380px; max-width: 1140px; position: relative;">
                    <div class="fb-profile-block-thumb hero-image">
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


                    </div>
                </div>
            </div>

            </div>
        </div>


    <div class="container">
        <div class="bootstrap row justify-content-center">
            <div class="bootstrap col-md-9">
                <div  id='followBusinessNews'>
<!--- \\\\\\\BUSINESS NEWS-->
                    @if($businessNewsData->count() > 0)
                        <div class="hr-sect opp_type"  >Business News</div>
                    @endif
                    @foreach($businessNewsData as $businessNews)
                        <div class="bootstrap page-content-inner">
                            <div class="bootstrap mt-content-body">
                                <div class="bootstrap portlet light h-effect">
                                    <div class="bootstrap card gedf-card">
                                        <div class="bootstrap card-header">
                                            <div class="bootstrap d-flex justify-content-between align-items-center">
                                                <div class="bootstrap d-flex justify-content-between align-items-center">
                                                    <div class="bootstrap mr-2">
<?php 
                                $avatar = $businessNews['content']['feature_image'];
                                if (!$avatar) 
                                    $avat = asset('public/images/industry')."/guest.png";
                                else 
                                    $avat = asset('public/company/feature_images')."/".$avatar;
                                $avatarUrl = $avat;
                                $dt = Carbon\Carbon::parse($businessNews['updated_at']);

?>
                                                        <img class="bootstrap rounded-circle" width="45" src="{{ $avatarUrl }}">
                                                    </div>
                                                    <div class="bootstrap ml-2">
                                                        {{-- <div class="bootstrap h5 m-0">{{ $businessNews->business_title }}</div> --}}
                                                        <div class="bootstrap h7 text-muted">{{ $dt->diffForHumans() }}</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="bootstrap card-body card-flex">
                                            {{-- <div class="bootstrap text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{ $dt->diffForHumans() }}</div> --}}
                                         {{--    <a class="bootstrap card-link" href="#">
                                                <h5 class="bootstrap card-title">{{ $businessNews->business_title }}</h5>
                                            </a> --}}
                                            <div class="bootstrap card-text">
                                                {{ $businessNews['content']['business_title'] }}
                                            </div>
                                            <div class="viewBtn">
                                                <a href="#"  class="btn btn-info">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                 </div>
<!--- \\\\\\\BUSINESS NEWS-->

<!--- \\\\\\\TOP BUSINESS NEWS-->
            <div id='topBusinessNews' >
            @if($topBusinessNewsOpportunity->count() > 0)
                <div class="hr-sect opp_type"   >Top 5 Business News</div>
            @endif
            @foreach($topBusinessNewsOpportunity as $topbusinessNews)
                <div class="bootstrap page-content-inner">
                    <div class="bootstrap mt-content-body">
                        <div class="bootstrap portlet light h-effect">
                            <div class="bootstrap card gedf-card">
                                <div class="bootstrap card-header">
                                    <div class="bootstrap d-flex justify-content-between align-items-center">
                                        <div class="bootstrap d-flex justify-content-between align-items-center">
                                            <div class="bootstrap mr-2">
<?php 
                        $avatar = $topbusinessNews->feature_image;
                        if (!$avatar) 
                            $avat = asset('public/images/industry')."/guest.png";
                        else 
                            $avat = asset('public/company/feature_images')."/".$avatar;
                        $avatarUrl = $avat;
                        $dt = Carbon\Carbon::parse($topbusinessNews->updated_at);

?>
                                            <img class="bootstrap rounded-circle" width="45" src="{{ $avatarUrl }}" onerror="this.src='{{ asset('public/images/industry')."/guest.png" }}';">
                                            </div>
                                            <div class="bootstrap ml-2">
                                                {{-- <div class="bootstrap h5 m-0">{{ $businessNews->business_title }}</div> --}}
                                                <div class="bootstrap h7 text-muted">{{ $dt->diffForHumans() }}</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="bootstrap card-body card-flex">
                                    {{-- <div class="bootstrap text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{ $dt->diffForHumans() }}</div> --}}
                                 {{--    <a class="bootstrap card-link" href="#">
                                        <h5 class="bootstrap card-title">{{ $businessNews->business_title }}</h5>
                                    </a> --}}
                                    <div class="bootstrap card-text">
                                        {{ $topbusinessNews->business_title }}
                                    </div>
                                    <div class="viewBtn">
                                        <a href="#"  class="btn btn-info">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
<!--- \\\\\\\TOP BUSINESS NEWS-->

<!--- \\\\\\\Opportunity-->
            <div id='followedOpportunities' >
            @if($oppResultdata->count() > 0)
            <div class="hr-sect opp_type"  >Opportunity</div>
            @endif
            @foreach($oppResultdata as $val)
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
                        $oppid = $val['content']['oppo_id'];


?>
                                                    <img class="bootstrap rounded-circle" width="45" src="{{ $avatarUrl }}" alt="">
                                                </div>
                                                <div class="bootstrap ml-2">
                                                    <div class="bootstrap h5 m-0">{{ strtoupper($val['state']) }}</div>
                                                    <div class="bootstrap h7 text-muted">{{ $val['content']['opp_title'] }}</div>
                                                </div>
                                                <div class="viewBtn ">
                                                    <a href="{{ route('opportunityExploreIndex')."?type=build&ids=".$oppid }}"  class="btn btn-info">View</a>
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
                                    <div class="bootstrap card-body  ">
                                        <div class="bootstrap text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{ $dt->diffForHumans() }}</div>
               {{--                          <a class="bootstrap card-link" href="#">
                                            <h5 class="bootstrap card-title">Lorem ipsum dolor sit amet, consectetur adip.</h5>
                                        </a> --}}
                                        <div class='card-flex'>
                                            <div class="bootstrap card-text">
                                                {{ $val['content']['intro_describe_business']  }}
                                            </div>
{{--                                             <div class="viewBtn ">
                                                <a href="#"  class="btn btn-info">View</a>
                                            </div> --}}
                                        </div>
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
            @endforeach
            </div>
<!--- \\\\\\\Opportunity-->


<!--- \\\\\\\Youtube - videos-->
<?php 

            $embedVideo = App\Configurations::where('code_name','video_link_advertisement')->first();
            $embedVideo2 = explode(',',$embedVideo->json_value );
?>
            @if( $embedVideo->count() > 0 and $embedVideo->json_value)
            <div class="hr-sect opp_type"  >Video</div>
            <div id="video-ads">
            @foreach($embedVideo2 as $val)
                <div class="bootstrap page-content-inner">
                    <div class="bootstrap mt-content-body">
                        <div class="bootstrap portlet light h-effect">
                                 <!--- \\\\\\\Post-->
                                <div class="bootstrap card gedf-card">
                                    <div class="bootstrap card-header">
                                        <div class="bootstrap d-flex justify-content-between align-items-center">

                                            <div class="bootstrap d-flex justify-content-between align-items-center">
                                             {{--    <div class="bootstrap mr-2">
                                                    <img class="bootstrap rounded-circle" width="45" src="{{ $avatarUrl }}" alt="">
                                                </div> --}}
                                                <div class="bootstrap ml-2">
                                                    {{-- <div class="bootstrap h5 m-0">{{ strtoupper($val['state']) }}</div> --}}
                                                    <div class="bootstrap h7 text-muted">Title</div>
                                                </div>
{{--                                                 <div class="viewBtn ">
                                                    <a href="{{ route('opportunityExploreIndex')."?type=build&ids=".$oppid }}"  class="btn btn-info">View</a>
                                                </div> --}}
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
                                    <div class="bootstrap card-body  ">

               {{--                          <a class="bootstrap card-link" href="#">
                                            <h5 class="bootstrap card-title">Lorem ipsum dolor sit amet, consectetur adip.</h5>
                                        </a> --}}
                                        <div class='card-flex'>
                                            <div class="bootstrap card-text card-video embed-container">
                                                {!! $val !!}
                                            </div>
{{--                                             <div class="viewBtn ">
                                                <a href="#"  class="btn btn-info">View</a>
                                            </div> --}}
                                        </div>
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
            @endforeach
            </div>
            @endif
<!--- \\\\\\\Youtube - videos-->


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
                                    <div class="bootstrap h5">{{ $followerCount }}</div>
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
        <!--- \\\\\\\BUSINESS NEWS-->

    </div>

 <div class='intro-tour-overlay'></div>
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
    element: ".hero-image",
    title: "Banner",
    content: "You can change this banner at \"Edit Company\" under Company navigation",
       placement: 'bottom'
  },
  {
    element: "div.profile-img a img",
    title: "Profile Image",
    content: "You can change your profile Image at \"Edit Company\" under Company navigation"
  },
    {
    element: "#followBusinessNews",
    title: "Followed Business News",
    content: "This are the top 5 business news of the company you followed",
    placement: 'top'
  },
  {
    element: "#topBusinessNews",
    title: "Top Business News",
    content: "Display the most recent top 5 business news",
    placement: 'top'
  },
  {
    element: "#followedOpportunities",
    title: "Opportunity",
    content: "This are the top 5 opportunities of the companies you followed",
       placement: 'top'
  },
  {
    element: "#video-ads",
    title: "Video Advertisement",
    content: "Helpful videos to help you on your",
       placement: 'top'
  },

],

  container: "body",
  smartPlacement: false,
  keyboard: true,
  // storage: window.localStorage,
  storage: false,
  debug: false,
  backdrop: true,
  backdropContainer: 'body',
  backdropPadding: 0,
  redirect: false,
  orphan: false,
  duration: false,
  delay: false,
  basePath: "",
  placement: 'auto',
    autoscroll: true,
  afterGetState: function (key, value) {},
  afterSetState: function (key, value) {},
  afterRemoveState: function (key, value) {},
  onStart: function (tour) {},
  onEnd: function (tour) {
     $('.intro-tour-overlay').hide();
      $('html').css('overflow','unset')
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
    $('html').css('overflow','visible');
     $('.intro-tour-overlay').show();
    tour.start();
}

        $(document).ready(function () {
            $(".close").click(function () {
                $(".jumbotron").remove();
            });
        });

    </script>
{{-- 
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


    </script> --}}
@endsection
