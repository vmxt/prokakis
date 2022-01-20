@extends('layouts.app')



@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">

<script src="{{ asset('public/jq-autocomplete/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('public/jq-autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.themes.min.css') }}" rel="stylesheet"
      type="text/css"/>

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>

<style>
    #chat-wrap {
      background-image: url("{{ asset('public/img-resources/chat-backdrop.png') }}");
      background-position: bottom;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
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
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/explore.css') }}">


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
    $tokenStock = App\SpentTokens::validateTokenStocks($requestor_id);
    //echo $tokenStock;
     $opportunity_type ="";
?>

        <div class="row">
    <!-- START SELL OPPORTUNITY -->
            <div class="hr-sect opp_type" >Sell Opportunity</div>
                <div class='blog-posts' id='sell-sect'>
                <?php       
                    $i = 1;
                    foreach ($sell as $item): 
                        $item->company_id = $item->company_id != "" ? $item->company_id: $company_id;
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
            <div class='row cf list-row-sell '>
        @endif
        @if($i <= 2)
              <div class='post sell-list'>
                <?php 
                    $followComp = App\CompanyFollow::checkFollowCompany( Auth::id(), $company->id ) ;
                    if( $followComp > 0) {
                        $iconName = 'fa-user-minus';
                        $iconTitle = "Unfollow this company";
                    }else{
                        $iconName = 'fa-user-plus';
                        $iconTitle = "Follow this company";
                    }
                     if($item->company_id == $company_id){
                         $iconName = '';
                     }
                ?>
                    <div class='follow-cont' dataVal="{{ $company->id }}">
                        <i class="fas {{ $iconName }} fa-1x follow-icon followicon_{{ $company->id }}" title="{{ $iconTitle }}"  ></i>
                    </div>
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
                    @if($item->company_id != $company_id)
                    <div class="learn_more" style="float: right" >
                           <button onclick="showModalContent('sell','{{ $item->id }}')" class="btn btn-primary "> Learn More</button>
                    </div>
                    @endif;
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
            
            <div>
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
                    <h4><strong> Brief Description of the Company  </strong></h4>
                </span>
                <span class="content-text">
                    <h4> {{ $item->intro_describe_business }} </h4>
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
              @if(  $tokenStock >= 12)
                <a onclick="processReq('sell', '{{ $item->id }}');" class="btn blue btn_options"><span class="fa fa-check"></span> Due Diligence Report</a>
              @else
                <a onclick="stockTokenInfo('{{ $tokenStock }}');" class="btn blue btn_options"><span class="fa fa-check"></span> Due Diligence Report</a>
              @endif

                <?php 
                $viewer = base64_encode('viewer' . $company->id);
                $token = base64_encode(date('YmdHis'));
                ?>

                {{-- Requestor = Non-premium | Provider = Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($provider_id) != false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="nonPremiumToPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    @if($tokenStock >= 3)

                        @if(App\ChatHistory::getChatPayStatus($item->id, 'sell', $requestor_id, $provider_id) == false)
                            <a href="#" Opptype="{{ $opportunity_type }}" onclick="DeductThreeInboxMe('{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $item->id }}', '{{ $company->id }}', '{{ $requestor_id }}' , 'sell');" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        @else
                            <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','sell');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>

                            <?php if(App\VideoChat::getVcURL($item->id, 'sell', $requestor_id) == null){ ?>
                            <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','sell');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                            <?php } else { ?>
                            <a href="<?php echo App\VideoChat::getVcURL($item->id, 'sell', $requestor_id); ?>" target="_blank" Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                            <?php } ?>    
                            
                        @endif

                    @else
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="BlockInboxMe();" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                    @endif

                @endif

                {{-- Requestor = Premium | Provider = Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) != false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="PremiumToPremium({{ $company->id }}, {{ $requestor_id }},'{{ url('/company/'.$viewer.'/'.$company->id) }}', '2');" class="btn blue btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','sell');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>

                    <?php if(App\VideoChat::getVcURL($item->id, 'sell', $requestor_id) == null){ ?>
                            <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','sell');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                            <?php } else { ?>
                            <a href="<?php echo App\VideoChat::getVcURL($item->id, 'sell', $requestor_id); ?>" target="_blank" Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                    <?php } ?>  

                @endif

                {{-- Requestor = Premium | Provider = Non-Premium
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" onclick="checkAlertByPremium('{{ $company->id }}', '{{ $requestor_id }}');" class="btn default btn_options "> <span class="fa fa-credit-card"></span> View Profile</a>
                @endif  --}}

                {{-- Requestor = Non-premium | Provider = Non-Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="nonPremiumToNonPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    @if($tokenStock >= 3)

                        @if(App\ChatHistory::getChatPayStatus($item->id, 'sell', $requestor_id, $provider_id) == false)
                            <a href="#" Opptype="{{ $opportunity_type }}" onclick="DeductThreeInboxMe('{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $item->id }}', '{{ $company->id }}', '{{ $requestor_id }}' , 'sell');" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                            @else
                            <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','sell');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>

                            <?php if(App\VideoChat::getVcURL($item->id, 'sell', $requestor_id) == null){ ?>
                            <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','sell');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                            <?php } else { ?>
                            <a href="<?php echo App\VideoChat::getVcURL($item->id, 'sell', $requestor_id); ?>" target="_blank" Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                            <?php } ?> 

                        @endif

                    @else
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="BlockInboxMe();" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    @endif

                @endif

                {{-- Requestor = Premium | Provider = Non-Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="premiumToNonPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    
                    <?php if(App\VideoChat::getVcURL($item->id, 'sell', $requestor_id) == null){ ?>
                        <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','sell');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                        <?php } else { ?>
                        <a href="<?php echo App\VideoChat::getVcURL($item->id, 'sell', $requestor_id); ?>" target="_blank" Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                    <?php } ?> 

                @endif

                @if(App\User::getEBossStaffTrue(Auth::id()) == true)
                  <a href="{{ url('/opportunity/deleteBuild/'.$item->id) }}"
                   class="btn btn-danger btn_options"
                   onclick="return confirm('Are you sure to delete an opportunity item?')">Delete</a>
                @endif
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
                <div class='blog-posts' id='buy-sect'>
                <?php       
                    $i = 1;
                    foreach ($buy as $item): 
                        $item->company_id = $item->company_id != "" ? $item->company_id: $company_id;
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
            <div class='row cf list-row-buy '>
        @endif
        @if($i <= 2)
              <div class='post buy-list'>

                <?php 
                    $followComp = App\CompanyFollow::checkFollowCompany( Auth::id(), $company->id ) ;
                    if( $followComp > 0) {
                        $iconName = 'fa-user-minus';
                        $iconTitle = "Unfollow this company";
                    }else{
                        $iconName = 'fa-user-plus';
                        $iconTitle = "Follow this company";
                    }
                    if($item->company_id == $company_id){
                         $iconName = '';
                     }
                ?>
                    <div class='follow-cont' dataVal="{{ $company->id }}">
                        <i class="fas {{ $iconName }} fa-1x follow-icon followicon_{{ $company->id }}" title="{{ $iconTitle }}"  ></i>
                    </div>

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
                     @if($item->company_id != $company_id)
                    <div class="learn_more" style="float: right" >
                           <button onclick="showModalContent('buy','{{ $item->id }}')" class="btn btn-primary "> Learn More</button>
                    </div>
                    @endif
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
                    <h4><strong> Brief Description of the Company  </strong></h4>
                </span>
                <span class="content-text">
                    <h4> {{ $item->intro_describe_business }} </h4>
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
              @if(  $tokenStock >= 12)
                <a onclick="processReq('buy', '{{ $item->id }}');" class="btn blue btn_options"><span class="fa fa-check"></span> Due Diligence Report</a>
              @else
                <a onclick="stockTokenInfo('{{ $tokenStock }}');" class="btn blue btn_options"><span class="fa fa-check"></span> Due Diligence Report</a>
              @endif
                <?php 
                $viewer = base64_encode('viewer' . $company->id);
                $token = base64_encode(date('YmdHis'));
                ?>
                 {{-- Requestor = Non-premium | Provider = Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($provider_id) != false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="nonPremiumToPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    @if($tokenStock >= 3)

                        @if(App\ChatHistory::getChatPayStatus($item->id, 'buy', $requestor_id, $provider_id) == false)
                            <a href="#" Opptype="{{ $opportunity_type }}" onclick="DeductThreeInboxMe('{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $item->id }}', '{{ $company->id }}', '{{ $requestor_id }}' , 'buy');" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        @else
                            <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','buy');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                            
                            <?php if(App\VideoChat::getVcURL($item->id, 'buy', $requestor_id) == null){ ?>
                            <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','buy');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                            <?php } else { ?>
                            <a href="<?php echo App\VideoChat::getVcURL($item->id, 'buy', $requestor_id); ?>" target="_blank"  Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                            <?php } ?>     

                        @endif

                    @else
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="BlockInboxMe();" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    @endif

                @endif

                {{-- Requestor = Premium | Provider = Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) != false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="PremiumToPremium({{ $company->id }}, {{ $requestor_id }},'{{ url('/company/'.$viewer.'/'.$company->id) }}', '2');" class="btn blue btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','buy');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    
                    <?php if(App\VideoChat::getVcURL($item->id, 'buy', $requestor_id) == null){ ?>
                        <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','buy');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                        <?php } else { ?>
                        <a href="<?php echo App\VideoChat::getVcURL($item->id, 'buy', $requestor_id); ?>" target="_blank"  Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                    <?php } ?> 

                @endif

                {{-- Requestor = Premium | Provider = Non-Premium
               @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" onclick="checkAlertByPremium('{{ $company->id }}', '{{ $requestor_id }}');" class="btn default btn_options "> <span class="fa fa-credit-card"></span> View Profile</a>
                @endif  --}}

                {{-- Requestor = Non-premium | Provider = Non-Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="nonPremiumToNonPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    @if($tokenStock >= 3)

                        @if(App\ChatHistory::getChatPayStatus($item->id, 'sell', $requestor_id, $provider_id) == false)
                            <a href="#" Opptype="{{ $opportunity_type }}" onclick="DeductThreeInboxMe('{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $item->id }}', '{{ $company->id }}', '{{ $requestor_id }}' , 'buy');" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        @else
                            <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','buy');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                            
                            <?php if(App\VideoChat::getVcURL($item->id, 'buy', $requestor_id) == null){ ?>
                                <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','buy');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                                <?php } else { ?>
                                <a href="<?php echo App\VideoChat::getVcURL($item->id, 'buy', $requestor_id); ?>" target="_blank"  Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                            <?php } ?> 

                        @endif

                    @else
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="BlockInboxMe();" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    @endif

                @endif

                {{-- Requestor = Premium | Provider = Non-Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="premiumToNonPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    
                    <?php if(App\VideoChat::getVcURL($item->id, 'buy', $requestor_id) == null){ ?>
                        <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','buy');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                        <?php } else { ?>
                        <a href="<?php echo App\VideoChat::getVcURL($item->id, 'buy', $requestor_id); ?>" target="_blank"  Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Video Chat Me</a>
                    <?php } ?> 

                @endif

                @if(App\User::getEBossStaffTrue(Auth::id()) == true)
                  <a href="{{ url('/opportunity/deleteBuild/'.$item->id) }}"
                   class="btn btn-danger btn_options"
                   onclick="return confirm('Are you sure to delete an opportunity item?')">Delete</a>
                @endif
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
    </div>
    <!-- END BUY OPPORTUNITY -->

    <!-- START BUILD OPPORTUNITY -->
            <div class="hr-sect opp_type" >Partnership Opportunity</div>
                <div class='blog-posts' id="build-sect">
                <?php       
                    $i = 1;
                    $buildCount = 0;
                    foreach ($build as $item): 
                        $item->company_id = $item->company_id != "" ? $item->company_id: $company_id;
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
                <?php 
                    $followComp = App\CompanyFollow::checkFollowCompany( Auth::id(), $company->id ) ;
                    if( $followComp > 0) {
                        $iconName = 'fa-user-minus';
                        $iconTitle = "Unfollow this company";
                    }else{
                        $iconName = 'fa-user-plus';
                        $iconTitle = "Follow this company";
                    }
                     if($item->company_id == $company_id){
                         $iconName = '';
                     }
                ?>
                    <div class='follow-cont' dataVal="{{ $company->id }}">
                        <i class="fas {{ $iconName }} fa-1x follow-icon followicon_{{ $company->id }}" title="{{ $iconTitle }}"  ></i>
                    </div>

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
                     @if($item->company_id != $company_id)
                    <div class="learn_more" style="float: right" >
                           <button onclick="showModalContent('build','{{ $item->id }}')" class="btn btn-primary "> Learn More</button>
                    </div>
                    @endif
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
        class="modal fade modal_oppoBox build_modal_{{ $buildCount }}" 
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
 
            <div id='rating_section_{{ $buildCount }}'>
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

            <div id='seeking_section_{{ $buildCount }}'>
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

            <div id='expectation_section_{{ $buildCount }}'>
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

            <div id='revenue_section_{{ $buildCount }}'>
                <span class="title-text">
                    <h4><strong> Estimated Revenue Per Year </strong></h4>
                </span>
                <span class="content-text">
                    <h4> 
                        {{ App\CurrencyMonetary::currencyConvertion($item->est_revenue, $item->currency) }}
                    </h4>
                </span>
                <hr>
            </div>

            <div id='profit_section_{{ $buildCount }}'>
                <span class="title-text">
                    <h4><strong> Estimated Profit Per Year </strong></h4>
                </span>
                <span class="content-text">
                    <h4> 
                        {{ App\CurrencyMonetary::currencyConvertion($item->est_profit, $item->currency) }}
                    </h4>
                </span>
                <hr>
            </div>

            <div id='profit_section_{{ $buildCount }}'>
                <span class="title-text">
                    <h4><strong> Inventory Value </strong></h4>
                </span>
                <span class="content-text">
                    <h4> 
                        {{ App\CurrencyMonetary::currencyConvertion($item->inventory_value, $item->currency) }}
                    </h4>
                </span>
                <hr>
            </div>

            <div id='keyword_section_{{ $buildCount }}'>
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

            <div id='oppo_desciption_section_{{ $buildCount }}'>
                <span class="title-text">
                    <h4><strong> Description about this opporunity?  </strong></h4>
                </span>
                <span class="content-text">
                    <h4> {{ $item->oppo_description }} </h4>
                </span>
                <hr>
            </div>

             <div>
                <span class="title-text">
                    <h4><strong> Brief Description of the Company  </strong></h4>
                </span>
                <span class="content-text">
                    <h4> {{ $item->intro_describe_business }} </h4>
                </span>
                <hr>
            </div>
            

            <div id='whypartner_section_{{ $buildCount }}'>
                <span class="title-text">
                    <h4><strong> Why partner with this company?  </strong></h4>
                </span>
                <span class="content-text">
                    <h4> {{ $item->why_partner_goal }} </h4>
                </span>
                <hr>
            </div>

            <div id='relevant_section_{{ $buildCount }}'>
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
              @if($tokenStock >= 12)
                <a id='dilligence_btn_{{ $buildCount }}' onclick="processReq('build', '{{ $item->id }}');" class="btn blue btn_options"><span class="fa fa-check"></span> Due Diligence Report</a>
              @else
                <a id='dilligence_btn_{{ $buildCount }}' onclick="stockTokenInfo('{{ $tokenStock }}');" class="btn blue btn_options"><span class="fa fa-check"></span> Due Diligence Report</a>
              @endif

                <?php 
                $viewer = base64_encode('viewer' . $company->id);
                $token = base64_encode(date('YmdHis'));
                ?>

                {{-- Requestor = Non-premium | Provider = Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($provider_id) != false)
                    <a id='viewprofile_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}" onclick="nonPremiumToPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    @if($tokenStock >= 3)
                        @if(App\ChatHistory::getChatPayStatus($item->id, 'build', $requestor_id, $provider_id) == false)
                        <a id='connectme_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}" onclick="DeductThreeInboxMe('{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $item->id }}', '{{ $company->id }}', '{{ $requestor_id }}' , 'build');" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        @else
                        <a id='connectme_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>

                        <?php if(App\VideoChat::getVcURL($item->id, 'build', $requestor_id) == null){ ?>
                        <a id='videochat_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                        <?php } else { ?>
                        <a id='videochat_btn_{{ $buildCount }}' href="<?php echo App\VideoChat::getVcURL($item->id, 'build', $requestor_id); ?>" target="_blank" Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                        <?php } ?>    

                        @endif
                    @else
                    <a id='connectme_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}" onclick="BlockInboxMe();" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    @endif

                @endif

                {{-- Requestor = Premium | Provider = Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) != false)
                    <a id='viewprofile_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}" onclick="PremiumToPremium({{ $company->id }}, {{ $requestor_id }},'{{ url('/company/'.$viewer.'/'.$company->id) }}', '2');" class="btn blue btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    <a id='connectme_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                   
                    <?php if(App\VideoChat::getVcURL($item->id, 'build', $requestor_id) == null){ ?>
                        <a id='videochat_btn_{{ $buildCount }}'  href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                        <?php } else { ?>
                        <a id='videochat_btn_{{ $buildCount }}'  href="<?php echo App\VideoChat::getVcURL($item->id, 'build', $requestor_id); ?>" target="_blank" Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                    <?php } ?> 

                @endif

                {{-- Requestor = Premium | Provider = Non-Premium 
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" onclick="checkAlertByPremium('{{ $company->id }}', '{{ $requestor_id }}');" class="btn default btn_options "> <span class="fa fa-credit-card"></span> View Profile</a>
                @endif --}}

                {{-- Requestor = Non-premium | Provider = Non-Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a id='viewprofile_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}" onclick="nonPremiumToNonPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    @if($tokenStock >= 3)
                        @if(App\ChatHistory::getChatPayStatus($item->id, 'build', $requestor_id, $provider_id) == false)
                        <a id='connectme_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}" onclick="DeductThreeInboxMe('{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $item->id }}', '{{ $company->id }}', '{{ $requestor_id }}' , 'build');" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        @else
                        <a id='connectme_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        
                        <?php if(VideoChat::getVcURL($item->id, 'build', $requestor_id) == null){ ?>
                            <a id='videochat_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                            <?php } else { ?>
                            <a id='videochat_btn_{{ $buildCount }}' href="<?php echo App\VideoChat::getVcURL($item->id, 'build', $requestor_id); ?>" target="_blank" Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                        <?php } ?> 

                        @endif
                    @else
                    <a id='connectme_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}" onclick="BlockInboxMe();" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    @endif

                @endif

                {{-- Requestor = Premium | Provider = Non-Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a id='viewprofile_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}" onclick="premiumToNonPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>
                    <a id='connectme_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    
                    <?php if(App\VideoChat::getVcURL($item->id, 'build', $requestor_id) == null){ ?>
                        <a id='videochat_btn_{{ $buildCount }}' href="#" Opptype="{{ $opportunity_type }}"  onclick="OppVcMe( '{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $company->id }}', '{{ $requestor_id }}', '{{ $item->id }}','build');" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                        <?php } else { ?>
                        <a id='videochat_btn_{{ $buildCount }}' href="<?php echo App\VideoChat::getVcURL($item->id, 'build', $requestor_id); ?>" target="_blank" Opptype="{{ $opportunity_type }}" class="btn blue btn_options"> <span class="fa fa-video-camera"></span> &nbsp; Video Chat Me</a>
                    <?php } ?> 

                @endif

                @if(App\User::getEBossStaffTrue(Auth::id()) == true)
                  <a href="{{ url('/opportunity/deleteBuild/'.$item->id) }}"
                   class="btn btn-danger btn_options"
                   onclick="return confirm('Are you sure to delete an opportunity item?')">Delete</a>
                @endif
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
    $buildCount++;
    endforeach;  ?>
    </div>
      <!-- END BUILD OPPORTUNITY -->

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
                    <h4><strong> Brief Description of the Company  </strong></h4>
                </span>
                <span class="content-text">
                    <h4> {{ $item->intro_describe_business }} </h4>
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


{{-- Start Connect Me Modal --}}
<div 
  class="modal fade modal_oppoBox" 
  id="inboxMeModal" 
  tabindex="-1" role="dialog" 
  aria-labelledby="Connect Me Modal" 
  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header chat-header">
            <img  id='chatAvatar'>
            <h2 class='chatOppTitle'></h2>
            <button type="button" class="close chat-close" data-dismiss="modal" aria-hidden="true">&times;</button>
         
        </div>
        <div class="modal-body">

          <div id="page-wrap">
    
              
              <p id="name-area"></p>
              
              <div id="chat-wrap"><div id="chat-area"></div></div>

            <div class="message-input">
                <div class="wrap">
                    <input id="sendie" type="text" placeholder="Write your message here..."  >
                    {{-- <textarea id="sendie" placeholder="Type your message here..." maxlength = '100' rows="2" ></textarea> --}}
                    <button title="Send" id='sendMessage' class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>

              <div class="send-msg-container" style="display: none;">
                <form id="send-message-area">
                    <input type="hidden" id="chat-companyViewer">
                    <input type="hidden" id="chat-companyOpp">
                    <input type="hidden" id="chat-oppId">
                    <input type="hidden" id="chat-oppType">
                </form>
              </div>
        </div>
            

          

        
        </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default chat-close" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>
<!-- END Connect Me MODAL -->


{{-- Start Video Chat Me Modal --}}
<div 
  class="modal fade modal_oppoBox" 
  id="videochatMeModal" 
  tabindex="-1" role="dialog" 
  aria-labelledby="Connect Me Modal" 
  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header chat-header">
            <img  id='chatAvatar'>
            <h2 class='chatOppTitle'></h2>
            <button type="button" class="close chat-close" data-dismiss="modal" aria-hidden="true">&times;</button>
         
        </div>
        <div class="modal-body">

          <div id="page-wrap">
    
              
              <p id="name-area"></p>
              
              <div id="chat-wrap">
                <video id="localVideo" style="float:right;" autoplay muted></video>

                <video id="remoteVideo" style="float:left;" autoplay></video>    
              </div>
            
        </div>

        
        </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default chat-close" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>
<!-- END Connect Me MODAL -->

 <div class='intro-tour-overlay'></div>

    <script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>
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

            formData = new FormData();
            formData.append("model", type +' Opportunity');
            formData.append("action", 'Viewing');
            formData.append("details", "Learn more "+type+" Opportunity | " + id);
            $.ajax({
                url: "{{ route('saveAuditTrailLog') }}",
                type: "POST",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                  console.log(data);
                }
            });

        }

        $(document).ready(function () {

            $(".follow-cont").click(function (e) {
                    formData = new FormData();
                    var comp_id = $(this).attr('dataVal');
                      formData.append("company_id", comp_id );
                      $.ajax({
                          url: "{{ route('updateFollowCompany') }}",
                          type: "POST",
                          async: true,
                          data: formData,
                          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                          processData: false,
                          contentType: false,
  
                          success: function (data) {
                            formData = new FormData();
                            //formData.append("model", data +' Opportunity');

                            if(data == 'add'){
                                $('.followicon_'+comp_id).addClass('fa-user-minus');
                                $('.followicon_'+comp_id).removeClass('fa-user-plus');
                                $('.followicon_'+comp_id).attr('title','Unfollow Company');
                                formData.append("action", 'Unfollow');
                                formData.append("details",  'Unfollow Company | '+ comp_id);
                            }else{
                                $('.followicon_'+comp_id).removeClass('fa-user-minus');
                                $('.followicon_'+comp_id).addClass('fa-user-plus');
                                $('.followicon_'+comp_id).attr('title','Follow Company');
                                formData.append("action", 'follow');
                                formData.append("details",  'Follow Company | '+ comp_id);
                            }

                            $.ajax({
                                url: "{{ route('saveAuditTrailLog') }}",
                                type: "POST",
                                data: formData,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                processData: false,
                                contentType: false,
                                cache: false,
                                success: function (data) {
                                  console.log(data);
                                }
                            });

                          }
                    });

            });

            $('.chat-close').click(function(){
                clearInterval(chatInterval);
            });

            $('#inboxMeModal').on('hide.bs.modal', function (e) {
                clearInterval(chatInterval);
            })

            $("#opporDetailsContentModal").modal();
            $("#filterKeywords").click(function () {
                var keyS = $("#keywordSearch").val();
                var getUrl = window.location;
                var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                if (keyS != "") {
                    window.location.href = baseUrl + "/exploreKey/" + encodeURIComponent(keyS);
                } else {
                    window.location.href = baseUrl + "/explore";
                }
            });

            $("#filterCountry").click(function () {
                var keyS = $("#keywordCountry").val();
                var getUrl = window.location;
                var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                if (keyS != "") {
                    window.location.href = baseUrl + "/exploreCountry/" + encodeURIComponent(keyS);
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

        function stockTokenInfo(stockToken){
          $('.modal_oppoBox').modal('hide');
          if(stockToken)
            stockToken = stockToken;
          else
            stockToken = 0;

          swal({
              title: 'Unsufficient token. You only have '+stockToken+' token in your account',
              text:  'This action requires at least 12 token. We will redirect you to Buy token|Credit page and find options suitable on what you need',
              icon:  'warning'
            }).then(function() {
                window.location.href = "{{ route('reportsBuyTokens') }}";
            });
        }
        
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

        function nonPremiumToNonPremium(companyOpp,companyViewer,templateType)
        {
            $('.modal_oppoBox').modal('hide');
              swal({
                  title:"This requires premium account to open this profile.", 
                  text: "Are you sure to proceed?  Because we will send an email notification to this company and redirect you to Dashboard page and find the upgrade button at Token Credit section.",
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
  
        function premiumToNonPremium(companyOpp,companyViewer,templateType)
        {
            $('.modal_oppoBox').modal('hide');
            swal({
                title:"The provider of this opportunity is non-premium.", 
                text: "Are you sure to proceed? Because we will send an email notification to this company and encourage them to upgrade thier account to premium.",
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
                              title: 'Email notification succesfully sent to the opportunity provider.',
                              text:  'You may drop a message directly to the provider through "Connect Me"',
                              icon:  'success'
                            }).then(function() {
                                   //document.location = '{{ url("reports/buyTokens") }}';
                                //document.location = '{{ url("/home") }}';
                            
                            });
                        }
                    });

                } else {
                    swal("Cancelled", "Notifying the opportunity provider was cancelled", "error");
                }
              });
        }
          
        function nonPremiumToPremium(companyOpp,companyViewer,templateType)
        {
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
                                url , "_blank"); 
                              });
                        }
                    });

                } else {
                    swal("Cancelled", "To become premium account was cancelled :)", "error");
                }
              });
        }
        
        function DeductThreeInboxMe(avatarUrl, oppTitle, oppId, companyOpp, companyViewer, oppType)
        {
            $('.modal_oppoBox').modal('hide');
            swal({
                title:"This will cost you 3 credits", 
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
                    formData.append("companyProvider", companyOpp);
                    formData.append("companyRequester", companyViewer);
                    formData.append("oppId", oppId);
                    formData.append("oppType", oppType);
                    
                    $.ajax({
                        url: "{{ route('getChatCredit') }}",
                        type: "POST",
                        async: true,
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        processData: false,
                        contentType: false,

                        success: function (data) {
                            
                            if(data == 0){
                                swal("Error", "Error in paying with 3 credits company requester and viewer does not matched", "error");    
                            } else {
                                OppInboxMe(avatarUrl, oppTitle, companyOpp, companyViewer, oppId, oppType); //open the chat box
                            }
                        }
                    });

                } else {
                    swal("Cancelled", "To pay 3 credit to message via inbox was cancelled :)", "error");
                }
              });

        }

        function NotifyError(){
            $('.modal_oppoBox').modal('hide');
            swal({
                title:"An error occured!", 
                text: "Reloading the page now!",
                icon: "warning",
                dangerMode: true,

              }).then(function(isConfirm) {
                    location.reload();
            });
        }
        function BlockInboxMe()
        {
            $('.modal_oppoBox').modal('hide');
            swal({
                title:"You are not a premium account, and you don't have 3 credits in your wallet to inbox the company of this opportunity.", 
                text: "Are you sure to proceed?, and I will redirect you to buying credit page.",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {
                    document.location = '{{ url("reports/buyTokens") }}';   
                }else {
                    swal("Cancelled", "To become premium account was cancelled :)", "error");
                }

            });
      
        }

        var chatInterval;
        function OppInboxMe(avatarUrl, title, companyOpp,companyViewer,oppId,oppType){
            $('.chatOppTitle').text(title);
            $('#chatAvatar').attr('src',avatarUrl);
            $('#chat-companyOpp').val(companyOpp);
            $('#chat-companyViewer').val(companyViewer);
            $('#chat-oppId').val(oppId);
            $('#chat-oppType').val(oppType);

            $('#chat-area').empty();
            $("#chat-area").append(`
                <p class="chat-intro-text"> Welcome to Intellinz chat! 
                    <br>
                        Congrats for finding your potential business match. 
                        Get started by introducing yourself & your company to the opportunity provider. Please be as respectful as possible when connecting with your potential partner.
                        Good luck! 
                </p>
                `);
            chat.onload();
            chat.getState(); 

            chatInterval = setInterval('chat.update( )', 1000);
     
            $('#inboxMeModal').modal();

        }

        function OppVcMe(avatarUrl, title,companyOpp,companyViewer,oppId,oppType){

            //window.open("http://localhost/prokakis/vc/"+oppId+"/"+oppType+"/"+companyOpp+"/"+companyViewer, '_blank');
            // window.open("https://test.app-prokakis.com/vc/"+oppId+"/"+oppType+"/"+companyOpp+"/"+companyViewer, '_blank');
            window.open("https://app-prokakis.com/vc/"+oppId+"/"+oppType+"/"+companyOpp+"/"+companyViewer, '_blank');
         
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
                //var maxLength = $(this).attr("maxlength");  
                   var length = this.value.length;  
                   // don't allow new content if length is maxed out
                if (length >= 200) {  
                       event.preventDefault();  
                   }  
                }  
            });


       // watch textarea for release of key press
       $('#sendie').keyup(function(e) { 
          if (e.keyCode == 13) { 
                  var text = $(this).val();
                //var maxLength = $(this).attr("maxlength");  
                  var length = text.length; 
                  // send 
                if (length > 1) { 
                chat.send(text, name);  
                $(this).val("");
                } 
                    // $(this).val(text.substring(0, maxLength));
                    //event.preventDefault(); 
            }
        });
                
                  
       // watch textarea for release of key press
       $('#sendMessage').click(function(e) { 
            
            var text = $('#sendie').val();
            //var maxLength = $('#sendie').attr("maxlength");  
            var length = text.length; 
            // send 
            if (length > 1) { 
                chat.send(text, name);  
                $('#sendie').val("");
              } 
                // $("#sendie").val(text.substring(0, maxLength));
                //event.preventDefault(); 
          
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
    this.onload = chatload;
}

//gets the state of the chat
function getStateOfChat(){
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();

  if(!instanse){
     instanse = true;
      formData = new FormData();
      formData.append("function", 'getState');
      formData.append("companyOpp", companyOpp);
      formData.append("companyViewer", companyViewer);
      formData.append("oppId", oppId);
      formData.append("oppType", oppType);
      formData.append("chatAction", "1");

      
      $.ajax({
          url: "{{ route('chatProcess') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
            state = data.state;
            instanse = false;
          },
            error: function(){
                NotifyError();
          }
      });

  }  
}

function chatload(){
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();
    var requestorAvatar = $('#chatAvatar').attr('src');

      formData = new FormData();
      formData.append("function", 'onload');
      formData.append("companyOpp", companyOpp);
      formData.append("companyViewer", companyViewer);
      formData.append("oppId", oppId);
      formData.append("oppType", oppType);
      formData.append("chatAction", "1");

      
      $.ajax({
          url: "{{ route('chatProcess') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
            
            if(data.text != false){
                $('#chat-area').empty();
                $("#chat-area").append(`
                <p class="chat-intro-text"> Welcome to Intellinz chat! 
                    <br>
                        Congrats for finding your potential business match. 
                        Get started by introducing yourself & your company to the opportunity provider. Please be as respectful as possible when connecting with your potential partner.
                        Good luck! 
                </p>
                `);
                for (var i = 0; i < data.text.length; i++) {
                    if(data.text[i].action != 1){
                      $('#chat-area').append($("<div class='chat-area-text chat-requestor'><img class='requestorAvatar' src='"+requestorAvatar+"' /><span><h6>"+data.text[i].sender+ "</h6><p>"+ data.text[i].text +"</p></span></div>"));
                    }else{
                      $('#chat-area').append($("<div class='chat-area-text chat-provider'><span><h6>"+data.text[i].sender+data.text[i].action+ "</h6><p>"+ data.text[i].text +"</p></span><img class='providerAvatar' src='https://app-prokakis.com/public/images/me.png'  /></div>"));
                    }
                }    
            document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
           }

          },
        error: function(){
            NotifyError();
          }
      });
}

//Updates the chat
function updateChat(){
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();
    var requestorAvatar = $('#chatAvatar').attr('src');

   if(!instanse){
     instanse = true;

      formData = new FormData();
      formData.append("function", 'update');
      formData.append("companyOpp", companyOpp);
      formData.append("companyViewer", companyViewer);
      formData.append("oppId", oppId);
      formData.append("oppType", oppType);
      formData.append("state", state);
      formData.append("chatAction", "1");
      
      $.ajax({
          url: "{{ route('chatProcess') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
            
            if(data.text != false){
                $('#chat-area').empty();
                $("#chat-area").append(`
                <p class="chat-intro-text"> Welcome to Intellinz chat! 
                    <br>
                        Congrats for finding your potential business match. 
                        Get started by introducing yourself & your company to the opportunity provider. Please be as respectful as possible when connecting with your potential partner.
                        Good luck! 
                </p>
                `);
                for (var i = 0; i < data.text.length; i++) {
                    if(data.text[i].action != 1){
                      $('#chat-area').append($("<div class='chat-area-text chat-requestor'><img class='requestorAvatar' src='"+requestorAvatar+"' /><span><h6>"+data.text[i].sender+ "</h6><p>"+ data.text[i].text +"</p></span></div>"));
                    }else{
                      $('#chat-area').append($("<div class='chat-area-text chat-provider'><span><h6>"+data.text[i].sender+data.text[i].action+ "</h6><p>"+ data.text[i].text +"</p></span><img class='providerAvatar' src='https://app-prokakis.com/public/images/me.png'  /></div>"));
                    }
                }    
            document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
           }
           instanse = false;
           state = data.state;

          },
        error: function(){ 
            NotifyError();
          }
      });

   }
   else {
     setTimeout(updateChat, 1500);
   }
}

//send the message
function sendChat(message, nickname)
{       
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();

    // updateChat(companyOpp, companyViewer );

    formData = new FormData();
    formData.append("function", 'send');
    formData.append("message", message);
    formData.append("companyOpp", companyOpp);
    formData.append("companyViewer", companyViewer);
    formData.append("oppId", oppId);
    formData.append("oppType", oppType);
    formData.append("chatAction", "1");
    
    $.ajax({
        url: "{{ route('chatProcess') }}",
        type: "POST",
        data: formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            updateChat();
        },
        error: function(){
            NotifyError();
        }
    });

}


    </script>
{{-- <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script> --}}

 <script>
// Instance the tour
var tour = new Tour({
  steps: [
  {
    element: "#keywordSearch",
    title: "Filter by Keyword",
    content: "you can filter your search result by keyword"
  },
  {
    element: "#keywordCountry",
    title: "Filter by Country",
    content: "you can filter your search result by country"
  },
    {
    element: "#build-sect",
    title: "Build Opportunities",
    content: "Opportunities created under Build Category",
    placement: "top"
  },
    {
    element: "#sell-sect",
    title: "Sell Opportunities",
    content: "Opportunities created under Sell Category" ,
    placement: "top"
  },
    {
    element: "#buy-sect",
    title: "Buy Opportunities",
    content: "Opportunities created under Buy Category",
    placement: "top"
  },
    {
    element: "div.build-list:first",
    title: "Build Opportunity",
    content: "build opportunity",
    placement: "top"
  },
{
    element: "div.content :first",
    title: "Content Preview",
    content: "This are the preview content of the opportunity.",
    placement: "top"
  },
  {
    element: "div.learn_more :first",
    title: "Learn More",
    content: "Click this button to read more details about this opportunity",
    placement: "top"
  },
    {
    element: "div.follow-cont :first",
    title: "Follow/Unfollow",
    content: "Click this icon if you want to follow/Unfollow opportunity",
    placement: "top",
    onNext: function(){
        $('div.learn_more').find('button').eq(0).trigger('click');
        $(".modal-backdrop").hide();
       $(".modal").css('z-index','5'); 
       $(".popover").css('z-index','7'); 
    },
  },
    {
    element: "div.build_modal_0  h4.modal-title",
    title: "Title",
    content: "This is the title of the opportunity",
    placement: "bottom"

  },
    {
    element: "#rating_section_0",
    title: "Ratings",
    content: "This is where the company rating shown",
    placement: "bottom"

  },
    {
    element: "#seeking_section_0",
    title: "The Company is Seeking",
    content: "Information what the company is seeking",
     placement: "top"
  },
    {
    element: "#expectation_section_0",
    title: "Expectation",
    content: "Information what is the expectation of the company",
     placement: "top"
  },
      {
    element: "#keyword_section_0",
    title: "Industry Keyword",
    content: "List of keyword used",
     placement: "top"
  },
        {
    element: "#whypartner_section_0",
    title: "Why Partner with this Company?",
    content: "Information and benefits to make partners with this company",
     placement: "top"
  },
          {
    element: "#relevant_section_0",
    title: "Relevant Industry or products",
    content: "List of relevant industry or products ",
    placement: "top"
  },
{
    element: "#dilligence_btn_0",
    title: "Due Dilligence Report",
    content: " Can Generate Report by clicking this button ",
    placement: "top"
  },
  {
    element: "#viewprofile_btn_0",
    title: "View Profile",
    content: " Can View the Company Profile",
    placement: "top"
  },
    {
    element: "#connectme_btn_0",
    title: "Connect Me",
    content: "This is Intellinz chat where you and the partners can exchange text realtime",
    placement: "top"
  },
      {
    element: "#videochat_btn_0",
    title: "Video Chat",
    content: "You can video chat here together with possible parters",
    placement: "top"
  }
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
  orphan: true,
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
     $(".modal-backdrop").show();
        $(".modal").css('z-index','10050'); 
       $(".popover").css('z-index','1102'); 
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

@endsection