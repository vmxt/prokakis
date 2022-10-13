

@extends('layouts.app')



@section('content')

<link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">



<style>

    html,body

    {

        width: 100%;

        height: 100%;

        margin: 0px;

        padding: 0px;

        overflow-x: hidden;

        overflow: visible;

    }

    

        .niceDisplay{

            font-family: 'PT Sans Narrow', sans-serif;

            background-color: white;

            padding: 15px;

            border-radius: 3px;

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

            text-align: center;

            width:300px;

        }  

        .containerCimg

        {

      

        }

        .actionCimg

        {

            width: 300px;

            height: 30px;

            margin: 5px 0;

            float: left;

        }

        .croppedCimg>img

        {

            margin-right: 10px;

        }

</style>









<div class="container">

    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

        <li>

            <a href="{{ url('/home') }}">Home</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            <a href="#">Profile</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            <span>Contacts</span>

        </li>

    </ul>

    <div class="row justify-content-center">

        <div class="page-content-inner">

            <div class="mt-content-body">

                    <div class="col-md-4 justify-content-center">

                        <div class="portlet light">

                        <div class="card">

                            <div class="card-header">

                                <div class="containerCimg">

                                    <div id="croppedCimg" class="croppedCimg" align="center">

                                    </div>



                                    <div class="imageBoxCimg">

                                        <div class="thumbBoxCimg"><img

                                                    src="{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>">

                                        </div>

                                  

                                    </div>

                                    <div class="niceDisplay">

                                        <?php if (isset($brand_slogan[0])) {

                                            echo $brand_slogan[0];

                                        } ?>

                                    </div>

                                </div>



                                <div><br/></div>



                            </div>



                        </div>

                    </div>

                </div>



            </div>

        </div>



        <div class="page-content-inner">

            <div class="mt-content-body">

                <div class="page-content-inner">

                    <div class="mt-content-body">

                        <div class="col col-md-8">

                            <div class="portlet light">

                                

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



                                <!-- sidebar token credit -->



                                    <div class="card">



                                        <div class="card-header"><b>Intellinz Rewards</b></div>

                                        <br>

                                        <div class="alert bg-dark text-company" style="overflow: hidden; ">

                                            <div class="col-sm-6">
                                                <div class="card" >
                                                  <div class="card-body">
                                                    <h5 class="card-title"><b class="text-company">How Do I Earn Intellinz Reward Points?</b></h5>
                                                        <ul class="text-white" style="line-height: 25px">
                                                            <li>Get 0.12 points for every credit purchased.</li>
                                                            <li>Introduce and share to a friend or business associate and get 0.05 points.</li>
                                                            <li>Earn 0.01 points passively every time your. referrals purchase 1 credit for Intellinz services</li>
                                                        </ul>
                                                  </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="card" >
                                                  <div class="card-body">
                                                    <h5 class="card-title"><b class="text-company">Cashing in Reward Points?</b></h5>
                                                        <ul class="text-white" style="line-height: 25px;">
                                                            <li>50 Points = Advisor Level Worth USD$50.</li>
                                                            <li>200 Points = Gold Advisor Worth USD$300.</li>
                                                            <li>500 Points = Platinum Advisor Worth USD $1500</li>
                                                            <li>ONLY ADVISORS LEVEL CAN REDEEM POINTS</li>
                                                        </ul>
                                                  </div>
                                                </div>
                                            </div>
                                       </div>



                                        <div class="card-body center">

                                            @if ($errors->any())

                                                <div class="alert alert-danger">

                                                    <ul>

                                                        @foreach ($errors->all() as $error)

                                                            <li>{{ $error }}</li>

                                                        @endforeach

                                                    </ul>

                                                </div>

                                            @endif

                                        </div>        

                                        <table class="table table-hover table-light">
                                            <tr>
                                                <td style="width:70%">
                                                        <div class="card" style="overflow: hidden;">
                                                            <div class="card-header">
                                                                    
                                                                    <span class="bold " style="color:black">Your total credit is {{ $totalCreditPurchased }}. <br /></span>

                                                                    <hr>

                                                                    <span class="bold " style="color:black">Your total number of referrals is {{ $totalNumberOfReferrals }}. <br /></span>


                                                                    <hr>


                                                                    <span class="bold " style="color:black">Your points on referrals credit purchased a combined total of {{ $totalNumberOfReferralsPurchasedPoints }}. <br /></span>

                                                                    
                                                                    <hr>

                                                                    <span class="bold " style="color:black">Your points on referrals report request a combined total of {{ $totalNumberOfReferralsReportsPoints }}. <br /></span>

                                                                    
                                                                    <br /><br />

                                                                    <?php 

                                                                    $ed = App\SpentTokens::getPremiumExpiryDate($company_id_result);

                                                                    if($ed != false){
                                                                    echo ' Premium account expires on ' . $ed;
                                                                    }
                                                                    ?>

                                                            </div>

                                                        </div>

                                                </td>



                                                <td style="width:30%">



                                                    <div class="card" style="overflow: hidden;">

                                                        <div class="card-header">

                                                            <center><span class="bold uppercase " style="color:black">TOTAL POINTS EARNED</span>
                                                            </center>

                                                        </div>

                                                        <div class="card-body center" style="text-align: center;">

                                                            <b class="font-red-mint" style="font-size: 20px;"> {{ $totalScore }}  </b> <br/>

                                                            <br/>


                                                        </div>

                                                    </div>


                                                        <div class="card" style="overflow: hidden;">
                                                            <div class="card-header">
                                                                <center><span class="bold uppercase " style="color:black">POINTS NEEDED TO NEXT LEVEL</span>
                                                                </center>
                                                            </div>

                                                            <div class="card-body center" style="text-align: center;">
                                                                <b class="font-red-mint" style="font-size: 20px;"> {{ $nextScoreLevel }}  </b> <br/>
                                                                <br/>
                                                            </div>
                                                        </div>

                                                    <div class="card">
                                                        <div class="card-header" style="text-align: center;"> 
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                                REDEEM
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div style="display: none;" class="card" style="overflow: hidden;">
                                                        @if($countAd > 0)
                                                            <div class="card-header"> 

                                                                <center>
                                                                <button class="btn red-mint btn-full" type="button" disabled>PENDING</button> 
                                                                </center>
                                                            </div>
                                                        @else
                                                            <div class="card-header"> 
                                                                @if( $currentAdvisorLevel >= 1 )
                                                                    <center>
                                                                    <form id="redeemForm" class="redeem-form" action="{{ route('redeemRewards') }}" method="post">
                                                                    {{ csrf_field() }}  
                                                                    <input type="hidden" name="amount_to_redeem" value="{{ $amountToRedemp }}">
                                                                    <input type="hidden" name="advisor_level" value="{{ $amountToRedemp }}">
                                                                    <input type="button" id="submit_button" name="submit_button" class="btn red-mint btn-full redeemBtn" value="REDEEM USD ${{ $amountToRedemp }} NOW">
                                                                    </form>    
                                                                    </center>
                                                                @else  
                                                              <!--   <center>
                                                                <button class="btn btn-primary" type="button" disabled>REDEEM USD $100 NOW</button> 
                                                                </center> -->
                                                                @endif 
                                                               

                                                            </div>
                                                        @endif
                                                   

                                                    </div>

                    <!-- MODAL FOR REDEEM -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Redeem Points Earned</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <div class="modal-body col-sm-12" >
                            <div class="col-sm-4">
                                <div class="card" >
                                  <div class="card-body">
                                    <h5 class="text-company card-title "><b>Advisor Level</b></h5>
                                    <p class="card-text">{{ $advisorTips1 }}</p>
                                    @if($totalScore >= 50)
                                    <form id="redeemForm" class="redeem-form" action="{{ route('redeemRewards') }}" method="post">
                                        {{ csrf_field() }}  
                                        <input type="hidden" name="amount_to_redeem" value="{{ $amountToRedemp }}">
                                        <input type="hidden" name="advisor_level" value="{{ $amountToRedemp }}">
                                        <input type="button" id="submit_button" name="submit_button" class="btn red-mint btn-full redeemBtn" value="REDEEM USD ${{ $amountToRedemp }} NOW">
                                    </form>
                                    @else
                                        <button class="btn btn-primary"   style="font-size: 12px;" type="button" disabled>REDEEM USD $50 NOW</button> 
                                    @endif
                                    <!-- <a href="#" class="btn btn-primary" style="font-size: 12px;">REDEEM USD $50 NOW</a> -->
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                  <div class="card-body">
                                    <h5 class="text-company card-title"><b>Gold Advisor</b></h5>
                                    <p class="card-text">{{ $advisorTips2 }}</p>
                                    <a href="#" class="btn btn-primary" style="font-size: 12px;">REDEEM USD $300 NOW</a>
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                  <div class="card-body">
                                    <h5 class="text-company card-title"><b>Platinum Advisor</b></h5>
                                    <p class="card-text">{{ $advisorTips3 }}</p>
                                    <a href="#" class="btn btn-primary" style="font-size: 12px;">REDEEM USD $1500 NOW</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                        </div>
                      </div>
                    </div>
                    <!-- MODAL FOR REDEEM -->

                                                </td>

                                            </tr>

                                        </table>



                                    </div>





                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<script src="{{ asset('public/jq1111/jquery.min.js') }}"></script>



<script src="{{ asset('public/img-cropper/js/cropbox.js') }}"></script>

<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>



<script type="text/javascript">

    $("#submit_button").click(function(){
        swal({

            title: "Redeeming your points now will reset them to zero",
            text: "Are you sure you want to proceed?",
            icon: "warning",

            buttons: [
              'No, cancel it!',
              'Yes, I am sure!'
            ],
            dangerMode: true,

          }).then(function(isConfirm) {

            if (isConfirm) {
                $("#redeemForm").submit();  
                $("#redeemBtn").text('Pending');  

            } else {

              swal("Cancelled", "Redeeming pprocess was cancelled :)", "error");
               return false; 

            }

          })

      });    


  

</script>



@endsection















