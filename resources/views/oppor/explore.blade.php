@extends('layouts.app')



@section('content')

<script src="{{ asset('public/jq-autocomplete/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('public/jq-autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.themes.min.css') }}" rel="stylesheet"
      type="text/css"/>

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>

    <style>

        html, body {

            width: 100%;

            height: 100%;

            margin: 0px;

            padding: 0px;

            overflow-x: hidden;
            font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;

        }
        

        .niceDisplay {

            font-family: 'PT Sans Narrow', sans-serif;

            background-color: white;

            padding: 10px;


            border-radius: 3px;

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

        }


        .btn-x3 {

            font-size: 15px;

            border-radius: 5px;

            width: 25%;

            background-color: orangered;

        }

        .hr-sect {
            display: flex;
            flex-basis: 100%;
            align-items: center;
            color: rgba(0, 0, 0, 0.35);
            margin: 8px 0px;
        }

        .hr-sect  {
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

        .hr-sect strong{
            color: #1a4275;
        }

        /* CSS FOR NEW LAYOUT */
        .card-img {
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover; /* Resize the background image to cover the entire container */
            background-color: #eee;
            padding-top: 100px;
        }

        .setBackground {
            padding-bottom: 0.1px;
        }

        .card-footer {
            margin-left: 5px;
            text-align: center;
        }

        .table-scrollable {
            margin: 0px;
        !important;
        }

        .profile-img a {
            bottom: 10px;
            box-shadow: none;
            display: block;
            left: 15px;
            padding: 1px;
            position: absolute;
            height: 160px;
            width: 160px;
            z-index: 9;
            text-align: center;
            margin-left: 10px;
        }

        .fb-profile-block-menu {
            border-radius: 0 0 3px 3px;
        }


        .fb-profile-block-thumb {
            display: block;
            height: 100px;
            position: relative;
            text-decoration: none;
            background-color: #3f92c3;
        }

        .thumbnail {
            padding: 0px !important;
            margin-bottom: 0px;
        }

        @media (max-width: 480px) and (min-width: 320px) {
            .brand {
                min-height: 120px;
                background-color: #e5e5e5;
            !important;
            }

            .card-body {
                margin-top: 75px;
            }

            .profile-img a {
                margin-left: 65px;
            }

            h3 {
                margin-left: 65px;
            }

        }


        .profile-img img {
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.07);
            height: 158px;
            padding: 5px;
            width: 158px;
            margin-top: 80px;
        }

        .table-scrollable {
        !important;
            border: 0px none;
        !important;
        }


        .card-columns1 { /* Masonry container */
            column-count: 3;
            column-gap: 1em;
        }

        .card-columns1 > .card { /* Masonry bricks or child elements */
            background-color: #eee;
            display: inline-block;
            margin: 0 0 1em;
            width: 100%;
        }


        /* Masonry on large screens */
        @media only screen and (min-width: 1024px) {
            .card-columns1{
                column-count: 3;
            }
        }

        /* Masonry on medium-sized screens */
        @media only screen and (max-width: 1023px) and (min-width: 768px) {
            .card-columns1{
                column-count: 2;
            }
        }

        /* Masonry on small screens */
        @media only screen and (max-width: 767px) and (min-width: 300px) {
            .card-columns1{
                column-count: 1;
            }

            .table-scrollable table tbody tr td{
                word-wrap: break-word;
            }

            .table td, .table th {
                font-size: 12px;
            }

            .table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th {
                padding: 0px;
            }
        }

 
        .thumbnail {
           box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
           transition: 0.3s;
           min-width: 40%;
           border-radius: 5px;

                   float:left;
                    width:100%;
                    overflow-y: scroll;
                    max-height: 50em;
                    height: 40em;
                    scrollbar-width: none;

         }

        .thumbnail::-webkit-scrollbar {
        width: 0px; 
        background: transparent;
        }

         .thumbnail-description {
           min-height: 40px;
         }



         .premium_banner{
            /*margin-left: 180px;*/
            float: right;
            width: 110% !important;
            left: 0;
            /*margin-bottom: 15px;*/
             position: absolute;
         }

         .modal-dialog {
          width: 75%;
          height: 100%;
          padding: 35px;
        }

        .modal-content {
          height: auto;
          border-radius: 15px;
        }

        .modal-title {
            font-size: 18px; 
            font-weight: bold; 
            text-transform: uppercase;
        }

        /*.card-explore{
            height: 25em;
        }

        new code start css*/


.list-link, .list-link:visited {
  display: block;
  text-decoration: inherit;
  color: inherit;
}

.container-grid {
  padding: 0.5em 1em 1em;
  max-width: calc(1400px + 1em);
  margin: 0 auto;
  overflow: hidden;
}
.container-grid .blog-posts .featured {
  width: 100% !important;
  height: auto !important;
  margin: 0.5em 0 1em 0 !important;
}
.container-grid .blog-posts .featured .image {
  height: auto !important;
}
.container-grid .blog-posts .featured .content {
  height: auto !important;
}
.container-grid .blog-posts .row {
  display: flex;
}
.container-grid .blog-posts .row .post:last-child {
  margin-right: 0 !important;
}
.container-grid .blog-posts .post {
        /*padding-bottom: 20px;*/
  flex: 1;
  overflow: hidden;
  background: white;
  height: auto;
  -moz-box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.2);
  box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.2);
  margin-right: 1em;
  margin-bottom: 1em;
}
.container-grid .blog-posts .post:hover {
  -moz-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);
  -webkit-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);
  /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
  cursor: pointer;
  box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 1);
}
.container-grid .blog-posts .post:hover .image {
  opacity: 0.8;
}
.container-grid .blog-posts .post .image, .container-grid .blog-posts .post .content {
  display: inline-block;
  position: relative;
  -moz-transition: all 500ms ease;
  -o-transition: all 500ms ease;
  -webkit-transition: all 500ms ease;
  transition: all 500ms ease;
}
.container-grid .blog-posts .post .image {
  float: left;
  width: 40%;
  height: 250px;
  background-size: cover;
  background-position: center center;
}


