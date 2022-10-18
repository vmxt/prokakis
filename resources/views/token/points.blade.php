

@extends('layouts.app')



@section('content')

<link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">


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

                                

                                @if (session('message'))

                                    <div class="alert alert-success">

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
                                                            <li>Get 0.02 points for every dollar spent.</li>
                                                            <li>Introduce and share to a friend or business associate and get 1 points. (one-time only) </li>
                                                            <li>Earn 0.01 points passively every time your. referrals spent every 1 dollar for Intellinz services</li>
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
                                                                    
                                                                    <span class="bold " style="color:black">Total Amount of dollars spent so far: {{ $totalCreditPurchased }} <br /></span>

                                                                    <hr>

                                                                    <span class="bold " style="color:black">Total number of referrals: {{ $totalNumberOfReferrals }}. <br /></span>

                                                                    <hr>

                                                                    <span class="bold " style="color:black">Total Number of points already redeemed: {{ $setTotalPoints }}. <br /></span>

                                                                    <hr>

                                                                    <span class="bold " style="color:black">Your points earned from referrals purchases equals a combined total of {{ $totalNumberOfReferralsPurchasedPoints }}. <br /></span>

                                                                    
                                                                    <hr>

                                                                   <!--  <span class="bold " style="color:black">Your points on referrals report request equals a combined total of {{ $totalNumberOfReferralsReportsPoints }}. <br /></span> -->

                                                                    
                                                                    <br /><br />

                                                                    <?php 
                                                                    $ed = App\SpentTokens::getPremiumExpiryDate(129);
                                                                    ?>
                                                                    @if($ed != false)
                                                                        <h4> Premium account expires on {{$ed}} </h4>
                                                                    @endif
                                                             

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
                        <div class="modal-body col-sm-12" style="padding-left: 10%;padding-top: 25px;padding-right: 10%;margin-bottom: -30px;" >
                            <div class="form-group form-check">
                               
                                <label class="form-check-label alert alert-info" for="validationCheck">  <input type="checkbox" class="form-check-input" id="validationCheck"> <span style="padding: 5px"> I hereby authorize intellinz to process my reward and redeem my points.</span></label>
                            </div>
                        </div>
                        <div class="modal-body col-sm-12" >
                            <div class="col-sm-4">
                                <div class="card" >
                                  <div class="card-body">
                                    <h5 class="text-company card-title "><b>Advisor Level</b></h5>
                                    @if($advisor_lvl_approved == 1)
                                        <p> You're request still in review</p>
                                        <button class="btn btn-primary"   style="font-size: 12px;" type="button" disabled>PENDING</button> 
                                    @elseif($advisor_lvl_approved == 2)
                                        <p>You already redeem this level</p>
                                    @elseif($totalScore >= 50)
                                    <form id="redeemForm" class="redeem-form" action="{{ route('redeemRewards') }}" method="post">
                                        <p class="card-text">You reached Advisor Level. You can able to redeem USD $50</p>
                                        {{ csrf_field() }}  
                                        <input type="hidden" name="amount_to_redeem" value="50">
                                        <input type="hidden" name="earned_points" value="50">
                                        <input type="hidden" name="advisor_level" value="1">
                                        <input type="submit" id="submit_button"  style="font-size: 12px;" name="submit_button" class="btn red-mint btn-full redeemBtn" value="REDEEM USD $50 NOW">
                                    </form>
                                    @else
                                        @if($totalScore < 50)
                                           <p> You need to have {{$nextScoreLevel}} more points to get to the first level Advisor and be able to redeem USD $50</p>
                                        @endif
                                        <button class="btn btn-primary"   style="font-size: 12px;" type="button" disabled>REDEEM USD $50 NOW</button> 
                                    @endif
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                  <div class="card-body">
                                    <h5 class="text-company card-title"><b>Gold Advisor</b></h5>
                                    @if($gold_advisor_lvl_approved == 1)
                                        <p> You're request still in review</p>
                                        <button class="btn btn-primary"   style="font-size: 12px;" type="button" disabled>PENDING</button> 
                                    @elseif($gold_advisor_lvl_approved == 2)
                                        <p>You already redeem this level</p>
                                    @elseif($totalScore >= 200 )
                                    <p class="card-text">You reached Gold Advisor Level. You can able to redeem USD $300</p>
                                        @if($advisor_lvl_approved != 2)
                                            <button class="btn btn-primary"   style="font-size: 12px;" type="button" disabled>REDEEM USD $300 NOW</button>
                                        @else
                                            <form id="redeemForm" class="redeem-form" action="{{ route('redeemRewards') }}" method="post">
                                                {{ csrf_field() }}  
                                                <input type="hidden" name="amount_to_redeem" value="300">
                                                <input type="hidden" name="earned_points" value="200">
                                                <input type="hidden" name="advisor_level" value="2">
                                                <input type="submit" <?=$advisor_lvl_approved!=2?'disabled':''?> style="font-size: 12px;" id="submit_button" name="submit_button" class="btn red-mint btn-full redeemBtn" value="REDEEM USD $300 NOW">
                                            </form>
                                        @endif
                                    @else
                                        <p class="card-text">
                                        @if($advisor_lvl_approved == 1)
                                            You need to redeem Advisor Level first before you can claim Gold Advisor. <br>
                                        @endif
                                        @if($totalScore < 200)
                                            You need to have @if($totalScore >= 50){{$nextScoreLevel}}@else{{$nextScoreLevel+150}}@endif more points to get to the second level Gold Advisor and be able to redeem USD $300</p>
                                        @endif
                                        <button class="btn btn-primary"   style="font-size: 12px;" type="button" disabled>REDEEM USD $300 NOW</button> 
                                    @endif
                                    <!-- <a href="#" class="btn btn-primary" style="font-size: 12px;">REDEEM USD $300 NOW</a> -->
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                  <div class="card-body">
                                    <h5 class="text-company card-title"><b>Platinum Advisor</b></h5>
                                    @if($platinum_advisor_lvl_approved == 1)
                                        <p> You're request still in review</p>
                                        <button class="btn btn-primary"   style="font-size: 12px;" type="button" disabled>PENDING</button> 
                                    @elseif($platinum_advisor_lvl_approved == 2)
                                        <p>You already redeem this level</p>
                                    @elseif($totalScore >= 500)
                                    <p class="card-text">You reached Platinum Advisor Level. You can able to redeem USD $500</p>
                                        @if($gold_advisor_lvl_approved != 2)
                                            <button class="btn btn-primary"   style="font-size: 12px;" type="button" disabled>REDEEM USD $500 NOW</button> 
                                        @else
                                            <form id="redeemForm" class="redeem-form" action="{{ route('redeemRewards') }}" method="post">
                                                {{ csrf_field() }}  
                                                <input type="hidden" name="amount_to_redeem" value="1500">
                                                <input type="hidden" name="earned_points" value="500">
                                                <input type="hidden" name="advisor_level" value="3">
                                                <input type="submit"  style="font-size: 12px;" id="submit_button" name="submit_button" class="btn red-mint btn-full redeemBtn" value="REDEEM USD $1500 NOW">
                                            </form>
                                        @endif
                                    @else
                                        <p class="card-text">
                                        @if($gold_advisor_lvl_approved == 1)
                                            You need to redeem Gold Advisor Level first before you can claim Platinum Advisor. <br>
                                        @endif
                                        @if($totalScore < 500)
                                            You need to have @if($totalScore >= 200){{$nextScoreLevel}}@else{{$nextScoreLevel+300}}@endif more points to get to the third level Platinum Advisor and be able to redeem USD $500</p>
                                        @endif
                                        <button class="btn btn-primary"   style="font-size: 12px;" type="button" disabled>REDEEM USD $500 NOW</button> 
                                    @endif
                                    <!-- <a href="#" class="btn btn-primary" style="font-size: 12px;">REDEEM USD $1500 NOW</a> -->
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
               <div class="container" style="margin-bottom: 10%;">
                    <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Earned Amount</th>
                                <th>Earned Point</th>
                                <th>Last Update</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                        <?php
                        $counter = 1;
                        if(count((array)$advisorDetails) > 0){
                            foreach($advisorDetails as $b){  ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><p> <?php echo $b->earned_amount; ?></p></td>
                            <td><p> <?php echo $b->earned_points; ?></p></td>
                            <td><p> <?php echo $b->updated_at; ?></p></td>
                            <td><p>
                                @if($b->status == 0)
                                    Pending
                                @elseif($b->status == 1)
                                    Approved
                                @else
                                    Rejected
                                @endif

                        </tr>

                        <?php
                        $counter++;
                            }

                        } ?>

                        </tbody>
                 
                    </table>
                </div>


