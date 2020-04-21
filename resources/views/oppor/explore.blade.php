@extends('layouts.app')



@section('content')

<script src="{{ asset('public/jq-autocomplete/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('public/jq-autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.themes.min.css') }}" rel="stylesheet"
      type="text/css"/>


    <!--<link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">-->



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

         .thumbnail:hover {
           cursor: pointer;
           box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 1);
         }

         .premium_banner{
            /*margin-left: 180px;*/
            float: right;
            width: 50%;
            /*margin-bottom: 15px;*/
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
        }

        /*.card-explore{
            height: 25em;
        }*/

    </style>
    <div class="container">
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
        <div class="col-md-12" style="min-height:800px">
            <div class="form-group">
                <div class="row">
                    <div class="col col-sm-6">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="keywordSearch"
                                   placeholder="Filter by keywords"
                                   value="<?php if (isset($selectedKeyword)) {
    echo $selectedKeyword;
}?>">
                            <span class="input-group-btn"><button class="btn green" type="button"
                                                                  id="filterKeywords">FILTER</button></span>
                        </div>
                    </div>
                    <div class="col col-sm-6">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="keywordCountry"
                                   placeholder="Filter by country"
                                   value="<?php if (isset($selectedCountry)) {
    echo $selectedCountry;
}?>">
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


           <!-- START BUILD OPPORTUNITY -->
            <div class="hr-sect" style="margin-top: 50px; margin-bottom: 25px;">Build Opportunity</div>
            <div class="card-columns1">
                <?php