.container-grid .blog-posts .post .image .time {
  background: rgba(255, 255, 255, 0.5);
  width: 50px;
  text-align: center;
  padding: 0.5em 0;
  color: #444;
}
.container-grid .blog-posts .post .image .time .date {
  font-weight: bolder;
}
.container-grid .blog-posts .post .image .time .month {
  font-size: 0.7rem;
}
.container-grid .blog-posts .post .content {
  padding: 0.5em 1em;
  width: 50%;
  -moz-box-shadow: -2px 0 2px -1px rgba(0, 0, 0, 0.1);
  -webkit-box-shadow: -2px 0 2px -1px rgba(0, 0, 0, 0.1);
  box-shadow: -2px 0 2px -1px rgba(0, 0, 0, 0.1);
  height: 200px;
}
.container-grid .blog-posts .post .content:before {
  content: '';
  position: absolute;
  background: white;
  width: 10px;
  height: 10px;
  top: 20%;
  left: -5px;
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
  -moz-box-shadow: -1px 0 2px -1px rgba(0, 0, 0, 0.1);
  -webkit-box-shadow: -1px 0 2px -1px rgba(0, 0, 0, 0.1);
  box-shadow: -1px 0 2px -1px rgba(0, 0, 0, 0.1);
}
.container-grid .blog-posts .post .content h1 {
  font-weight: 600;
  line-height: 2;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.container-grid .blog-posts .post .content p {
  font-weight: 300;
  font-size: 0.7rem;
  line-height: 1.5;
  margin-bottom: 0.5em;
  font-family: 'Merriweather', sans-serif;
}
.container-grid .blog-posts .post .content .meta .icon-comment {
  font-size: 0.7em;
  line-height: 2;
  margin-top: auto;
}

[class^="icon-"]:before {
  margin-right: 0.5em;
  color: #3498db;
}

img {
  max-width: 100%;
  height: auto;
}

@media screen and (max-width: 840px) {
  .row {
    display: block !important;
  }
  .row .post {
    width: 100%;
    margin: 0;
  }
}
@media screen and (max-width: 600px) {
  .content {
    width: 70% !important;
  }

  .image {
    width: 30% !important;
  }

  h1 {
    text-overflow: inherit;
    white-space: normal;
  }
}
/* clearfix */
.cf:before,
.cf:after {
  content: " ";
  /* 1 */
  display: table;
  /* 2 */
}

.cf:after {
  clear: both;
}

.showLastCard{
    visibility: hidden;
}

.hiddenLastCard{
    display: none;
}

.info_list{
    list-style-type: circle;
    list-style-position: outside;
    margin-left: 20px;
    font-size: .8em;
}

.lg-link{
    font-size: 16px !important;
}

.info_list li{
    margin: 0 0px 5px;
}

.hr_title{
    font-size: .8em;
    font-weight: bolder;
}

.learn_more{
    float: right;
    position: relative;
    bottom: 35px;
    left: 20%;
}

.title-text{
    font-size: 16px;
    font-weight: bolder;
    line-height: 30px;
}

.opp_type{
    margin-top: 50px;
    margin-bottom: 25px;
    color: #1a4275;
    font-weight: 600;
    /*font-size: 1.1em;*/
    text-transform: uppercase;
}

.upperText{
    text-transform: uppercase;
}

/*.post:hover {
   cursor: pointer;
   box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 1);
}*/

.rating_score{
  margin: 10px;
}

@media (max-width: 426px) {
  .container-grid .blog-posts .post .image {
    width: 100% !important;
    float: none !important;
  }

  .container-grid .blog-posts .post .content h1 {
    white-space: normal;
    line-height: 1;
    font-size: 0.8em;
  }

  .content {
    width: 100% !important;
  }

  h3 {
       margin-left: 0px !important; 
  }

  .learn_more{
    left: 0 !important;
  }

  .modal-title {
    font-size: 14px; 
  }

  .title-text{
    font-size: 13px;
  }

  .lg-link {
    font-size: 13px !important;
  }

  .content-text{
    font-size: 14px;
  }

  .modal-dialog {
      width: 95%;
      padding: 10px;

  }
}

  /*for chat box area*/

#page-wrap                      { width: 500px; margin: 30px auto; position: relative; }

#chat-wrap                      { border: 1px solid #eee; margin: 0 0 15px 0; }
#chat-area                      { height: 300px; overflow: auto; border: 1px solid #666; padding: 20px; background: white; }
#chat-area span                 { color: white; background: #333; padding: 4px 8px; -moz-border-radius: 5px; -webkit-border-radius: 8px; margin: 0 5px 0 0; }
#chat-area p                    { padding: 8px 0; border-bottom: 1px solid #ccc; }

#name-area                      { position: absolute; top: 12px; right: 0; color: white; font: bold 12px "Lucida Grande", Sans-Serif; text-align: right; }   
#name-area span                 { color: #fa9f00; }

#send-message-area p            { float: left; color: white; padding-top: 27px; font-size: 14px; }
#sendie                         { border: 3px solid #999; width: 360px; padding: 10px; font: 12px "Lucida Grande", Sans-Serif; float: right; }


    </style>
    <div class="container container-grid">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Opportunity</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Explore Opportunity
                <i class="fa fa-circle"></i>
            </li>
            <?php if(isset($hashT)){ ?>
              <li>
                  <b>#<?php echo $hashT; ?> </b>
              </li>
            <?php } ?>
        </ul>
        <div class="col-md-12" >
            <div class="form-group">
                <div class="row">
                    <div class="col col-sm-6">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="keywordSearch"
                                   placeholder="Filter by keywords"
                                   value="<?php if (isset($selectedKeyword)) { echo $selectedKeyword; }?>">
                            <span class="input-group-btn"><button class="btn green" type="button"
                                                                  id="filterKeywords">FILTER</button></span>
                        </div>
                    </div>
                    <div class="col col-sm-6">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="keywordCountry"
                                   placeholder="Filter by country"
                                   value="<?php if (isset($selectedCountry)) { echo $selectedCountry; }?>">
                            <span class="input-group-btn"><button class="btn green" type="button"
                                                                  id="filterCountry">FILTER</button></span>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
<?php 
    $requestor_id = App\CompanyProfile::getCompanyId(Auth::id());

?>

        <div class="row">
            <!-- START BUILD OPPORTUNITY -->
            <div class="hr-sect opp_type" >Build Opportunity</div>
                <div class='blog-posts'>
                <?php       
                    $i = 1;
                    foreach ($build as $item): 
                            $opportunity_type = 'build';
                            $d_status = App\CompanyProfile::getDeactivateInfo($item->company_id);
                            $company = App\CompanyProfile::find($item->company_id);
                            $provider_id = $company->id;
                    if ( $company->count() > 0 && $d_status == true):
                        $avatar = \App\UploadImages::where('company_id', $item->company_id)->where('file_category', 'PROFILE_AVATAR')
                            ->orderBy('id', 'desc')
                            ->first();
                        $avat = '';
                        if (!isset($avatar->file_name)) 
                            $avat = 'robot.jpg';
                        else 
                            $avat = $avatar->file_name;
                        
                        $usr = App\User::find($company->user_id);
                        $accStatus = 'free';
                        if ($usr->user_type == 1) 
                            if( App\SpentTokens::validateAccountActivation($item->company_id) != false )
                                $accStatus = 'premium';   

                        $profileAvatar = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.profile'), 1);
                        $profileAwards = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.awards'), 5);
                        $profilePurchaseInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.purchase_invoices'), 5);
                        $profileSalesInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.sales_invoices'), 5);
                        $profileCertifications = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.certification'), 5);

                        $ratingScore = App\CompanyProfile::profileCompleteness(array($company, $profileAvatar, $profileAwards,
                        $profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

                        $industryImage = App\OppIndustry::find($item->industry);
                        if($industryImage){
                            $avatarName = $industryImage->image;
                            $avatarUrl = asset('public/images/industry')."/".$avatarName;
                        }else{
                            $avatarUrl = asset('public/images/industry')."/guest.png";
                        }

                        if($item->view_type == 2){
                            if($item->avatar_status == 1){
                                if($industryImage){
                                    $avatarName = $industryImage->image;
                                    $avatarUrl = asset('public/images/industry')."/".$avatarName;
                                }
                            }else{
                                $avatarUrl = asset('public/images')."/".$avat;
                            }
                        }
                    ?>
        
        <!-- new code start -->
        @if($i == 1)
            <div class='row cf list-row-build '>
        @endif
        @if($i <= 2)
              <div class='post build-list'>
                <a href='#'>
                    <div class='image' style='background-image: url( {{ $avatarUrl }} )'>

                @if($accStatus == 'premium')
                    <img class="premium_banner" alt="Premium Banner" src="{{ asset('public/banner/premium_banner.png') }}">
                @endif
                    </div>
                  <div class='content'>
                    <h1 class='upperText' title="{{ $item->opp_title }}"> <?= $item->opp_title != "" ? $item->opp_title : 'Providing Business Valuation' ?></h1>
                     <div class="hr-sect"><strong class="hr_title">This company is seeking</strong></div>
                        <ul class="info_list">
                            @if($item->business_goal)
                            <li> {{ $item->business_goal }}</li>
                            @endif
                            @if($item->audience_target)
                            <li> {{ $item->audience_target }}</li>
                            @endif
                            @if($item->ideal_partner_base)
                            <li>
                            <?php 
                                $string = explode(",",$item->ideal_partner_base);
                                $xx=0;
                                foreach( $string as $val ):
                                    if(trim($val) != ''):
                                        echo $val;
                                        $xx++;
                                        if($xx != count($string)){
                                            echo ", ";
                                        }
                                    endif;
                                endforeach; ?>
                            </li>
                            @endif
                        </ul>
                    <div class="hr-sect"><strong class="hr_title">Expectation</strong></div>
                        <p class='meta'> {{ $item->timeframe_goal }}
                        {{ $item->approx_large }} opportunity. </p>
                    <div style="display: flex;">
                        <div>
                            @if($ratingScore < 25)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                            @elseif($ratingScore >= 26 && $ratingScore <= 50)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                            @elseif($ratingScore >= 51 && $ratingScore <= 75)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                            @elseif($ratingScore >= 76 && $ratingScore <= 100)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                            @endif
                        </div>

                        <div class="rating_score">
                            <h3> {{ $ratingScore }}% </h3>
                        </div>
                    </div>
                    <div class="learn_more" style="float: right" >
                           <button onclick="showModalContent('build','{{ $item->id }}')" class="btn btn-primary "> Learn More</button>
                    </div>
                    <div class="bottom-space" >
                        &nbsp;
                    </div>
                  </div>
                </a>
              </div>
        @endif
        @if($i == 2)
            </div>
        @endif
        <!-- new code end -->
<?php      
        if($i == 2){
            $i = 0;
        }
         $i++; ?>

         {{-- Start modal click for build --}}
    <div 
        class="modal fade modal_oppoBox" 
        id="opporBuildModal_{{ $item->id }}" 
        tabindex="-1" role="dialog" 
        aria-labelledby="opporDetailsContentModalLabel" 
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title upperText" id="opporDetailsContentModalLabel"> <?= $item->opp_title != "" ? $item->opp_title : 'Providing Business Valuation' ?></h4>
                </div>
        <div class="modal-body">

            
            <div >
                <span class="title-text">
                    <h4><strong> Ratings </strong></h4>
                </span>
                <div class="content-text" style="display: flex;">
                <?php
                                    if ($ratingScore < 25) {
                                        ?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">

                                            <?php } elseif ($ratingScore >= 26 && $ratingScore <= 50) {?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">

                                            <?php } elseif ($ratingScore >= 51 && $ratingScore <= 75) {?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">

                                            <?php } elseif ($ratingScore >= 76 && $ratingScore <= 100) {?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">

                                            <?php }?>
                                       
                    <h2 class="rating_score"  > {{ $ratingScore }} % </h2>
                </div>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> This Company is seeking </strong></h4>
                </span>
                <span class="content-text">
                    <h4>
                        <ul class="info_list lg-link">
                            @if($item->business_goal)
                            <li>{{ $item->business_goal }}</li>
                            @endif
                            @if($item->audience_target)
                            <li>{{ $item->audience_target }}</li>
                            @endif
                            @if($item->ideal_partner_base)
                            <li>
                <?php 
                    $string = explode(",",$item->ideal_partner_base);
                    $xx=0;
                    foreach( $string as $val ):
                        if(trim($val) != ''):
                            echo $val;
                            $xx++;
                            if($xx != count($string)){
                                echo ", ";
                            }
                        endif;
                    endforeach; ?>
                            </li>
                            @endif
                        </ul>
                    </h4>    
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Expectation </strong></h4>
                </span>
                <span class="content-text">
                    <h4> 
                        {{ $item->timeframe_goal }}
                        {{ $item->approx_large }} opportunity.
                        
                    </h4>
                </span>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Industry Keyword </strong></h4>
                </span>
                <span class="content-text">
                    <h4>
                <?php 
                      $string = explode(",",$item->ideal_partner_business);
                      $xx=0;
                      foreach( $string as $val ):
                        if(trim($val) != ''):
                            echo $val." ";
                            $xx++;
                            if($xx != count($string)){
                                echo ",";
                            }
                        endif;
                      endforeach; ?>
                    </h4>
                </span>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Why partner with this company?  </strong></h4>
                </span>
                <span class="content-text">
                    <h4> {{ $item->why_partner_goal }} </h4>
                </span>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Relevant industry or products  </strong></h4>
                </span>
                <span class="content-text">
                    <h4>
                <?php 
                $rr = explode(",",$item->relevant_describing_partner);
                if(count((array) $rr) > 0):
                  foreach($rr as $h):
                    if(trim($h) != ''){
                        echo "<a href='".url("/opportunity/hashtag/".$h)."'>#".$h."</a> ";
                    }
                  endforeach;
                endif;
                ?>
                    </h4>
                </span>
                <hr class="hr-sect">
            </div> 

            <div>
                <a onclick="processReq('build', '<?php echo $item->id; ?>');" class="btn blue btn_options"><span class="fa fa-check"></span> Interested</a>

                <?php 
                $viewer = base64_encode('viewer' . $company->id);
                $token = base64_encode(date('YmdHis'));
              
                ?>

                {{-- Requestor = None-premium | Provider = Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($provider_id) != false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="nonPremiumToPremium('<?php echo $company->id; ?>', '<?php echo $requestor_id; ?>','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="nonPremiumToPremium('<?php echo $company->id; ?>', '<?php echo $requestor_id; ?>','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span>Inbox Me</a>
                @endif

                {{-- Requestor = Premium | Provider = Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) != false)

                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="PremiumToPremium({{ $company->id }}, {{ $requestor_id }},'{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}', '2');" class="btn blue btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}');" class="btn blue btn_options"> <span class="fa fa-credit-card"></span>Inbox Me</a>

                @endif


                <?php

                    if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($company->id) != false)
                    {
                    ?>                        
                        
                    
                    <?php 
                    } elseif( App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($company->id) != false ) {
                    ?> 
                        <a href="#" onclick="nonPremiumToPremium();" class="btn default btn_options view_profile"> <span class="fa fa-credit-card"></span> View Profile OLD</a>
                

                    <?php
                    }elseif( App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($company->id) == false ) { ?>
                        <a href="#" onclick="checkAlertByPremium('<?php echo $company->id; ?>', '<?php echo $requestor_id; ?>');" class="btn default btn_options "> <span class="fa fa-credit-card"></span> View Profile OLD 1</a>
                    

                    <?php 
                    }
                ?>

                <?php if (App\User::getEBossStaffTrue(Auth::id()) == true) {?>
                    

                <a href="{{ url('/opportunity/deleteBuild/'.$item->id) }}"
                   class="btn btn-danger btn_options"
                  
                   onclick="return confirm('Are you sure to delete an opportunity item?')">Delete</a>
                <?php }?>
                <hr class="hr-sect">
            </div> 

      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- END MODAL -->
<?php 
    endif;
    endforeach;  ?>
    </div>
      <!-- END BUILD OPPORTUNITY -->

    <!-- START SELL OPPORTUNITY -->
            <div class="hr-sect opp_type" >Sell Opportunity</div>
                <div class='blog-posts'>
                <?php       
                    $i = 1;
                    foreach ($sell as $item): 
                            $d_status = App\CompanyProfile::getDeactivateInfo($item->company_id);
                            $company = App\CompanyProfile::find($item->company_id);
                    if ( $company->count() > 0 && $d_status == true):
                        $avatar = \App\UploadImages::where('company_id', $item->company_id)->where('file_category', 'PROFILE_AVATAR')
                            ->orderBy('id', 'desc')
                            ->first();
                        $avat = '';
                        if (!isset($avatar->file_name)) 
                            $avat = 'robot.jpg';
                        else 
                            $avat = $avatar->file_name;
                        
                        $usr = App\User::find($company->user_id);
                        $accStatus = 'free';
                        if ($usr->user_type == 1) 
                            if( App\SpentTokens::validateAccountActivation($item->company_id) != false )
                                $accStatus = 'premium';   

                        $profileAvatar = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.profile'), 1);
                        $profileAwards = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.awards'), 5);
                        $profilePurchaseInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.purchase_invoices'), 5);
                        $profileSalesInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.sales_invoices'), 5);
                        $profileCertifications = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.certification'), 5);

                        $ratingScore = App\CompanyProfile::profileCompleteness(array($company, $profileAvatar, $profileAwards,
                        $profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

                        $industryImage = App\OppIndustry::find($item->industry);
                        if($industryImage){
                            $avatarName = $industryImage->image;
                            $avatarUrl = asset('public/images/industry')."/".$avatarName;
                        }else{
                            $avatarUrl = asset('public/images/industry')."/guest.png";
                        }

                        if($item->view_type == 2){
                            if($item->avatar_status == 1){
                                if($industryImage){
                                    $avatarName = $industryImage->image;
                                    $avatarUrl = asset('public/images/industry')."/".$avatarName;
                                }
                            }else{
                                $avatarUrl = asset('public/images')."/".$avat;
                            }
                        }
                    ?>
        
        <!-- new code start -->
        @if($i == 1)
            <div class='row cf list-row-sell '>
        @endif
        @if($i <= 2)
              <div class='post sell-list'>
                <a href='#'>
                    <div class='image' style='background-image: url( {{ $avatarUrl }} )'>

                @if($accStatus == 'premium')
                    <img class="premium_banner" alt="Premium Banner" src="{{ asset('public/banner/premium_banner.png') }}">
                @endif
                    </div>
                  <div class='content'>
                    <h1 class='upperText' title="{{ $item->opp_title }}"> <?= $item->opp_title != "" ? $item->opp_title : 'Providing Business Valuation' ?></h1>
                     <div class="hr-sect"><strong class="hr_title">This company is seeking</strong></div>
                        <ul class="info_list">
                            @if($item->business_goal)
                            <li> {{ $item->business_goal }}</li>
                            @endif
                            @if($item->audience_target)
                            <li> {{ $item->audience_target }}</li>
                            @endif
                            @if($item->ideal_partner_base)
                            <li>
                            <?php 
                                $string = explode(",",$item->ideal_partner_base);
                                $xx=0;
                                foreach( $string as $val ):
                                    if(trim($val) != ''):
                                        echo $val;
                                        $xx++;
                                        if($xx != count($string)){
                                            echo ", ";
                                        }
                                    endif;
                                endforeach; ?>
                            </li>
                            @endif
                        </ul>
                    <div class="hr-sect"><strong class="hr_title">Expectation</strong></div>
                        <p class='meta'> {{ $item->timeframe_goal }}
                        {{ $item->approx_large }} opportunity. </p>
                    <div style="display: flex;">
                        <div>
                            @if($ratingScore < 25)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                            @elseif($ratingScore >= 26 && $ratingScore <= 50)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                            @elseif($ratingScore >= 51 && $ratingScore <= 75)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                            @elseif($ratingScore >= 76 && $ratingScore <= 100)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                            @endif
                        </div>

                        <div class="rating_score">
                            <h3> {{ $ratingScore }}% </h3>
                        </div>
                    </div>
                    <div class="learn_more" style="float: right" >
                           <button onclick="showModalContent('sell','{{ $item->id }}')" class="btn btn-primary "> Learn More</button>
                    </div>
                    <div class="bottom-space" >
                        &nbsp;
                    </div>
                  </div>
                </a>
              </div>
        @endif
        @if($i == 2)
            </div>
        @endif
        <!-- new code end -->
<?php      
        if($i == 2){
            $i = 0;
        }
         $i++; ?>

         {{-- Start modal click for Sell --}}
    <div 
        class="modal fade modal_oppoBox" 
        id="opporSellModal_{{ $item->id }}" 
        tabindex="-1" role="dialog" 
        aria-labelledby="opporDetailsContentModalLabel" 
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title upperText" id="opporDetailsContentModalLabel"> <?= $item->opp_title != "" ? $item->opp_title : 'Providing Business Valuation' ?></h4>
                </div>
        <div class="modal-body">

            
            <div >
                <span class="title-text">
                    <h4><strong> Ratings </strong></h4>
                </span>
                <div class="content-text" style="display: flex;">
                <?php
                                    if ($ratingScore < 25) {
                                        ?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">

                                            <?php } elseif ($ratingScore >= 26 && $ratingScore <= 50) {?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">

                                            <?php } elseif ($ratingScore >= 51 && $ratingScore <= 75) {?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">

                                            <?php } elseif ($ratingScore >= 76 && $ratingScore <= 100) {?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">

                                            <?php }?>
                                       
                    <h2  class="rating_score" > {{ $ratingScore }} % </h2>
                </div>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> This Company is seeking </strong></h4>
                </span>
                <span class="content-text">
                    <h4>
                        <ul class="info_list lg-link">
                            @if($item->business_goal)
                            <li>{{ $item->business_goal }}</li>
                            @endif
                            @if($item->audience_target)
                            <li>{{ $item->audience_target }}</li>
                            @endif
                            @if($item->ideal_partner_base)
                            <li>
                <?php 
                    $string = explode(",",$item->ideal_partner_base);
                    $xx=0;
                    foreach( $string as $val ):
                        if(trim($val) != ''):
                            echo $val;
                            $xx++;
                            if($xx != count($string)){
                                echo ", ";
                            }
                        endif;
                    endforeach; ?>
                            </li>
                            @endif
                        </ul>
                    </h4>    
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Expectation </strong></h4>
                </span>
                <span class="content-text">
                    <h4> 
                        {{ $item->timeframe_goal }}
                        {{ $item->approx_large }} opportunity.
                        
                    </h4>
                </span>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Industry Keyword </strong></h4>
                </span>
                <span class="content-text">
                    <h4>
                <?php 
                      $string = explode(",",$item->ideal_partner_business);
                      $xx=0;
                      foreach( $string as $val ):
                        if(trim($val) != ''):
                            echo $val." ";
                            $xx++;
                            if($xx != count($string)){
                                echo ",";
                            }
                        endif;
                      endforeach; ?>
                    </h4>
                </span>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Why partner with this company?  </strong></h4>
                </span>
                <span class="content-text">
                    <h4> {{ $item->why_partner_goal }} </h4>
                </span>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Relevant industry or products  </strong></h4>
                </span>
                <span class="content-text">
                    <h4>
                <?php 
                $rr = explode(",",$item->relevant_describing_partner);
                if(count((array) $rr) > 0):
                  foreach($rr as $h):
                    if(trim($h) != ''){
                        echo "<a href='".url("/opportunity/hashtag/".$h)."'>#".$h."</a> ";
                    }
                  endforeach;
                endif;
                ?>
                    </h4>
                </span>
                <hr class="hr-sect">
            </div> 

            <div>
                <a onclick="processReq('sell', '<?php echo $item->id; ?>');" class="btn blue btn_options"><span class="fa fa-check"></span> Interested</a>

                <?php 
                $viewer = base64_encode('viewer' . $company->id);
                $token = base64_encode(date('YmdHis'));
                

 
                    if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($company->id) != false)
                    {
                    ?>                        
                        <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}"
                            class="btn green btn_options view_profile"><span class="fa fa-credit-card"></span> View Profile OLD</a>
                    
                    <?php 
                    } elseif( App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($company->id) != false ) {
                    ?> 
                        <a href="#" onclick="nonPremiumToPremium();" class="btn default btn_options view_profile"> <span class="fa fa-credit-card"></span> View Profile OLD</a>
                

                    <?php
                    }elseif( App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($company->id) == false ) { ?>
                        <a href="#" onclick="checkAlertByPremium('<?php echo $company->id; ?>', '<?php echo $requestor_id; ?>');" class="btn default btn_options view_profile"> <span class="fa fa-credit-card"></span> View Profile OLD</a>
                    

                    <?php 
                    }
                 ?>

                <?php if (App\User::getEBossStaffTrue(Auth::id()) == true) {?>
                    

                <a href="{{ url('/opportunity/deleteSell/'.$item->id) }}"
                   class="btn btn-danger btn_options"
                  
                   onclick="return confirm('Are you sure to delete an opportunity item?')">Delete</a>
                <?php }?>
                <hr class="hr-sect">
            </div> 

      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- END MODAL -->
<?php 
    endif;
    endforeach;  ?>
    </div>
    <!-- END SELL OPPORTUNITY -->

    <!-- START BUY OPPORTUNITY -->
            <div class="hr-sect opp_type" >Buy Opportunity</div>
                <div class='blog-posts'>
                <?php       
                    $i = 1;
                    foreach ($buy as $item): 
                            $d_status = App\CompanyProfile::getDeactivateInfo($item->company_id);
                            $company = App\CompanyProfile::find($item->company_id);
                    if ( $company->count() > 0 && $d_status == true):
                        $avatar = \App\UploadImages::where('company_id', $item->company_id)->where('file_category', 'PROFILE_AVATAR')
                            ->orderBy('id', 'desc')
                            ->first();
                        $avat = '';
                        if (!isset($avatar->file_name)) 
                            $avat = 'robot.jpg';
                        else 
                            $avat = $avatar->file_name;
                        
                        $usr = App\User::find($company->user_id);
                        $accStatus = 'free';
                        if ($usr->user_type == 1) 
                            if( App\SpentTokens::validateAccountActivation($item->company_id) != false )
                                $accStatus = 'premium';   

                        $profileAvatar = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.profile'), 1);
                        $profileAwards = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.awards'), 5);
                        $profilePurchaseInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.purchase_invoices'), 5);
                        $profileSalesInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.sales_invoices'), 5);
                        $profileCertifications = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.certification'), 5);

                        $ratingScore = App\CompanyProfile::profileCompleteness(array($company, $profileAvatar, $profileAwards,
                        $profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

                        $industryImage = App\OppIndustry::find($item->industry);
                        if($industryImage){
                            $avatarName = $industryImage->image;
                            $avatarUrl = asset('public/images/industry')."/".$avatarName;
                        }else{
                            $avatarUrl = asset('public/images/industry')."/guest.png";
                        }

                        if($item->view_type == 2){
                            if($item->avatar_status == 1){
                                if($industryImage){
                                    $avatarName = $industryImage->image;
                                    $avatarUrl = asset('public/images/industry')."/".$avatarName;
                                }
                            }else{
                                $avatarUrl = asset('public/images')."/".$avat;
                            }
                        }
                    ?>
        
        <!-- new code start -->
        @if($i == 1)
            <div class='row cf list-row-buy '>
        @endif
        @if($i <= 2)
              <div class='post buy-list'>
                <a href='#'>
                    <div class='image' style='background-image: url( {{ $avatarUrl }} )'>

                @if($accStatus == 'premium')
                    <img class="premium_banner" alt="Premium Banner" src="{{ asset('public/banner/premium_banner.png') }}">
                @endif
                    </div>
                  <div class='content'>
                    <h1 class='upperText' title="{{ $item->opp_title }}"> <?= $item->opp_title != "" ? $item->opp_title : 'Providing Business Valuation' ?></h1>
                     <div class="hr-sect"><strong class="hr_title">This company is seeking</strong></div>
                        <ul class="info_list">
                            @if($item->business_goal)
                            <li> {{ $item->business_goal }}</li>
                            @endif
                            @if($item->audience_target)
                            <li> {{ $item->audience_target }}</li>
                            @endif
                            @if($item->ideal_partner_base)
                            <li>
                            <?php 
                                $string = explode(",",$item->ideal_partner_base);
                                $xx=0;
                                foreach( $string as $val ):
                                    if(trim($val) != ''):
                                        echo $val;
                                        $xx++;
                                        if($xx != count($string)){
                                            echo ", ";
                                        }
                                    endif;
                                endforeach; ?>
                            </li>
                            @endif
                        </ul>
                    <div class="hr-sect"><strong class="hr_title">Expectation</strong></div>
                        <p class='meta'> {{ $item->timeframe_goal }}
                        {{ $item->approx_large }} opportunity. </p>
                    <div style="display: flex;">
                        <div>
                            @if($ratingScore < 25)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                            @elseif($ratingScore >= 26 && $ratingScore <= 50)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                            @elseif($ratingScore >= 51 && $ratingScore <= 75)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p1.png') }}">
                            @elseif($ratingScore >= 76 && $ratingScore <= 100)
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                                <img width="30" height="32"
                                     src="{{  asset('public/stars/p2.png') }}">
                            @endif
                        </div>

                        <div class="rating_score">
                            <h3> {{ $ratingScore }}% </h3>
                        </div>
                    </div>
                    <div class="learn_more" style="float: right" >
                           <button onclick="showModalContent('buy','{{ $item->id }}')" class="btn btn-primary "> Learn More</button>
                    </div>
                    <div class="bottom-space" >
                        &nbsp;
                    </div>
                  </div>
                </a>
              </div>
        @endif
        @if($i == 2)
            </div>
        @endif
        <!-- new code end -->
<?php      
        if($i == 2){
            $i = 0;
        }
         $i++; ?>

         {{-- Start modal click for buy --}}
    <div 
        class="modal fade modal_oppoBox" 
        id="opporBuyModal_{{ $item->id }}" 
        tabindex="-1" role="dialog" 
        aria-labelledby="opporDetailsContentModalLabel" 
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title upperText" id="opporDetailsContentModalLabel"> <?= $item->opp_title != "" ? $item->opp_title : 'Providing Business Valuation' ?></h4>
                </div>
        <div class="modal-body">

            
            <div >
                <span class="title-text">
                    <h4><strong> Ratings </strong></h4>
                </span>
                <div class="content-text" style="display: flex;">
                <?php
                                    if ($ratingScore < 25) {
                                        ?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">

                                            <?php } elseif ($ratingScore >= 26 && $ratingScore <= 50) {?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">

                                            <?php } elseif ($ratingScore >= 51 && $ratingScore <= 75) {?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p1.png') }}">

                                            <?php } elseif ($ratingScore >= 76 && $ratingScore <= 100) {?>
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">
                                            <img width="30" height="32"
                                                 src="{{  asset('public/stars/p2.png') }}">

                                            <?php }?>
                                       
                    <h2  class="rating_score" > {{ $ratingScore }} % </h2>
                </div>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> This Company is seeking </strong></h4>
                </span>
                <span class="content-text">
                    <h4>
                        <ul class="info_list lg-link">
                            @if($item->business_goal)
                            <li>{{ $item->business_goal }}</li>
                            @endif
                            @if($item->audience_target)
                            <li>{{ $item->audience_target }}</li>
                            @endif
                            @if($item->ideal_partner_base)
                            <li>
                <?php 
                    $string = explode(",",$item->ideal_partner_base);
                    $xx=0;
                    foreach( $string as $val ):
                        if(trim($val) != ''):
                            echo $val;
                            $xx++;
                            if($xx != count($string)){
                                echo ", ";
                            }
                        endif;
                    endforeach; ?>
                            </li>
                            @endif
                        </ul>
                    </h4>    
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Expectation </strong></h4>
                </span>
                <span class="content-text">
                    <h4> 
                        {{ $item->timeframe_goal }}
                        {{ $item->approx_large }} opportunity.
                        
                    </h4>
                </span>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Industry Keyword </strong></h4>
                </span>
                <span class="content-text">
                    <h4>
                <?php 
                      $string = explode(",",$item->ideal_partner_business);
                      $xx=0;
                      foreach( $string as $val ):
                        if(trim($val) != ''):
                            echo $val." ";
                            $xx++;
                            if($xx != count($string)){
                                echo ",";
                            }
                        endif;
                      endforeach; ?>
                    </h4>
                </span>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Why partner with this company?  </strong></h4>
                </span>
                <span class="content-text">
                    <h4> {{ $item->why_partner_goal }} </h4>
                </span>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Relevant industry or products  </strong></h4>
                </span>
                <span class="content-text">
                    <h4>
                <?php 
                $rr = explode(",",$item->relevant_describing_partner);
                if(count((array) $rr) > 0):
                  foreach($rr as $h):
                    if(trim($h) != ''){
                        echo "<a href='".url("/opportunity/hashtag/".$h)."'>#".$h."</a> ";
                    }
                  endforeach;
                endif;
                ?>
                    </h4>
                </span>
                <hr class="hr-sect">
            </div> 

            <div>
                <a onclick="processReq('buy', '<?php echo $item->id; ?>');" class="btn blue btn_options"><span class="fa fa-check"></span> Interested</a>

                <?php 
                $viewer = base64_encode('viewer' . $company->id);
                $token = base64_encode(date('YmdHis'));
                
                $requestor_id = App\CompanyProfile::getCompanyId(Auth::id());

  
                    if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($company->id) != false)
                    {
                    ?>                        
                        <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}"
                            class="btn green btn_options view_profile"><span class="fa fa-credit-card"></span> View Profile OLD</a>
                    
                    <?php 
                    } elseif( App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($company->id) != false ) {
                    ?> 
                        <a href="#" onclick="nonPremiumToPremium();" class="btn default btn_options view_profile"> <span class="fa fa-credit-card"></span> View Profile OLD</a>
                

                    <?php
                    }elseif( App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($company->id) == false ) { ?>
                        <a href="#" onclick="checkAlertByPremium('<?php echo $company->id; ?>', '<?php echo $requestor_id; ?>');" class="btn default btn_options view_profile"> <span class="fa fa-credit-card"></span> View Profile OLD</a>
                    

                    <?php 
                    }
                 ?>

                <?php if (App\User::getEBossStaffTrue(Auth::id()) == true) {?>
                    

                <a href="{{ url('/opportunity/deleteBuy/'.$item->id) }}"
                   class="btn btn-danger btn_options"
                  
                   onclick="return confirm('Are you sure to delete an opportunity item?')">Delete</a>
                <?php }?>
                <hr class="hr-sect">
            </div> 

      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- END MODAL -->
<?php 
    endif;
    endforeach;  ?>
    </div>
    <!-- END BUY OPPORTUNITY -->
</div></div>
</div><!-- end row -->
      </div>
        </div>
    </div>

@if($result_filter)
<!-- Modal -->
<div 
    class="modal fade" 
    id="opporDetailsContentModal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="opporDetailsContentModalLabel" 
    aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="opporDetailsContentModalLabel">Opportunity Details</h4>
        </div>
        <div class="modal-body">
        <?php 
        $d_status = App\CompanyProfile::getDeactivateInfo($result_filter->company_id);
        $company = App\CompanyProfile::find($result_filter->company_id);
        if ( $company->count() > 0 && $d_status == true) {
            $avatar = \App\UploadImages::where('company_id', $result_filter->company_id)->where('file_category', 'PROFILE_AVATAR')
            ->orderBy('id', 'desc')
            ->first();
            $avat = '';
            if (!isset($avatar->file_name)) {
                $avat = 'robot.jpg';
            } else {
                $avat = $avatar->file_name;
            } ?>
        <div>
            <span class="title-text">
                <h4><strong> Title: </strong></h4>
            </span>
            <span class="content-text">
                <h4> <?= $result_filter->opp_title ?> </h4>
            </span>
            <hr>
        </div>

        <div>
            <span class="title-text">
                <h4><strong> Ratings </strong></h4>
            </span>
            <span class="content-text">
 <?php
        $profileAvatar = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.profile'), 1);
        $profileAwards = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.awards'), 5);
        $profilePurchaseInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.purchase_invoices'), 5);
        $profileSalesInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.sales_invoices'), 5);
        $profileCertifications = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.certification'), 5);

        $ratingScore = App\CompanyProfile::profileCompleteness(array($company, $profileAvatar, $profileAwards,
            $profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

        if ($ratingScore < 25) {
            ?>
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p1.png') }}">
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p1.png') }}">
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p1.png') }}">

                                        <?php } elseif ($ratingScore >= 26 && $ratingScore <= 50) {?>
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p2.png') }}">
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p1.png') }}">
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p1.png') }}">

                                        <?php } elseif ($ratingScore >= 51 && $ratingScore <= 75) {?>
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p2.png') }}">
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p2.png') }}">
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p1.png') }}">

                                        <?php } elseif ($ratingScore >= 76 && $ratingScore <= 100) {?>
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p2.png') }}">
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p2.png') }}">
                                        <img width="30" height="32"
                                             src="{{  asset('public/stars/p2.png') }}">

                                        <?php }?>
                                        <br/>
                <h4 class="rating_score"> {{ $ratingScore }} % </h4>
            </span>
            <hr>
        </div>
        <div>
            <span class="title-text">
                <h4><strong> This Company is seeking </strong></h4>
            </span>
            <span class="content-text">
                <h4>
                    <ul>
                        @if($opp_type == 'build')
                        <li>{{ $result_filter->business_goal }}</li>
                        @else
                        <li>{{ $result_filter->what_sell_offer }}</li>
                        @endif
                        <li>{{ $result_filter->audience_target }}</li>
                        <li>
            <?php 
                $string = explode(",",$result_filter->ideal_partner_base);
                $i=0;
                foreach( $string as $val ):
                    if(trim($val) != ''):
                        echo $val;
                        $i++;
                        if($i != count($string)){
                            echo ", ";
                        }
                    endif;
                endforeach; ?>
                        </li>
                    </ul>
                </h4>
            </span>
            <hr>
        </div>

        <div>
            <span class="title-text">
                <h4><strong> Expectation </strong></h4>
            </span>
            <span class="content-text">
                <h4> 
                    {{ $result_filter->timeframe_goal }}
                    {{ $result_filter->approx_large }} opportunity.
                    
                </h4>
            </span>
            <hr>
        </div>

        <div>
            <span class="title-text">
                <h4><strong> Industry Keyword </strong></h4>
            </span>
            <span class="content-text">
                <h4>
<?php 
                  $string = explode(",",$result_filter->ideal_partner_business);
                  $i=0;
                  foreach( $string as $val ):
                    if(trim($val) != ''):
                        echo $val." ";
                        $i++;
                        if($i != count($string)){
                            echo ",";
                        }
                    endif;
                  endforeach;
?>
                </h4>
            </span>
            <hr>
        </div>

        <div>
            <span class="title-text">
                <h4><strong> Why partner with this company?  </strong></h4>
            </span>
            <span class="content-text">
                <h4> {{ $result_filter->why_partner_goal }} </h4>
            </span>
            <hr>
        </div>

        <div>
            <span class="title-text">
                <h4><strong> Relevant industry or products  </strong></h4>
            </span>
            <span class="content-text">
                <h4>
<?php 
            $rr = explode(",",$result_filter->relevant_describing_partner);
            if(count((array) $rr) > 0):
              foreach($rr as $h):
                if(trim($h) != ''){
                    echo "<a href='".url("/opportunity/hashtag/".$h)."'>#".$h."</a> ";
                }
              endforeach;
            endif;
?>
                </h4>
            </span>
            <hr>
        </div>

<?php   
        }#end if company count
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
@endif


{{-- Start Inbox Me Modal --}}
<div 
  class="modal fade modal_oppoBox" 
  id="inboxMeModal" 
  tabindex="-1" role="dialog" 
  aria-labelledby="Inbox Me Modal" 
  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h2 class='chatOppTitle'>Title</h2>

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         
        </div>
        <div class="modal-body">

          <div id="page-wrap">
    
              
              <p id="name-area"></p>
              
              <div id="chat-wrap"><div id="chat-area"></div></div>
              
              <form id="send-message-area">
                  <p>Your message: </p>
                  <textarea id="sendie" maxlength = '100' ></textarea>
                  <input type="hidden" id="chat-companyViewer">
                  <input type="hidden" id="chat-companyOpp">
              </form>
    
        </div>
            

          

        
        </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>
<!-- END INBOX ME MODAL -->


    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
    <script>


        var builCount = $('.build-list').length;
        if(builCount%2 != 0 ){
            $('.list-row-build').last().append('<div class="post showLastCard" ></div>');
        }

        var sellCount = $('.sell-list').length;
        if(sellCount%2 != 0 ){
            $('.list-row-sell').last().append('<div class="post showLastCard" ></div>');
        }

        var buyCount = $('.buy-list').length;
        if(buyCount%2 != 0 ){
            $('.list-row-buy').last().append('<div class="post showLastCard" ></div>');
        }

        function showModalContent(type, id){
            if(type == 'build'){
                $("#opporBuildModal_"+id).modal();
            }
            if(type == 'sell'){
                $("#opporSellModal_"+id).modal();
            }
            if(type == 'buy'){
                $("#opporBuyModal_"+id).modal();
            }
        }

        $(document).ready(function () {

            $(".view_profile").click(function () {
                
                formData = new FormData();

                formData.append("sender", "ebosIT@gmail.com");
                formData.append("receiver", "darylyrad.cabz@gmail.com");
                formData.append("text", "sample body Content");
                
                    $.ajax({
                        url: "{{ route('sentMail2') }}",
                        type: "POST",
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        processData: false,
                        contentType: false,

                        success: function (data) {
                            console.log(data);
                        }
                    });
            });

            $("#opporDetailsContentModal").modal();
            $("#filterKeywords").click(function () {
                var keyS = $("#keywordSearch").val();
                var getUrl = window.location;
                var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                if (keyS != "") {
                    window.location.href = baseUrl + "/opportunity/exploreKey/" + keyS;
                } else {
                    window.location.href = baseUrl + "/opportunity/explore";
                }
            });

            $("#filterCountry").click(function () {
                var keyS = $("#keywordCountry").val();
                var getUrl = window.location;
                var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                if (keyS != "") {
                    window.location.href = baseUrl + "/opportunity/exploreCountry/" + keyS;
                } else {
                    window.location.href = baseUrl + "/opportunity/explore";
                }
            });
        });


        function processReq(typeOpp, fkID) {
            var getUrl = window.location;
            var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
            window.open(baseUrl + '/request/' + typeOpp + '/' + fkID, '_blank');
        }


        var options = {
            url: "{{ url('public/json/keywords.json') }}",
            getValue: "keyword",
            list: {
                match: {
                    enabled: true
                }
            }
        };
        $("#keywordSearch").easyAutocomplete(options);


        var optionsCountry = {
            url: "{{ route('getCountryList') }}",
            getValue: "country",
            list: {
                match: {
                    enabled: true
                }
            }
        };
        $("#keywordCountry").easyAutocomplete(optionsCountry);

        
        function checkPremium(companyID, ptype, oppId, linker){
            swal({
                title: "Are you sure to open this profile, published Anonymously? ", 
                text: "You are about to open a profile using your premuim account which will cost you 1 token.",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {
                  swal({
                    title: 'Premium Account',
                    text:  'Done on setting 1 token to spent with premium account.',
                    icon:  'success'
                  }).then(function() {

                    formData = new FormData();

                    formData.append("companyID", companyID);
                    formData.append("ptype", ptype);
                    formData.append("oppId", oppId);
                    
                        $.ajax({
                            url: "{{ route('PremiumPurchase') }}",
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
                  swal("Cancelled", "Opening a premium data was cancelled :)", "error");
                }
              });


        }


        function nonPremiumToPremium(companyOpp,companyViewer,templateType){
          $('.modal_oppoBox').modal('hide');
            swal({
                title:"This requires premium account to open this profile.", 
                text: "Are you sure to proceed?  Because we will send an email notification to this profile and redirect you to Dashboard page and find the upgrade button at Token Credit section.",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {

                    formData = new FormData();
                    formData.append("companyOpp", companyOpp);
                    formData.append("companyViewer", companyViewer);
                    formData.append("templateType", templateType);
                    $.ajax({
                        url: "{{ route('emailNotification') }}",
                        type: "POST",
                        async: true,
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        processData: false,
                        contentType: false,

                        success: function (data) {
                            swal({
                              title: 'Email notification will be sent to this profile. You need to re-fill token to become a Premium Account',
                              text:  'Check Token Credit section and look for the Upgrade To Premium Account button.',
                              icon:  'success'
                            }).then(function() {
                                   //document.location = '{{ url("reports/buyTokens") }}';
                                document.location = '{{ url("/home") }}';
                            
                            });
                        }
                    });

                } else {
                    swal("Cancelled", "To become premium account was cancelled :)", "error");
                }
              });

        }


        function PremiumToPremium(companyOpp,companyViewer, url, templateType){
          $('.modal_oppoBox').modal('hide');
            swal({
                title:"We will send an email notification to this profile", 
                text: "Are you sure to proceed?.",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {

                    formData = new FormData();
                    formData.append("companyOpp", companyOpp);
                    formData.append("companyViewer", companyViewer);
                    formData.append("templateType", templateType);
                    $.ajax({
                        url: "{{ route('emailNotification') }}",
                        type: "POST",
                        async: true,
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        processData: false,
                        contentType: false,

                        success: function (data) {
                            swal({
                              title: 'Email notification will be sent to this profile.',
                              text:  'You will now redirect to this profile.',
                              icon:  'success'
                            }).then(function() {
                                window.open( 
                                  "'"+url+"'" , "_blank"); 
                              });
                        }
                    });

                } else {
                    swal("Cancelled", "To become premium account was cancelled :)", "error");
                }
              });
        }

        function OppInboxMe(title,companyOpp,companyViewer){
          chat.getState(companyOpp,companyViewer); 

          setInterval('chat.update( '+companyOpp+', '+companyViewer+' )', 1000);
     

          $('#inboxMeModal').modal();

          $('.chatOppTitle').text(title);
          $('#chat-companyOpp').val(companyOpp);
          $('#chat-companyViewer').val(companyViewer);

        }


        function checkAlertByPremium(companyOpp, companyViewer)
        {   
          $('.modal_oppoBox').modal('hide');
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

//for chat script
    var chat =  new Chat();
    $(function() {
    
      // chat.getState(); 
       
       // watch textarea for key presses
            $("#sendie").keydown(function(event) {  
           
               var key = event.which;  
         
               //all keys including return.  
               if (key >= 33) {
                 
                   var maxLength = $(this).attr("maxlength");  
                   var length = this.value.length;  
                   
                   // don't allow new content if length is maxed out
                   if (length >= maxLength) {  
                       event.preventDefault();  
                   }  
                }  
            });
       // watch textarea for release of key press
       $('#sendie').keyup(function(e) { 
                 
          if (e.keyCode == 13) { 
          
                  var text = $(this).val();
                  var maxLength = $(this).attr("maxlength");  
                  var length = text.length; 
                   
                  // send 
                  if (length <= maxLength + 1) { 
                   
                chat.send(text, name);  
                $(this).val("");
                
                  } else {
                  
                  $(this).val(text.substring(0, maxLength));
            
              } 
          
          }
           });
    });

var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
    this.getState = getStateOfChat;
}

//gets the state of the chat
function getStateOfChat(companyOpp,companyViewer){
  if(!instanse){
     instanse = true;
     // $.ajax({
     //     type: "POST",
     //     url: "process.php",
     //     data: {  
     //          'function': 'getState',
     //        'file': file
     //        },
     //     dataType: "json",
      
     //     success: function(data){
     //       state = data.state;
     //       instanse = false;
     //     },
     //  });
      // var companyOpp =    $('#chat-companyOpp').val();
      // var companyViewer =  $('#chat-companyViewer').val();

      formData = new FormData();
      formData.append("function", 'getState');
      formData.append("companyOpp", companyOpp);
      formData.append("companyViewer", companyViewer);
      
      $.ajax({
          url: "{{ route('chatProcess') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
            console.log(data);
            state = data.state;
            instanse = false;
          }
      });

  }  
}

//Updates the chat
function updateChat(companyOpp, companyViewer){
  console.log(instanse);
   if(!instanse){
     instanse = true;



      //  $.ajax({
      //    type: "POST",
      //    url: "process.php",
      //    data: {  
      //         'function': 'update',
      //       'state': state,
      //       'file': file
      //       },
      //    dataType: "json",
      //    success: function(data){
      //      if(data.text){
      //       for (var i = 0; i < data.text.length; i++) {
      //                       $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
      //                   }                 
      //      }
      //      document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
      //      instanse = false;
      //      state = data.state;
      //    },
      // });

      formData = new FormData();
      formData.append("function", 'update');
      formData.append("companyOpp", companyOpp);
      formData.append("companyViewer", companyViewer);
      formData.append("state", state);
      
      $.ajax({
          url: "{{ route('chatProcess') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
              console.log(data);
            
            if(data.text){
                $('#chat-area').empty();
                for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p><span>"+data.text[i].sender+"</span>"+ data.text[i].text +"</p>"));
                }                 
           }
           document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
           instanse = false;
           state = data.state;

          }
      });

   }
   else {
    console.log("Dasdsd")
     setTimeout(updateChat, 1500,companyOpp, companyViewer );
   }
}

//send the message
function sendChat(message, nickname)
{       
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    // updateChat(companyOpp, companyViewer );

    formData = new FormData();
    formData.append("function", 'send');
    formData.append("message", message);
    formData.append("companyOpp", companyOpp);
    formData.append("companyViewer", companyViewer);
    
    $.ajax({
        url: "{{ route('chatProcess') }}",
        type: "POST",
        data: formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            updateChat(companyOpp, companyViewer);
        }
    });

}


    </script>
{{-- <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script> --}}

@endsection
