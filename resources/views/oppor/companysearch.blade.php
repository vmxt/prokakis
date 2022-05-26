@extends('layouts.app')



@section('content')

<script src="{{ asset('public/jq-autocomplete/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('public/jq-autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.themes.min.css') }}" rel="stylesheet"
      type="text/css"/>


<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
<style>
    #chat-wrap {
      background-image: url("{{ asset('public/img-resources/chat-backdrop.png') }}");
      background-position: bottom;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }

    .container-grid .blog-posts .row {
        display: unset !important;
    }

    .container-grid .blog-posts .post .image{
        width: 20% !important;
    }

    .container-grid .blog-posts .post .content{
        width: 65% !important;
        height: auto !important;
        padding-left: 100px !important;
    }

    .hr_title{
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .content{
        text-align: center;
    }

    .ratingScore1 {
        margin: 8px !important;
        position: absolute;
        right: 210px;
        font-size: 20px;
    }
    .social-icon{
        font-size: 30px !important;
    }
    .content-text a {
        margin-left: 20px;
    }

</style>
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/companySearch.css') }}">


    <div class="container container-grid">
        <div class="col-md-12" >
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
?>

        <div class="row">
            <!-- START Search Company-->
             {{ $companySearch->links() }}    
            <div class="hr-sect opp_type" >Search by Company</div>
                <div class='blog-posts'>
                <?php       
                    $i = 1;
                    $build = [];
                    foreach ($companySearch as $item): 
                       //dd($item);
                            $opportunity_type = 'build';
                            $d_status = App\CompanyProfile::getDeactivateInfo($item->id);
                            $company = App\CompanyProfile::find($item->id);
                            $provider_id = $company->id;
                    if ( $company->count() > 0 && $d_status == true):
                        $avatar = \App\UploadImages::where('company_id', $item->id)->where('file_category', 'PROFILE_AVATAR')
                            ->orderBy('id', 'desc')
                            ->first();
                        $avat = '';
                        if (!isset($avatar->file_name)) 
                            $avat = asset('public/images/industry')."/guest.png";
                        else 
                            $avat = asset('public/images')."/".$avatar->file_name;
                        
                        $usr = App\User::find($company->user_id);
                        $accStatus = 'free';
                        if ($usr->user_type == 1) 
                            if( App\SpentTokens::validateAccountActivation($item->id) != false )
                                $accStatus = 'premium';   

                        $profileAvatar = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.profile'), 1);
                        $profileAwards = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.awards'), 5);
                        $profilePurchaseInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.purchase_invoices'), 5);
                        $profileSalesInvoice = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.sales_invoices'), 5);
                        $profileCertifications = App\UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.certification'), 5);

                        $ratingScore = App\CompanyProfile::profileCompleteness(array($company, $profileAvatar, $profileAwards,
                        $profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));
                       
                        $avatarUrl = $avat;


                    ?>
        
        <!-- new code start -->
        @if($i == 1)
            <div class='row cf list-row-build '>
        @endif
        @if($i <= 2)
              <div class='post company-list' >
                <?php 
                    $followComp = App\CompanyFollow::checkFollowCompany( Auth::id(), $company->id ) ;
                    if( $followComp > 0) {
                        $iconName = 'fa-user-minus';
                        $iconTitle = "Unfollow this company";
                    }else{
                        $iconName = 'fa-user-plus';
                        $iconTitle = "Follow this company";

                    }
                ?>
                    <div class='follow-cont' dataVal="{{ $company->id }}">
                        <i class="fas {{ $iconName }} fa-2x follow-icon followicon_{{ $company->id }}" title="{{ $iconTitle }}"  ></i>
                    </div>

                <a href='#'>
                    <div class='image' style='background-image: url( {{ $avatarUrl }}  )'>

                        <?php if(App\InOutUsers::checkOnlineByCompany($company->id) == 1){ ?>
                        <a target="_blank" href="{{ url('/vc-companysearch') }}/{{ $company->id }}">  
                        <!--<img class='video-chat-icon' title="Company is Online" alt="Video Chat Company is online" src="{{ asset('public/vc_image/vc_online.png') }}">   -->
                        </a> 
                        <?php } else { ?>   
                        <!--<img class='video-chat-icon' title="Company is Offline" alt="Video Chat Company" src="{{ asset('public/vc_image/vc_offline.png') }}">    -->
                        <?php }  ?> 

                @if($accStatus == 'premium')
                    <img class="premium_banner" alt="Premium Banner" src="{{ asset('public/banner/premium_banner.png') }}">
                @endif
                    </div>



                  <div class='content'>
                    <h1 class='upperText' title="{{ $item->company_name }}"> <?= $item->company_name != "" ? $item->company_name : 'Providing Business Valuation' ?></h1>
                    
                    <div class="hr-sect"><strong class="hr_title">Description</strong></div>
                         <p><?php echo $item->description?$item->description: "N/A" ; ?></p><br>

                    <div class="hr-sect"><strong class="hr_title">Industry Type</strong></div>
                         <p><?php echo $item->industry?$item->industry: "N/A" ; ?></p><br>
        

                    <div class="hr-sect"><strong class="hr_title">Rating</strong></div>
                    <div style="display: flex;">
                        <div style="margin: 0 auto;">
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

                        <div class="rating_score ratingScore1">
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
        id="searchCompanyModal{{ $item->id }}" 
        tabindex="-1" role="dialog" 
        aria-labelledby="opporDetailsContentModalLabel" 
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title upperText" id="opporDetailsContentModalLabel"> <?= $item->company_name != "" ? $item->company_name : 'Providing Company' ?></h4>
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
                                       
                    <h2 class="rating_score" style="font-size: 20px;" > {{ $ratingScore }} % </h2>
                </div>
                <hr>
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Business Type </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->business_type ? $item->business_type : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Years Establisment </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->years_establishment ? $item->years_establishment : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Anual Tax Return </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->annual_tax_return ? $item->annual_tax_return : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Gross Profit </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->gross_profit ? $item->gross_profit : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Net Profit </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->net_profit ? $item->net_profit : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Currency </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->currency ? $item->currency : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> # of Staff </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->no_of_staff ? $item->no_of_staff : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Corporate Tax </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->corporate_tax ? $item->corporate_tax : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Solvent </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->solvent_value ? $item->solvent_value : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Office Address </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->registered_address ? $item->registered_address : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Office Phone </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->office_phone ? $item->office_phone : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Mobile Phone </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->mobile_phone ? $item->mobile_phone : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4><strong> Company Email </strong></h4>
                </span>
                <span class="content-text">
                    <h5>{{ $item->company_email ? $item->company_email : "N/A"  }}</h5>   
                </span>
                <hr class="hr-sect">
            </div>

            <div>
                <span class="title-text">
                    <h4 style="margin-bottom: 10px !important"><strong> Social Media </strong></h4>
                </span>
                <span class="content-text" style="padding:10px" >
                @if( $item->facebook )
                  <a target="_blank" href="{{ $item->facebook }}"><i class="fa fa-facebook-square fa-fw fa-5x social-icon" style="color: black" aria-hidden="true"></i></a>
                @endif
                @if( $item->twitter )
                  <a target="_blank" href="{{ $item->twitter }}"><i class="fa fa-twitter fa-fw fa-5x social-icon" style="color: black" aria-hidden="true"></i></a>
                @endif
                @if( $item->linkedin )
                  <a target="_blank" href="{{ $item->linkedin }}"><i class="fa fa-linkedin fa-fw fa-5x social-icon" style="color: black" aria-hidden="true"></i></a>
                @endif
                @if( $item->googleplus )
                  <a target="_blank" href="{{ $item->googleplus }}"><i class="fa fa-google-plus-square fa-fw fa-5x social-icon" style="color: black" aria-hidden="true"></i></a>
                @endif
                @if( $item->otherlink )
                  <a target="_blank" href="{{ $item->googleplus }}"><i class="fa fa-link fa-fw fa-5x social-icon" style="color: black" aria-hidden="true"></i></a>
                @endif
                </span>
                <hr class="hr-sect">
            </div>

            <div>
              @if($tokenStock >= 12)
                <a onclick="processReq('build', '{{ $item->id }}');" class="btn blue btn_options"><span class="fa fa-check"></span> Due Diligence Report</a>
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
                        @if(App\ChatHistory::getChatPayStatus($item->id, 'build', $requestor_id, $provider_id) == false)
                        <a href="#" Opptype="{{ $opportunity_type }}" onclick="DeductThreeInboxMe('{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $item->id }}', '{{ $company->id }}', '{{ $requestor_id }}' , 'build');" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        @else
                        <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->company_name }}', '{{ $company->id }}', '{{ $item->user_id }}', '{{ $item->company_email}}');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        @endif
                    @else
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="BlockInboxMe();" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    @endif

                @endif

                {{-- Requestor = Premium | Provider = Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) != false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="PremiumToPremium({{ $company->id }}, {{ $requestor_id }},'{{ url('/company/'.$viewer.'/'.$company->id) }}', '2');" class="btn blue btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->company_name }}', '{{ $company->id }}', '{{ $item->user_id }}', '{{ $item->company_email}}');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                @endif

                {{-- Requestor = Premium | Provider = Non-Premium 
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" onclick="checkAlertByPremium('{{ $company->id }}', '{{ $requestor_id }}');" class="btn default btn_options "> <span class="fa fa-credit-card"></span> View Profile</a>
                @endif --}}

                {{-- Requestor = Non-premium | Provider = Non-Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) == false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="nonPremiumToNonPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>

                    @if($tokenStock >= 3)
                        @if(App\ChatHistory::getChatPayStatus($item->id, 'build', $requestor_id, $provider_id) == false)
                        <a href="#" Opptype="{{ $opportunity_type }}" onclick="DeductThreeInboxMe('{{ $avatarUrl }}','{{  $item->opp_title }}', '{{ $item->id }}', '{{ $company->id }}', '{{ $requestor_id }}' , 'build');" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        @else
                        <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->company_name }}', '{{ $company->id }}', '{{ $item->user_id }}', '{{ $item->company_email}}');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                        @endif
                    @else
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="BlockInboxMe();" class="btn default btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                    @endif

                @endif

                {{-- Requestor = Premium | Provider = Non-Premium --}}
                @if(App\SpentTokens::validateAccountActivation($requestor_id) != false && App\SpentTokens::validateAccountActivation($provider_id) == false)
                    <a href="#" Opptype="{{ $opportunity_type }}" onclick="premiumToNonPremium('{{ $company->id }}', '{{ $requestor_id }}','1');" class="btn default btn_options"> <span class="fa fa-credit-card"></span> View Profile</a>
                    <a href="#" Opptype="{{ $opportunity_type }}"  onclick="OppInboxMe( '{{ $avatarUrl }}','{{  $item->company_name }}', '{{ $company->id }}', '{{ $item->user_id }}', '{{ $item->company_email}}');" class="btn blue btn_options"> <span class="fa fa-comment"></span> &nbsp; Connect Me</a>
                @endif

        &nbsp;&nbsp;&nbsp; <span>
                <a href="#" Opptype="{{ $opportunity_type }}" onclick="alertRequestOwnership({{ $requestor_id }}, {{ $provider_id }})"  class="btn green btn_options"> <span class="fa fa-comment"></span> &nbsp;Company Ownership </a>
                <a href="#" Opptype="{{ $opportunity_type }}" onclick="alertRequestRemoval({{ $requestor_id }}, {{ $provider_id }})"  class="btn red btn_options"> <span class="fa fa-comment"></span> &nbsp; Removal in Intellinz</a>
                </span>

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
      <!-- END BUILD OPPORTUNITY -->

   
