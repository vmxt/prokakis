

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

                           



                                <form id="company_contact_form" method="POST" action="{{ route('createContacts') }}">



                                    {{ csrf_field() }}

                                    <div class="card">



                                        <div class="card-header"><b>COMPANY ACCOUNT ACTIVATION</b></div>

                                        <br>

                                        <div class="alert bg-dark text-company" style="width: 100%; overflow: hidden; margin-left: 0px !important;">

                                            <p>

                                               In order to avail the premium features, <strong>Intellinz members</strong> should activate thier account to premium.

                                               Please click the button below "Upgrade to Premium Account"

                                           </p>

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

                                          

                                        <?php 

                                        $user_id = Auth::id();

                                        $company_id_result = App\CompanyProfile::getCompanyId($user_id);

                                        ?>

                                      



                                        <table class="table table-hover table-light">

                                        

                                            <tr>

                                                <td style="width:70%">



                                                    <?php if( App\SpentTokens::validateAccountActivation($company_id_result) == false ){ ?>

                                                   <!-- <a onclick="PromoOne()" class="btn yellow"

                                                        style="margin-top: 15px; width: 50%;"> <i class="fa" style="color: white;"></i> Upgrade To Premium Account

                                                    </a> -->

                                                    <?php } else { ?>





                                                        <div class="card" style="overflow: hidden;">

                                                            <div class="card-header">

                                                                <center><span class="bold uppercase ">You are already a premium account <br /></span>

                                                                    <hr>

                                                                    Premium account expires on <?php 

                                                                    $ed = App\SpentTokens::getPremiumExpiryDate($company_id_result);

                                                                    if($ed != false){

                                                                    echo $ed;

                                                                    }

 

                                                                    ?>

                                                                </center>

                                                            </div>

            

                                                        </div>





                                                    <?php } ?>


                                                       <center> 
                                                    <a href="{{ route('reportsBuyCredits') }}" class="bg-intellinz-light-green btn yellow btn-full"

                                                        style="margin-top: 55px; width: 50%;"> <i class="fa" style="color: white;"></i> Change Plan

                                                    </a> </center>

                                                </td>



                                                <td style="width:30%">



                                                    <div class="card" style="overflow: hidden;">

                                                        <div class="card-header">

                                                            <center><span class="bold uppercase ">Credit</span>

                                                                <hr>

                                                             

                                                            </center>

                                                        </div>

        

                                                        <div class="card-body center" style="text-align: center;">

                                                            <b class="font-red-mint" style="font-size: 20px;"> <?php

                                                                     

                                                                if (App\SpentTokens::validateTokenStocks($company_id_result) == false) {

                                                                    echo "0";

                                                                } else {

                                                                    $consumedTokens = App\SpentTokens::validateTokenStocks($company_id_result);

                                                                    echo $consumedTokens;

                                                                }

                                                                ?>  </b> <br/>

                                                            Credit Left 

                                                            <br/>

                                                            <div class="cont-col2">

                                                               

                                                               

                                                            </div>

                                                     

                                                        </div>

                                                    </div>



                                                </td>

                                            </tr>

                                        </table>



                                    </div>



                                </form>



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



    function PromoOne(){

        swal({



            title: "Are you sure to upgrade your account?",



            text: "You are about to upgrade to premium account.",



            icon: "warning",



            buttons: [



              'No, cancel it!',



              'Yes, I am sure!'



            ],



            dangerMode: true,



          }).then(function(isConfirm) {



            if (isConfirm) {



              swal({



                title: 'Upgrading to premium account',



                text: 'Done on setting to premium',



                icon: 'success'



              }).then(function() {

                document.location = "{{ route('promoOneToken') }}"

              });



            } else {



              swal("Cancelled", "Upgrading to premium was cancelled :)", "error");



            }



          })





    }





  

   function processUpdate(){

      swal({

      title: "Are you sure you want to update company contact information? ",

      text: "Updating Company Contact Information",

      icon: "warning",

      buttons: [

        'No, cancel it!',

        'Yes, I am sure!'

      ],

      dangerMode: true,

    }).then(function(isConfirm) {

      if (isConfirm) {

        swal({

          title: 'Success',

          text: 'Request change for contact information has been submitted.',

          icon: 'success'

        }).then(function() {

      

            $("#company_contact_form").submit();

              

        });

      } else {

        swal("Cancelled", "", "error");

        return false;  

      }

    }); 

      

  };

  

</script>



@endsection