<script src="{{ asset('public/jq1111/jquery.min.js') }}"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="{{ asset('public/img-cropper/js/cropbox.js') }}"></script>

<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>



<script type="text/javascript">

$( document ).ready(function() {
                  $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                { targets:"_all", orderable: false },
                { targets:[0,1,2,3,4], className: "desktop" },
                { targets:[0,1], className: "tablet, mobile" }
            ]
            });

     $(".redeemBtn").prop("disabled",true);

});

    $("#validationCheck").click(function(){
        if($('#validationCheck').is(':checked') ){
            $(".redeemBtn").prop("disabled",false);
         }else{
            $(".redeemBtn").prop("disabled",true);
         }

    });   

    $("#submit_button").click(function(){
        // swal({

        //     title: "Redeeming your points now will reset them to zero",
        //     text: "Are you sure you want to proceed?",
        //     icon: "warning",

        //     buttons: [
        //       'No, cancel it!',
        //       'Yes, I am sure!'
        //     ],
        //     dangerMode: true,

        //   }).then(function(isConfirm) {

        //     if (isConfirm) {
        //         $("#redeemForm").submit();  
        //         $("#redeemBtn").text('Pending');  

        //     } else {

        //       swal("Cancelled", "Redeeming pprocess was cancelled :)", "error");
        //        return false; 

        //     }

        //   })

      });    


  

</script>



@endsection















