

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

                                        <div class="alert alert-info" style="width: 100%; overflow: hidden; margin-left: 0px !important;">

                                            <table>
                                                <tr>
                                                  <td valign="top">  
                                                <b>How Do I Earn Intellinz Reward Points?</b> <br />
                                                - Get 0.12 points for every credit purchased. <br />
                                                - Introduce and share to a friend or <br /> business associate and get 0.05 points. <br />
                                                - Earn 0.01 points passively every time your <br /> referrals purchase 1 credit for Intellinz services. <br />
                                                  </td>

                                                  <td valign="top">  
                                                 <b>Cashing in Reward Points?</b> <br />
                                                    - 50 Points = Advisor Level Worth USD$100 <br />
                                                    - 150 Points = Gold Advisor Worth USD$375 <br />
                                                    - 500 Points = Platinum Advisor Worth USD$1750 <br />
                                                    - ONLY ADVISORS LEVEL CAN REDEEM POINTS <br />
                                                 </td>

                                                </tr> 
                                                  
                                            </table>

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

                                                        
                                                                    
                                                                    <span class="bold font-blue">Your total credit is {{ $totalCreditPurchased }}. <br /></span>

                                                                    <hr>

                                                                    <span class="bold font-blue">Your total number of referrals is {{ $totalNumberOfReferrals }}. <br /></span>


                                                                    <hr>


                                                                    <span class="bold font-blue">Your points on referrals credit purchased a combined total of {{ $totalNumberOfReferralsPurchasedPoints }}. <br /></span>

                                                                    
                                                                    <hr>

                                                                    <span class="bold font-blue">Your points on referrals report request a combined total of {{ $totalNumberOfReferralsReportsPoints }}. <br /></span>

                                                                    
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

                                                            <center><span class="bold uppercase font-blue">TOTAL POINTS EARNED</span>
                                                            </center>

                                                        </div>

                                                        <div class="card-body center" style="text-align: center;">

                                                            <b class="font-red-mint" style="font-size: 20px;"> {{ $totalScore }}  </b> <br/>

                                                            <br/>


                                                        </div>

                                                    </div>


                                                    @if( $nextScoreLevel >= 50 || $nextScoreLevel == 'Reached Max')
                                                        <div class="card" style="overflow: hidden;">
                                                            <div class="card-header">
                                                                <center><span class="bold uppercase font-blue">NEEDED POINTS TO NEXT LEVEL</span>
                                                                </center>
                                                            </div>

                                                            <div class="card-body center" style="text-align: center;">
                                                                <b class="font-red-mint" style="font-size: 20px;"> {{ $nextScoreLevel }}  </b> <br/>
                                                                <br/>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="card" style="overflow: hidden;">
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
                                                                <center>
                                                                <button class="btn red-mint btn-full" type="button" disabled>REDEEM USD $100 NOW</button> 
                                                                </center>
                                                                @endif 
                                                            </div>
                                                        @endif
                                                        <div class="card-body center" style="text-align: center;">
                                                           {{ $advisorTips }}
                                                        </div>

                                                    </div>



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