$i = 0;
foreach ($build as $item) {

    $d_status = App\CompanyProfile::getDeactivateInfo($item->company_id);
    $company = App\CompanyProfile::find($item->company_id);
    if ( $company->count() > 0 && $d_status == true) {
        $avatar = \App\UploadImages::where('company_id', $item->company_id)->where('file_category', 'PROFILE_AVATAR')
            ->orderBy('id', 'desc')
            ->first();
        $avat = '';
        if (!isset($avatar->file_name)) {
            $avat = 'robot.jpg';
        } else {
            $avat = $avatar->file_name;
        }
        
        $usr = App\User::find($company->user_id);
        $accStatus = 'free';
        if ($usr->user_type == 1) {
            if( App\SpentTokens::validateAccountActivation($item->company_id) != false ){
                $accStatus = 'premium';   
            } 
        }
        ?>
                <div class="card">
                    <div class="thumbnail" style="margin-bottom: 5px;">
                        @if($accStatus == 'premium')
                            <div class="premium_banner_container" >
                                <img class="premium_banner" alt="Premium Banner" 
                                    src="{{ asset('public/banner/banner-new4.png') }}">
                            </div>
                        @endif
                        <?php if ($item->view_type == 2) {?>
                        <img class="card-img-top img-circle" alt="profile image" style="border: saddlebrown"
                             src="{{ asset('public/images/') }}/<?php echo $avat ?>">
                        <?php }?>


                                                <?php
                                                 if ($item->view_type == 2) {
                                                ?>
                                                    <div class="caption">
                                                <?php
                                                  echo '<h3>' . $company->registered_company_name . '</h3>';
                                                  ?>
                                                    </div>
                                                <?php
                                                 }
                                                 ?>

                        <div class="table-scrollable">
                            <table class="table table-condensed table-hover">
                                <tbody>

                                  <tr>
                                      <td><b>Title</b></td>

                      <?php if(isset($item->opp_title) && trim($item->opp_title) != ''){ ?>     
                                  <td class="alert alert-dark bold uppercase"><h4><strong><?php echo $item->opp_title; ?></strong></h4></td>
                      <?php } else { ?>
                      <td> </td>
                      <?php } ?>        
                                </tr>

                                <tr>
                                    <td><b> Ratings </b></td>
                                    <td>
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
                                        <?php echo $ratingScore . '%'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>This company is seeking</b></td>
                                    <td><?php echo $item->business_goal; ?><br>
                                        <?php echo $item->audience_target; ?><br>
                                      <?php 
                                          $string = explode(",",$item->ideal_partner_base);
                                          $i=0;
                                          foreach( $string as $val ){
                                            if(trim($val) != ''){
                                                echo $val;
                                                $i++;
                                                if($i != count($string)){
                                                    echo ", ";
                                                }
                                            }
                                        } ?>
                                </tr>
                                <tr>
                                    <td><b>Expectation</b></td>
                                    <td><?php echo $item->timeframe_goal; ?> <br>
                                        <?php echo $item->approx_large; ?> opportunity.
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Industry Keyword </b></td>
                                    <td> <?php 
                                          $string = explode(",",$item->ideal_partner_business);
                                          $i=0;
                                          foreach( $string as $val ){
                                            if(trim($val) != ''){
                                                echo $val." ";
                                                $i++;
                                                if($i != count($string)){
                                                    echo ",";
                                                }
                                            }
                                          } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Why partner with this company?</b></td>
                                    <td><?php echo $item->why_partner_goal; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Relevant industry or products</b></td>
                                    <td><?php //echo $item->relevant_describing_partner;
                                    $rr = explode(",",$item->relevant_describing_partner);
                                    if(count((array) $rr) > 0){
                                      foreach($rr as $h){
                                        if(trim($h) != ''){
                                        echo "<a href='".url("/opportunity/hashtag/".$h)."'>#".$h."</a> ";
                                        }
                                      }
                                    }
                                     ?></td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="text-align: center"><p>
                                <a onclick="processReq('build', '<?php echo $item->id; ?>');"
                                   class="btn blue"><span class="fa fa-check"></span> Interested</a>

                                <?php 
                                $viewer = base64_encode('viewer' . $company->id);
                                $token = base64_encode(date('YmdHis'));
                                
                                $company_id_result = App\CompanyProfile::getCompanyId(Auth::id());

                                if ($item->view_type == 2) 
                                {
                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false && App\SpentTokens::validateAccountActivation($company->id) != false)
                                    {
                                    ?>
                                        <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}"
                                            class="btn btn-success yellow"><span class="fa fa-credit-card"></span> View Profile</a>
                                    <?php 
                                    } elseif( App\SpentTokens::validateAccountActivation($company_id_result) == false && App\SpentTokens::validateAccountActivation($company->id) != false ) {
                                    ?> 
                                        <a href="#" onclick="encourageToPremium();" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                    <?php
                                    }elseif( App\SpentTokens::validateAccountActivation($company_id_result) != false && App\SpentTokens::validateAccountActivation($company->id) == false ) { ?>
                                        <a href="#" onclick="checkAlertByPremium('<?php echo $company->id; ?>', '<?php echo $company_id_result; ?>');" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                    <?php 
                                    }
                                }
                               /* if ($item->view_type == 2) 
                                {
                                     if(App\SpentTokens::validateLeftBehindToken($company_id_result) != false && App\SpentTokens::validateLeftBehindToken($company->id) != false)
                                    {
                                    ?>
                                 <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}"
                                class="btn btn-success yellow"><span class="fa fa-credit-card"></span> View Profile</a>
                                   <?php 
                                   } else {
                                   ?> 
                                   <a href="#" onclick="encourageToPremium();" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                   <?php
                                   }


                                } else {
                                
                                  
                                   /* if(App\PremiumOpportunityPurchased::checkIfPremium($company_id_result, $item->id, 'build') != false)
                                    {
                                    ?>
                                    <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}" class="btn default yellow"> <span class="fa fa-credit-card"></span> Premium View Profile </a>
                                    <?php
                                    } 
                                    else { //if free company to premium user
                                        
                                        if(App\SpentTokens::validateLeftBehindToken($company->id) == false 
                                        && App\SpentTokens::validateLeftBehindToken($company_id_result) != false) 
                                        {
                                        ?>
                                        <a href="#" onclick="checkAlertByPremium('<?php echo $company->id; ?>', '<?php echo $company_id_result; ?>');" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                        <?php 
                                        }

                                  //  } 
                                
                                }    */
                                ?>

                                <?php if (App\User::getEBossStaffTrue(Auth::id()) == true) {?>
                                <a href="{{ url('/opportunity/deleteBuild/'.$item->id) }}"
                                   class="btn btn-danger"
                                   style="color: white; float:right;"
                                   onclick="return confirm('Are you sure to delete an opportunity item?')">Delete</a>
                                <?php }?>

                            </p></div>
                    </div>

                </div>
                <?php
}
}?>
            </div>
            <!-- END BUILD OPPORTUNITY -->

            <!-- START SELL OPPORTUNITY -->
            <div class="hr-sect" style="margin-top: 50px; margin-bottom: 25px;">Sell Opportunity</div>
            <div class="card-columns1">
                <?php
