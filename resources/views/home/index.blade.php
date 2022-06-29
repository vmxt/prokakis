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
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.5) !important;
          cursor: default !important;
          border-radius: 20px !important;
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
        <?php }else{ ?>
             background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url("{{ asset('public/banner/explore_opportunity.jpeg') }}");
        <?php } ?>

        height: 300px;
        background-position: top -20px right;
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
        color: #000000;
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
        .profile-img img{
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
        
        .hero-image{
            background-position: left !important;
        }

    } 
    @media(max-width: 992px){
        .disp-sm{
            flex: inherit !important;
            max-width: inherit !important;
        }
        .disp-lg{
            display: none;
        }

        .content-card{
            max-width: inherit !important;
        }
    }
    @media(min-width: 992px){
        .disp-sm{
            display: none;
        }
    }

    /* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.modal-load {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modal-load {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal-load {
    display: block;
}

.text-company{
    color:#7cda24 !important;
}

.cardborder-radius{
    border-radius: 20px !important;
}

.avatar-radius{
    vertical-align: middle;
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.news_header{
    background:white !important;
}

.news_body{
    padding:10px;
    margin-top:10px;
}

.home_image{
    border-radius:150px;
    border:1px solid silver;
}

.follow_op_div{
    margin-left:30px !important;
    margin-right:30px !important;
    margin-top:1px !important;
    margin-bottom:10px !important;
    padding:0px !important;
}



.opp_outer_div{
        background-repeat: no-repeat;
        background-size: 100% 355px;
        background-position: 0 -50px;
        width: 100%;
        border-radius:20px;
        border:1px solid silver !important
    }
    
.image_div{
    height:180px;
}
    
.opp_inner_div{
         height:100%;
        width:100%;
        background: linear-gradient(185deg,
        transparent  0%, 
        transparent  30%, 
        #7cda24   30.2%, 
        #7cda24   31%, 
        white 31.2%, 
        white 87%);
        background-color:transparent !important;
        border-radius:20px;
        
    }
    
@media (max-width: 767px){
    
}
    
@media (min-width: 768px){
    .opp_outer_div{
        background-position: -100px 0px;
        background-repeat: no-repeat;
        background-size: 43% 100%;
    }
    
     .opp_inner_div{
        background: linear-gradient(89.8deg,
        transparent  0%, 
        transparent  26%, 
        #7cda24   26.1%, 
        #7cda24   27%, 
        white 27.1%, 
        white 85%);
        
    }
    
    .opp_inner_div{
        border:none !important;
    }

}

hr{
    border: 1px solid #7cda24 !important;
}


.story_header{
    border-top-left-radius:20px;
    border-top-right-radius:20px;
    background:black !important;
    
}

.story_header .bootstrap.h7.text-muted{
    color:#7cda24 !important;
}

.hr-sect.opp_type{
    text-transform:uppercase !important;
    font-weight:bold;
}

.gedf-card{
    border:1px solid silver !important;
}
    </style>
    
    
    

    <?php 
    $u = App\User::find(Auth::id());
    if($u->m_id == null || $u->m_id == 0){
    ?>

        <div class="container">
            <div class="bootstrap row justify-content-center">
{{--                 <div class="bootstrap col-md-12">
                    <div class="hero-image" >
                    </div>
                </div> --}}

            <div class="col-md-12" id="banner"  style="margin-bottom:80px;">
                <div class="card text-white fb-profile-block imghov" id="theBanner" style="max-height: 380px; max-width: 1140px; position: relative; border: 0px">
                    <div class="fb-profile-block-thumb hero-image cardborder-radius">
                    </div>

                    <div class="card-img">
                        <div class="profile-img cardborder-radius" >
                            <?php if($profileAvatar != null){  ?>
                            <a style='background: none' href="#"><img style='border-radius: 20px; border: 1px solid silver' class='' src="{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>"
                                             alt="Card image"> </a>
                            <?php } else { ?>
                            <a style='background: none' href="#"><img style='border-radius: 20px; border: 1px solid silver' src="{{ asset('public/images/robot.jpg') }}" alt="Card image">
                                <?php } ?> </a>
                        </div>


                    </div>
                </div>
            </div>

            </div>
        </div>

    <?php 
    }
    ?>    

    <div class="container">
        <div class="bootstrap row justify-content-center">

            <div class="bootstrap col-md-2 disp-sm" >
                <!-- sidebar token credit -->
                <div class="bootstrap page-content-inner">
                            <div class="bootstrap mt-content-body">
                                <div class="bootstrap portlet light h-effect">
                                    <div class="bootstrap card gedf-card cardborder-radius">
                                        <div class="bootstrap card-body" style="text-align: center;">
                                            <h3 class="bootstrap caption-subject font-blue-steel bold uppercase"> <i class="fa fa-users" style="color: black;"></i> Status</h3>
                                        </div>
                                        <div class="bootstrap card-body">
                                                <ul class="bootstrap list-group list-group-flush">
                                                    <li class="bootstrap list-group-item">
                                                        <div class="bootstrap h3 "><b>Followers</b></div>
                                                        <div class="bootstrap h2">{{ $followerCount }}</div>
                                                    </li>
                                                    <li class="bootstrap list-group-item">
                                                        <div class="bootstrap h3 "><b>Following</b></div>
                                                        <div class="bootstrap h2">{{ $followingCount }}</div>
                                                    </li>
                                                </ul>
                                        </div>

                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            
 
            <div class="bootstrap col-md-10 content-card">
                <div id="top_opps_div">
                    <div class="hr-sect opp_type"  >Top 5 Opportunities</div>
                
                
                <?php 
                    $obc = App\OpportunityBuildingCapability::where('status', 1)
                     ->where('intro_describe_business', '!=', null)
                     ->where('ideal_partner_base', '!=', null)
                     
                     ->inRandomOrder()->take(4)
                     ->orderBy('id', 'desc')
                     ->get();
                     //->limit(10)
                     //->get();
                     
                     $ob =  App\OpportunityBuy::where('status', 1)
                     ->where('intro_describe_business', '!=', null)
                     ->where('ideal_partner_base', '!=', null)
                     
                     ->inRandomOrder()->take(4)
                     ->orderBy('id', 'desc')
                     ->get();
                     //->limit(10)
                     //->get();
                     
                     $oso = App\OpportunitySellOffer::where('status', 1)
                     ->where('intro_describe_business', '!=', null)
                     ->where('ideal_partner_base', '!=', null)
                     
                     ->inRandomOrder()->take(4)
                     ->orderBy('id', 'desc')
                     ->get();
                     //->limit(10)
                     //->get();
        
                    $resOpp = $obc->merge($ob)->merge($oso);
        
                            
                    $result = array('result'=>'success');
                    $oppCount = 1;
                    foreach($resOpp as $d){
                        if($oppCount <= 5){
                            $cc = [];
                            $c_country = "";       
                            if(strlen($d->ideal_partner_base) > 0){
                                $cc = explode(",",$d->ideal_partner_base);
                                if(isset($cc[0])){
                                    $c_country = $c_country . $cc[0];   
                                }
                                if(isset($cc[1])){
                                $c_country = $c_country . ','.$cc[1];
                                }
                                if(isset($cc[2])){
                                $c_country = $c_country . ','.$cc[2];
                                }
                            }  
        
                            if($d->is_anywhere == 1){
                                $c_country = "Anywhere";
                            }
                            $keyword = explode(",", $d->relevant_describing_partner);
                            $hashKey ="";
                             if( $d->relevant_describing_partner ){
                                 foreach ($keyword as $val ) {
                                    if($val!="")
                                     $hashKey .= '#'.str_replace(' ','_',$val)." ";
                                 }
                             }
                             
                             $appurl = env('APP_URL');
                             
                            $ttitle = substr($d->opp_title, 0, 33).'..';   
                             $ind =  App\OppIndustry::find($d->industry);
                             $imgSrc = $appurl.'public/images/industry/'.$ind->image;
                             /*$ret[] = array('business_description'=>$d->intro_describe_business, 
                             'country'=>$c_country, 
                             'keyword'=>$hashKey ,
                             'keyword_raw'=>$d->relevant_describing_partner ,
                             'industry_category'=>$ind->text, 
                             'industry_image'=>$imgSrc,
                             'est_revenue'=>$d->est_revenue,
                             'est_profit'=>$d->est_profit,
                             'inventory_value'=>$d->inventory_vaue,
                             'title'=> strtoupper($d->opp_title) );*/
                             ?>
                             
                             <div class="bootstrap page-content-inner">
                                <div class="bootstrap mt-content-body">
                                    <div class="bootstrap portlet light">
                                        <div class="opp_outer_div" style="background-image: url( <?php echo $imgSrc; ?> );">
                                        <div class="opp_inner_div bootstrap card  cardborder-radius  h-effect">
                                            
                                            <div class=" bootstrap card-body card-flex ">
                                                <div class="row w-100 ">
                                                    <div class="image_div col-md-4 p-2" style="background:transparent">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h3 class="upperText mt-2 "  title="{{ $d->opp_title }}"><b>{{ strtoupper($d->opp_title) }}</b></h3>
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 opp-cards">
  
                                                            <div class="col-md-4">
                                                                <ul class="info_list mt-2" style="list-style-type: none;">
                                                                    <li><h4 ><b class="text-company">This Company Is Seeking</b></h4></li>
                                                                    <li><b>{{ $d->audience_target }}</b></li>
                                                                    <li><b>{{ $c_country }}</b></li>
                                                                </ul>
                                                                
                                                            </div>
                                                            <div class="col-md-4">
                                                                <ul class="info_list mt-2" style="list-style-type: none;">
                                                                    <li >Est. Revenue /year</li>
                                                                    <li class="mb-2"><b>{{ App\CurrencyMonetary::currencyConvertion($d->est_revenue, $d->currency) }}</b></li>
                                                                    <li>Est. Profit /year</li>
                                                                    <li class="mb-2"><b>{{ App\CurrencyMonetary::currencyConvertion($d->est_profit,$d->currency) }}</b></li>
                                                                    <li>Inventory value</li>
                                                                    <li class="mb-2"><b>{{ App\CurrencyMonetary::currencyConvertion($d->inventory_value,$d->currency) }}</b></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <ul class="info_list mt-2" style="list-style-type: none;">
                                                                    <li><h4 ><b class="text-company">Asking Price</b></h4></li>
                                                                    <li class="mb-2"><b style="text-decoration:noe">{{ App\CurrencyMonetary::currencyConvertion($d->approx_large,$d->currency) }}</b></li>
                                                                    <li class="mb-2">
                                                                        <div class="learn_more" style="margin-top: 15px;">
                                                                           <button name="{{ $d->opp_title }}" type="button" class="learn_more_btn btn btn-dark  btn-lg "><i class="fa fa-file-text"></i> LEARN MORE</button>
                                                                        </div>    
                                                                    </li>
                                                                </ul>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                             <?php }
                          $oppCount++;
                    }
                ?>
            </div>
            
                <div  id='followBusinessNews'>