</div></div>
</div><!-- end row -->
      </div>
        </div>
    </div>



{{-- Start Connect Me Modal --}}
<div 
  class="modal fade modal_oppoBox" 
  id="inboxMeModal" 
  data-backdrop="static"
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

            <div class="mail-area">
              <div class="form-group">
                <label for="e_subject" class="col-form-label">Subject:</label>
                <input type="text" placeholder="Subject" class="form-control" id="e_subject">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" placeholder="Type your message here..." cols="20" rows='5' id="message-text"></textarea>
              </div>
          </div>
        </div>
            <div class="send-msg-container" style="display: none;">
                <form id="send-message-area">
                    <input type="hidden" id="recipient_email" >
                    <input type="hidden" id="recipient_id" >
                    <input type="hidden" id="company_user_id" >
                </form>
            </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" onclick="connectMe()" class="btn btn-success">Send message</button>
          </div>
    </div>
  </div>
</div>
<!-- END Connect Me MODAL -->


    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
    <script>

     function alertRequestOwnership(reqId, provId)
        {
         window.open('{{ url("/req-own-company/") }}'+'/'+reqId+'/'+provId, '_blank');
        }

        function alertRequestRemoval(reqId, provId)
        {
         window.open('{{ url("/req-rem-company/") }}'+'/'+reqId+'/'+provId, '_blank');
        }


        function showModalContent(type, id){
            $("#searchCompanyModal"+id).modal();
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
                            if(data == 'add'){
                                $('.followicon_'+comp_id).addClass('fa-user-minus');
                                $('.followicon_'+comp_id).removeClass('fa-user-plus');
                                $('.followicon_'+comp_id).attr('title','Unfollow Company');

                            }else{
                                $('.followicon_'+comp_id).removeClass('fa-user-minus');
                                $('.followicon_'+comp_id).addClass('fa-user-plus');
                                $('.followicon_'+comp_id).attr('title','Follow Company');
            }
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

        function OppInboxMe(avatarUrl, title,companyId,companyUserId,companyEmail){
            $('.chatOppTitle').text(title);
            $('#chatAvatar').attr('src',avatarUrl);
            $('#recipient_email').val(companyEmail);
            $('#recipient_id').val(companyId);
            $('#company_user_id').val(companyUserId);
     
            $('#inboxMeModal').modal();

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

        function connectMe(){
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
                    formData.append("e_subject", $('#e_subject').val());
                    formData.append("e_message", $('#message-text').val());
                    formData.append("recipient_email", $('#recipient_email').val());
                    formData.append("company_user_id", $('#company_user_id').val());
                    formData.append("recipient_id", $('#recipient_id').val());
                    formData.append("template", "searchCompanyNotificaiton");

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
                    swal("Cancelled", "Sending this message was cancelled :)", "error");
                }
              });
        }




    </script>
{{-- <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script> --}}

@endsection