$i = 0;
foreach ($sell as $item) {

    $d_status = App\CompanyProfile::getDeactivateInfo($item->company_id);
    $company = App\CompanyProfile::find($item->company_id);
    if (count((array) $company) - 1 > 0 && $d_status == true) {
        $avatar = \App\UploadImages::where('company_id', $item->company_id)->where('file_category', 'PROFILE_AVATAR')
            ->orderBy('id', 'desc')
            ->first();
        $avat = '';
        if (!isset($avatar->file_name)) {
            $avat = 'robot.jpg';
        } else {
            $avat = $avatar->file_name;
        }

        $usr = App\User::find($company->user_id);
        $accStatus = 'free';
        if ($usr->user_type == 1) {
            if( App\SpentTokens::validateAccountActivation($item->company_id) != false ){
                $accStatus = 'premium';   
            } 
        }
        ?>
                <div class="card">
                    <div class="thumbnail" style="margin-bottom: 5px;">
                        @if($accStatus == 'premium')
                            <div class="premium_banner_container" >
                                <img class="premium_banner" alt="Premium Banner" 
                                    src="{{ asset('public/banner/banner-new4.png') }}">
                            </div>
                        @endif
                        <?php if ($item->view_type == 2) {?>
                        <img class="card-img-top img-circle" alt="profile image" style="border: saddlebrown"
                             src="{{ asset('public/images/') }}/<?php echo $avat ?>">
                        <?php }?>
                        <?php
                         if ($item->view_type == 2) {
                        ?>
                            <div class="caption">
                        <?php
                          echo '<h3>' . $company->registered_company_name . '</h3>';
                          ?>
                            </div>
                        <?php
                         }
                         ?>

                        <div class="table-scrollable">
                            <table class="table table-condensed table-hover">
                                <tbody>
                                <tr>
                                  <td><b>Title</b></td>
                                
                      <?php if(isset($item->opp_title) && trim($item->opp_title) != ''){ ?>     
                                      <td class="alert alert-dark bold uppercase"><h4><strong><?php echo $item->opp_title; ?></strong></h4></td>
                      <?php } else { ?>
                      <td> </td>
                      <?php } ?>
                                </tr>

                                <tr>
                                    <td><b> Ratings </b></td>
                                    <td>
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
                                        <?php echo $ratingScore . '%'; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>This company is seeking</b></td>
                                    <td><?php echo $item->what_sell_offer; ?><br>
                                        <?php echo $item->audience_target; ?><br>
                                        <?php 
                                          $string = explode(",",$item->ideal_partner_base);
                                          $i=0;
                                          foreach( $string as $val ){
                                            if(trim($val) != ''){
                                                echo $val;
                                                $i++;
                                                if($i != count($string)){
                                                    echo ", ";
                                                }
                                            }
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Expectation</b></td>
                                    <td><?php echo $item->timeframe_goal; ?> <br>
                                        <?php echo $item->approx_large; ?> opportunity.
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Industry Keyword </b></td>
                                    <td> <?php 
                                          $string = explode(",",$item->ideal_partner_business);
                                          $i=0;
                                          foreach( $string as $val ){
                                            if(trim($val) != ''){
                                                echo $val." ";
                                                $i++;
                                                if($i != count($string)){
                                                    echo ",";
                                                }
                                            }
                                          } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Why partner with this company?</b></td>
                                    <td><?php echo $item->why_partner_goal; ?></td>
                                </tr>


                                <tr>
                                    <td><b>Relevant industry or products</b></td>
                                    <td><?php //echo $item->relevant_describing_partner;
                                    $rr = explode(",",$item->relevant_describing_partner);
                                    if(count((array) $rr) > 0){
                                      foreach($rr as $h){
                                        if(trim($h) != ''){
                                        echo "<a href='".url("/opportunity/hashtag/".$h)."'>#".$h."</a> ";
                                        }
                                      }
                                    }
                                     ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="text-align: center"><p>
                                <a onclick="processReq('sell', '<?php echo $item->id; ?>');"
                                   class="btn blue"><span class="fa fa-check"></span> Interested</a>

                                <?php 
                                $viewer = base64_encode('viewer' . $company->id);
                                $token = base64_encode(date('YmdHis'));

                                $company_id_result = App\CompanyProfile::getCompanyId(Auth::id());

                                if ($item->view_type == 2) 
                                {
                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false && App\SpentTokens::validateAccountActivation($company->id) != false)
                                    {
                                    ?>
                                        <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}"
                                            class="btn btn-success yellow"><span class="fa fa-credit-card"></span> View Profile</a>
                                    <?php 
                                    } elseif( App\SpentTokens::validateAccountActivation($company_id_result) == false && App\SpentTokens::validateAccountActivation($company->id) != false ) {
                                    ?> 
                                        <a href="#" onclick="encourageToPremium();" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                    <?php
                                    }elseif( App\SpentTokens::validateAccountActivation($company_id_result) != false && App\SpentTokens::validateAccountActivation($company->id) == false ) { ?>
                                        <a href="#" onclick="checkAlertByPremium('<?php echo $company->id; ?>', '<?php echo $company_id_result; ?>');" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                    <?php 
                                    }
                                } 
                                //else {
                                
                                   /* if(App\PremiumOpportunityPurchased::checkIfPremium($company_id_result, $item->id, 'sell') != false)
                                    {
                                    ?>
                                    <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}" class="btn default yellow"> <span class="fa fa-credit-card"></span> Premium View Profile </a>
                                    <?php
                                    } else { //if free company to premium user
                                     */   
                                       /* if(App\SpentTokens::validateLeftBehindToken($company->id) == false 
                                        && App\SpentTokens::validateLeftBehindToken($company_id_result) != false) 
                                        {
                                        ?>
                                        <a href="#" onclick="checkAlertByPremium('<?php echo $company->id; ?>', '<?php echo $company_id_result; ?>');" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                        <?php 
                                        } */

                                   // } 
                                 
                                //}    
                                ?>

                                <?php if (App\User::getEBossStaffTrue(Auth::id()) == true) {?>
                                <a href="{{ url('/opportunity/deleteSell/'.$item->id) }}"
                                   class="btn btn-danger"
                                   style="color: white; float:right;"
                                   onclick="return confirm('Are you sure to delete an opportunity item?')">Delete</a>
                                <?php }?>

                            </p></div>

                    </div>
                </div>
                <?php }
}?>
            </div>
            <!-- END SELL OPPORTUNITY -->

            <!-- START BUY OPPORTUNITY -->
            <div class="hr-sect" style="margin-top: 50px; margin-bottom: 25px;">Buy Opportunity</div>
            <div class="card-columns1">
                <?php
