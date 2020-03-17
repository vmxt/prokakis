@extends('layouts.app')



@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">

<style>

.niceDisplay{

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

    margin-right:20px;

    position: absolute;

    top: 0;

    right: 0;

}







* {

    margin:0;

    padding:0;

}



.pie {

    background-color:#ecc0b7;

    width:200px;

    height:200px;

    -moz-border-radius:100px;

    -webkit-border-radius:100px;

    border-radius:100px;

    position:relative;

}

.clip1 {

    position:absolute;

    top:0;

    left:0;

    width:200px;

    height:200px;

    clip:rect(0px, 200px, 200px, 100px);

}

.slice1 {

    position:absolute;

    width:200px;

    height:200px;

    clip:rect(0px, 100px, 200px, 0px);

    -moz-border-radius:100px;

    -webkit-border-radius:100px;

    border-radius:100px;

    background-color:#f7e5e1;

    border-color:#f7e5e1;

    -moz-transform:rotate(0);

    -webkit-transform:rotate(0);

    -o-transform:rotate(0);

    transform:rotate(0);

}

.clip2 {

    position:absolute;

    top:0;

    left:0;

    width:100px;

    height:100px;

    clip:rect(0, 100px, 200px, 0px);

}

.slice2 {

    position:absolute;

    width:200px;

    height:200px;

    clip:rect(0px, 200px, 200px, 100px);

    -moz-border-radius:100px;

    -webkit-border-radius:100px;

    border-radius:100px;

    background-color:#f7e5e1;

    border-color:#f7e5e1;

    -moz-transform:rotate(0);

    -webkit-transform:rotate(0);

    -o-transform:rotate(0);

    transform:rotate(0);

}

.status {

    position:absolute;

    height:30px;

    width:200px;

    line-height:60px;

    text-align:center;

    top:50%;

    margin-top:-35px;

    font-size:50px;

}

</style>



<div class="container">



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

    

    <div class="row justify-content-center">

     

                

       

        <div class="col-md-8">

               

            <div class="card">

                  

                   <div class="card-body center">

         

                        <div class="container">



                            <form id="company_social_form" method="POST" action="{{ route('storeBuyReport') }}">

                            {{ csrf_field() }}    

                            

                            <input type="hidden" name="company_id" id="company_id" value="<?php if(isset($companyId)){ echo $companyId; } ?>"> 

                            <input type="hidden" name="request_id" id="request_id" value="<?php if(isset($companyId)){ echo $requestId; } ?>"> 



                            <center>



                                <img src="{{ asset('public/img-resources/report.png')  }}">

                                <br />



<h2>Request for Company Profile and generate your Business Intelligence Risk Report.</h2> <br />

Fight identity theft by monitoring and reviewing your vendors credit report. It's a quick easy and secure. 




                                <br />

                                

                        <select class="btn btn-primary btn-x3" name="request_frequency_id" id="request_frequency_id">

                                <option value="1">One-Time</option>

                                <option value="2">Quarterly</option>

                                <option value="3">Bi-Annually</option>

                                <option value="4">Annually</option>

                        </select>  



                        <input type="submit" name="generateReport" class="btn btn-primary btn-x3"  value="Generate Report"> 

                            </center>



                            </form>



                        </div>

                             

                             

                   </div>    

            </div>





      

        </div>



               

        

        <div class="col-md-4" style="min-height:800px">

            

      

            

            <div class="card">

                  <div class="card-header"><b>Token Credit</b> </div>

                    <div class="card-body center" style="text-align: center;">

                         <b> <?php 

                             

                            $user_id = Auth::id();

                            $company_id_result = App\CompanyProfile::getCompanyId($user_id);



                            if( App\SpentTokens::validateLeftBehindToken($company_id_result) == false ){

                              echo "0"; 

                             } else { 

                             $consumedTokens = App\SpentTokens::validateLeftBehindToken($company_id_result);

                             echo $consumedTokens;  

                           }

                        ?></b> <br />

                         Token Left <br />

                         <a href="{{ route('reportsBuyTokens') }}" class="btn btn-primary btn-x3">Top Up</a>  

                    </div>    

            </div>





         

             

        </div>

                



        </div>



</div>



<script src="{{ asset('public/jq1110/jquery.min.js') }}"></script>



@endsection