<!--- \\\\\\\BUSINESS NEWS-->

                    @if($businessNewsData->count() > 0)
                        <div class="hr-sect opp_type"  >Business News  </div>
                    @endif
                    @foreach($businessNewsData as $businessNews)
                        <div class="bootstrap page-content-inner">
                            <div class="bootstrap mt-content-body">
                                <div class="bootstrap portlet light">
                                    <div class="bootstrap card gedf-card cardborder-radius h-effect ">
                                        <div class="bootstrap card-body story_header">
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
                                                        <img class="bootstrap home_image" class="img-fluid" style="width:40px;height:35px"  src="{{ $avatarUrl }}">
                                                    </div>
                                                    <div style="font-weight:bold !important" class="bootstrap ml-2">
                                                        {{-- <div class="bootstrap h5 m-0">{{ $businessNews->business_title }}</div> --}}
                                                        <div class="bootstrap h7 text-muted">{{ $dt->diffForHumans() }}</div>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        </div>
                                        <div class="bootstrap card-body card-flex">
                                            
                                            <div style="color:black; " class="news_body bootstrap card-text">
                                                {{ $businessNews['content']['business_title'] }}
                                            </div>

                                            </div>
                                        <div class="bootstrap card-body">
                                            <button style="margin-left:10px;margin-bottom:5px" data-toggle="modal" data-target="#follow_bus_news_{{ $businessNews['content']['id'] }}"  class="pull-right btn btn-primary btn-lg "><i class="fa fa-eye"></i> MORE DETAILS</button>
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
                        <div class="bootstrap portlet light ">
                            <div class="bootstrap card gedf-card cardborder-radius h-effect ">
                                
                                <div class="bootstrap card-body story_header " style="">
                                    <div class="bootstrap d-flex justify-content-between align-items-center">
                                        <div class="bootstrap d-flex justify-content-between align-items-center">
                                            <div class="bootstrap mr-2">
                                                <?php 
                                                                        $avatar = $topbusinessNews->feature_image;
                                                                            $avat2 = asset('public/images/industry')."/guest.png";
                                                
                                                                        if (!$avatar) 
                                                                            $avat = asset('public/images/industry')."/guest.png";
                                                                        else 
                                                                            $avat = asset('public/company/feature_images')."/".$avatar;
                                                                        $avatarUrl = $avat;
                                                                        $dt = Carbon\Carbon::parse($topbusinessNews->updated_at);
                                                
                                                ?>
                                            <img class="bootstrap home_image" class="img-fluid" style="width:40px;height:35px"  src="{{ $avatarUrl }}" onerror="this.src='{{ $avat2 }}';">
                                            </div>
                                            <div style="font-weight:bold !important" class="bootstrap ml-2">
                                                <div class="bootstrap h7 text-muted">{{ $dt->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    

                                    </div>
                                <div class="bootstrap card-body ">
                                    
                                    <div style="color:black; " class="news_body bootstrap card-text">
                                        {{ $topbusinessNews->business_title }}
                                    </div>
                                </div>
                                <div class="bootstrap card-body ">
                                         <a href="#" data-toggle="modal" 
                                         data-target="#bus_news_{{ $topbusinessNews->id }}" style="margin-left:10px;margin-bottom:5px" class="pull-right btn btn-primary btn-lg "><i class="fa fa-eye"></i> MORE DETAILS</a>
                                 
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
            <div class="hr-sect opp_type"  >Followed Company's Opportunities</div>
            @endif
            @foreach($oppResultdata as $val)
                <div class="bootstrap page-content-inner">
                    <div class="bootstrap mt-content-body">
                        <div class="bootstrap portlet light ">
                                 <!--- \\\\\\\Post-->
                                <div class="bootstrap card gedf-card cardborder-radius h-effect">
                                    <div class="bootstrap card-body story_header">
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
                                                <img class="bootstrap home_image" class="img-fluid" style="width:35px;height:35px" src="{{ $avatarUrl }}" alt="">
                                                </div>
                                                <div class="bootstrap ml-2">
                                                    <div class="bootstrap h5 m-0  text-company"><h4><b class="">{{ strtoupper($val['state']) }}</b></h4></div>
                                                    <div style="font-weight:bold;text-transform:uppercase" class="bootstrap h7 text-white">{{ $val['content']['opp_title'] }}</div>
                                                </div>
                
                                            </div>
   
                                        </div>
                                    
                                    </div>
                                    <div class="follow_op_div card-body  ">
                                        
                                        <div class="bootstrap text-muted h7 mb-2 mt-4"> <i class="fa fa-clock-o">&nbsp;</i>{{ $dt->diffForHumans() }}</div>
               
                                        <div class='card-flex'>
                                            <div class="bootstrap card-text">
                                                {{ $val['content']['intro_describe_business']  }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bootstrap card-body">
                                            <button name="{{ $val['content']['opp_title'] }}" style="margin-left:10px;margin-bottom:5px" class="pull-right learn_more_btn btn-primary btn-lg "><i class="fa fa-eye"></i> MORE DETAILS</button>
                                       
                                    </div>
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
            $embedVideo2 = [];
            $embedVideo = App\Configurations::where('code_name','video_link_advertisement')->first();
            if($embedVideo){
            $embedVideo2 = explode(',',$embedVideo->json_value );
                $embedVideoCount = $embedVideo->count();
            }else{
                $embedVideoCount = 0;
            }
            
?>
            @if( $embedVideoCount > 0 and $embedVideo->json_value)
            <div class="hr-sect opp_type"  >Video</div>
            <div id="video-ads">
            @foreach($embedVideo2 as $val)
                <div class="bootstrap page-content-inner">
                    <div class="bootstrap mt-content-body">
                        <div class="bootstrap portlet light ">
                                 <!--- \\\\\\\Post-->
                                <div class="bootstrap card gedf-card cardborder-radius h-effect">
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


            <div class="bootstrap col-md-2 disp-lg" style="">
                
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="bootstrap card gedf-card cardborder-radius">
                            <div  class="bootstrap card-body " style="text-align: center;margin-bottom:5px;padding-bottom:1px;">
                                <h4 class="bootstrap caption-subject bold uppercase">  FOLLOWERS </h4>
                            </div>
                            <div style="text-align:center" class="bootstrap card-body">
                                <div class="bootstrap h1 m-0"><h1><i class="fa fa-users" style="color: black;"></i> <b> {{ $followerCount }}</b></h1></div>
                            </div>
        
        
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="bootstrap card gedf-card cardborder-radius">
                            <div  class="bootstrap card-body " style="text-align: center;margin-bottom:5px;padding-bottom:1px;">
                                <h4 class="bootstrap caption-subject bold uppercase">  FOLLOWING </h4>
                            </div>
                            <div style="text-align:center" class="bootstrap card-body">
                                <div class="bootstrap h1 m-0"><h1><i class="fa fa-user-plus" style="color: black;"></i><b> {{ $followingCount  }}</b></h1></div>
                            </div>
        
        
                        </div>
                    </div>
                </div>
                
            </div>


        </div>
        <!--- \\\\\\\BUSINESS NEWS-->

    </div>

@foreach($topBusinessNEws as $d)
<!-- Modal top business news -->
<div class="modal" id="bus_news_{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="BusinenessNewsTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="BusinenessNewsTitle">{{ $d->business_title }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p> {!! $d->content_business !!} </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach


@foreach($businessNewsData as $businessNews)
<div class="modal" id="follow_bus_news_{{ $businessNews['content']['id'] }}" tabindex="-1" role="dialog" aria-labelledby="FollowBusinenessNewsTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="FollowBusinenessNewsTitle">{{ $businessNews['content']['business_title'] }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p> {!! $businessNews['content']['content_business'] !!} </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<div class="modal-load"><!-- Place at bottom of page --></div>


 <div class='intro-tour-overlay'></div>
    <script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>
 <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
    
    function scroll_html(){
        var val = parseInt($(".popover").scrollTop() );
        
        $("body").scrollTop( val + 1 );
    }
    
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
        $('#nav-high-risk-list').removeClass('active');
    }
  },
  {
    element: "#nav-high-risk-list",
    title: "HIGH RISK PROFILE",
    content: "Here you can view a list of high risk profile",
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
    content: "This has a list of links and utilities about opportunities on the Intellinz system",
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
    content: "Here you can view the most recent build, sell and buy opportunities on the Intellinz system",
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
    element: "#nav-report-requester",
    title: "REPORT REQUESTER",
    content: "Here you can view the company information of someone who is requesting a report from you",
    onNext: function(){
        $("#nav-login-dropdown").click();
        
        $('#nav-report').removeClass('open');
        $('#nav-report').removeClass('active');
        
        //$("#nav-login-dropdown").addClass('open');
        
    },
  },
  {
    element: "#header_inbox_bar",
    title: "INBOX",
    content: "Here you can view, compose and send messages to other companies on the Intellinz system",
    placement: 'left',
  },
  {
    element: "#nav-login-dropdown",
    name:"nav-login-dropdown",
    title: "USER MENU",
    content: "Click here to show the links for your account",
    placement: 'left',
    onNext: function(){
        $("#nav-login-dropdown").addClass('open');
    },
  },
  {
    element: "#nav-login-account-credit",
    name:"nav-login-account-credit",
    title: "ACCOUNT AND CREDIT",
    content: "Here you can view your credit balance and account status",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },
  {
    element: "#nav-buy-credit",
    name:"nav-buy-credit",
    title: "BUY CREDITS",
    content: "Here you can see the token packages and purchase more credits",
     placement: 'left',
     onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },
  {
    element: "#nav-login-company",
    name:"nav-login-company",
    title: "MY COMPANY",
    content: "Here you can view the profile of your company",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  }, 
  {
    element: "#nav-login-inbox",
    name:"nav-login-inbox",
    title: "MY INBOX",
    content: "Here you can view, compose and send messages to other companies on the Intellinz system",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },  
  {
    element: "#nav-login-switch-company",
    name:"nav-login-switch-company",
    title: "SWITCH A COMPANY",
    content: "Here you can switch to one of your other registered companies",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },   
  {
    element: "#nav-login-referral",
    name:"nav-login-referrals",
    title: "REFERRALS",
    content: "Here you can view the affiliate program and the status of your referrals",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },  
  {
    element: "#nav-login-share-friend",
    name:"nav-login-share-friend",
    title: "SHARE TO FRIEND",
    content: "Here you can email a friend with your referral link so they can join you on the Intellinz system",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },  
  {
    element: "#nav-login-rewards",
    name:"nav-login-rewards",
    title: "REWARDS",
    content: "Here you can view your rewards accumulated",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },  
  {
    element: "#nav-change-pass",
    name:"nav-change-pass",
    title: "CHANGE PASSWORD",
    content: "Here you can change your password",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },  
  {
    element: "#nav-currency",
    name:"nav-currency",
    title: "CURRENCY",
    content: "Here you can change your default currency",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },  
  {
    element: "#nav-login-tour",
    name:"nav-login-tour",
    title: "LOGIN TOUR",
    content: "Here you can switch the tour on and off",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },  
  {
    element: "#nav-user-control",
    name:"nav-user-control",
    title: "USER CONTROL",
    content: "Here you can view and control your sub-accounts",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
  },  
  {
    element: "#nav-login-logout",
    name:"nav-login-logout",
    title: "LOGOUT",
    content: "This will log you out of the Intellinz system",
    placement: 'left',
    onShown: function(){
        $("#nav-login-dropdown").addClass('open');
        scroll_html();
    },
    onNext: function(){
        $('#nav-login-dropdown').removeClass('open');
    },
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
    element: "#top_opps_div",
    title: "Top 5 Opportunities",
    content: "This are the top 5 opportunites in your home page",
    placement: 'top'
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
  // {
  //   element: "#video-ads",
  //   title: "Video Advertisement",
  //   content: "Helpful videos to help you on your",
  //      placement: 'top'
  // },

],

  container: "body",
  smartPlacement: false,
  keyboard: true,
  storage: window.localStorage,
  //storage: false,
  debug: false,
  backdrop: true,
  backdropContainer: 'body',
  backdropPadding: 0,
  redirect: false,
  orphan: true,
  duration: false,
  delay: false,
  basePath: "",
  //placement: 'auto',
   // autoscroll: true,
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

// Clear bootstrap tour session data
localStorage.removeItem('tour_current_step');
localStorage.removeItem('tour_end');

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
            
            $(".learn_more_btn").click(function(){
                var filter_target_audience = 0;
                var filter_category = 0;
                var filter_country = "null";
                
                var keywordSearch = $(this).attr("name");
                
                var filter_ideal_partners = "null";
                
                    var keyS = filter_target_audience + "<filter>" + filter_category + "<filter>" + filter_country + "<filter>" + keywordSearch + "<filter>" + filter_ideal_partners + "<filter>fromhome" ;
                
                
                //var getUrl = window.location;
                //var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                //window.location.href = ;
                window.open("<?php echo env('APP_URL'); ?>" + "opportunity/exploreAll/" + encodeURIComponent(btoa(keyS)), '_blank');
            });
        });

    </script>

@endsection