$i = 0;
foreach ($buy as $item) {
    $d_status = App\CompanyProfile::getDeactivateInfo($item->company_id);
    $company = App\CompanyProfile::find($item->company_id);

    if (count((array) $company) > 0 && $d_status == true) {

        $avatar = \App\UploadImages::where('company_id', $item->company_id)->where('file_category', 'PROFILE_AVATAR')
            ->orderBy('id', 'desc')
            ->first();
        $avat = '';

        if (!isset($avatar->file_name)) {
            $avat = 'logoAvatar.png';
        } else {
            $avat = $avatar->file_name;
        }

        $usr = App\User::find($company->user_id);
        $accStatus = 'free';
        if ($usr->user_type == 1) {
            if( App\SpentTokens::validateAccountActivation($item->company_id) != false ){
                $accStatus = 'premium';   
            } 
        }

        /*/ $banner = \App\UploadImages::where('company_id', $item->company_id)->where('file_category', 'BANNER_IMG')
                                    ->orderBy('id', 'desc')
                                    ->first();
                                $ban = '';

                                if (!isset($banner->file_name)) {
                                    $ban = $banner->file_name;
                                }
        */
        ?>
                <div class="card">
                    <div class="thumbnail" style="margin-bottom:5px;">
                        @if($accStatus == 'premium')
                            <div class="premium_banner_container" >
                                <img class="premium_banner" alt="Premium Banner" 
                                    src="{{ asset('public/banner/banner-new4.png') }}">
                            </div>
                        @endif
                        <?php if ($item->view_type == 2) {?>
                        <img class="card-img-top img-circle" alt="profile image" style="border: saddlebrown"
                             src="{{ asset('public/images/') }}/<?php echo $avat ?>">
                        <?php }?>


                        <?php
                           if ($item->view_type == 2) {
                        ?>
                            <div class="caption">
                        <?php
                                echo '<h3>' . $company->registered_company_name . '</h3>';
                          ?>
                            </div>
                        <?php
                             }
                         ?>


                        <div class="table-scrollable">
                            <table class="table table-condensed table-hover">
                                <tbody>

                                  <tr>
                                    <td><b>Title</b></td>
                
 
                 <?php if(isset($item->opp_title) && trim($item->opp_title) != ''){ ?>  
                                      <td class="alert alert-dark bold uppercase"><h4><strong><?php echo $item->opp_title; ?></strong></h4></td>
                      <?php } else { ?>
                      <td> </td>
                      <?php } ?>
        
                                  </tr>

                                <tr>
                                    <td><b> Ratings </b></td>
                                    <td>
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
                                        <?php echo $ratingScore . '%'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>This company is seeking</b></td>
                                    <td><?php echo $item->what_sell_offer; ?><br>
                                        <?php echo $item->audience_target; ?><br>
                                        <?php 
                                          $string = explode(",",$item->ideal_partner_base);
                                          $i=0;
                                          foreach( $string as $val ){
                                            if(trim($val) != ''){
                                                echo $val;
                                                $i++;
                                                if($i != count($string)){
                                                    echo ", ";
                                                }
                                            }
                                        } ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Expectation</b></td>
                                    <td><?php echo $item->timeframe_goal; ?> <br>
                                        <?php echo $item->approx_large; ?> opportunity.
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Industry Keyword </b></td>
                                    <td> <?php 
                                          $string = explode(",",$item->ideal_partner_business);
                                          $i=0;
                                          foreach( $string as $val ){
                                            if(trim($val) != ''){
                                                echo $val." ";
                                                $i++;
                                                if($i != count($string)){
                                                    echo ",";
                                                }
                                            }
                                          } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Why partner with this company?</b></td>
                                    <td><?php echo $item->why_partner_goal; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Relevant industry or products</b></td>
                                    <td><?php //echo $item->relevant_describing_partner;
                                    $rr = explode(",",$item->relevant_describing_partner);
                                    if(count((array) $rr) > 0){
                                      foreach($rr as $h){
                                        if(trim($h) != ''){
                                        echo "<a href='".url("/opportunity/hashtag/".$h)."'>#".$h."</a> ";
                                        }
                                      }
                                    }
                                     ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <p>
                                <a onclick="processReq('buy', '<?php echo $item->id; ?>');"
                                   class="btn blue"><span class="fa fa-check"></span> Interested </a>

                                 <?php 
                                $viewer = base64_encode('viewer' . $company->id);
                                $token = base64_encode(date('YmdHis'));

                                $company_id_result = App\CompanyProfile::getCompanyId(Auth::id());
                                if ($item->view_type == 2) {
                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false && App\SpentTokens::validateAccountActivation($company->id) != false)
                                    {
                                    ?>
                                        <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}"
                                            class="btn btn-success yellow"><span class="fa fa-credit-card"></span> View Profile</a>
                                    <?php 
                                    } elseif( App\SpentTokens::validateAccountActivation($company_id_result) == false && App\SpentTokens::validateAccountActivation($company->id) != false ) {
                                    ?> 
                                        <a href="#" onclick="encourageToPremium();" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                    <?php
                                    }elseif( App\SpentTokens::validateAccountActivation($company_id_result) != false && App\SpentTokens::validateAccountActivation($company->id) == false ) { ?>
                                        <a href="#" onclick="checkAlertByPremium('<?php echo $company->id; ?>', '<?php echo $company_id_result; ?>');" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                    <?php 
                                    }
                                }
                               /* if ($item->view_type == 2) {
                                    
                                      if(App\SpentTokens::validateLeftBehindToken($company_id_result) != false && App\SpentTokens::validateLeftBehindToken($company->id) != false)
                                    {
                                    ?>
                                 <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}"
                                class="btn btn-success yellow"><span class="fa fa-credit-card"></span> View Profile</a>
                                     <?php 
                                     } else {
                                     ?> 
                                     <a href="#" onclick="encourageToPremium();" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                     <?php
                                     }
                                
                                } else {
                          
                                    /*if(App\PremiumOpportunityPurchased::checkIfPremium($company_id_result, $item->id, 'buy') != false)
                                    {
                                    ?>
                                    <a target="_blank" href="{{ url('/company/'.$viewer.'/'.$company->id.'/'.$item->id.'/'.$token) }}" class="btn default yellow"> <span class="fa fa-credit-card"></span> Premium View Profile </a>
                                    <?php
                                    } else { //if free company to premium user
                                     
                                        if(App\SpentTokens::validateLeftBehindToken($company->id) == false 
                                        && App\SpentTokens::validateLeftBehindToken($company_id_result) != false) 
                                        {
                                        ?>
                                        <a href="#" onclick="checkAlertByPremium('<?php echo $company->id; ?>', '<?php echo $company_id_result; ?>');" class="btn default"> <span class="fa fa-credit-card"></span> View Profile</a>
                                        <?php 
                                        }

                                  //  } 
                                 
                                }      */ 
                                ?>


                                <?php if (App\User::getEBossStaffTrue(Auth::id()) == true) {?>
                                <a href="{{ url('/opportunity/deleteBuy/'.$item->id) }}"
                                   class="btn btn-danger" style="color: white; float:right;"
                                   onclick="return confirm('Are you sure to delete an opportunity item?')">Delete</a>
                                <?php }?>

                            </p>
                        </div>
                    </div>
                </div>
                <?php
}
}?>
            </div>
            <!-- END BUY OPPORTUNITY -->
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
                <h4> {{ $ratingScore }} % </h4>
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
                </h4>
                </ul>
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



    <div class="container">
        <div class="card-columns1">


        </div>
    </div>

    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#opporDetailsContentModal").modal()
            $("#filterKeywords").click(function () {
                var keyS = $("#keywordSearch").val();
                var getUrl = window.location;
                var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                if (keyS != "") {
                    window.location.href = baseUrl + "/exploreKey/" + keyS;
                } else {
                    window.location.href = baseUrl + "/explore";
                }
            });

            $("#filterCountry").click(function () {
                var keyS = $("#keywordCountry").val();
                var getUrl = window.location;
                var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                if (keyS != "") {
                    window.location.href = baseUrl + "/exploreCountry/" + keyS;
                } else {
                    window.location.href = baseUrl + "/explore";
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

        function encourageToPremium(){
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

        function checkAlertByPremium(companyOpp, companyViewer)
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

    </script>



@endsection
