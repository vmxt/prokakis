@extends('layouts.app')



@section('content')



    <style>

        #edit_icon {

            cursor: pointer;

        }



        /* Outer */

        .popup {

            width: 100%;

            height: 100%;

            display: none;

            position: fixed;

            top: 0px;

            left: 0px;

            background: rgba(0, 0, 0, 0.75);
            z-index: 10;
        }



        table {

            table-layout:fixed;

        }

        table td {

            word-wrap: break-word;

            max-width: 400px;

        }

        #system_data td {

            white-space:inherit;

        }



        /* Inner */

        .popup-inner {

            max-width: 700px;

            width: 90%;

            padding: 40px;

            position: absolute;

            top: 50%;

            left: 50%;

            -webkit-transform: translate(-50%, -50%);

            transform: translate(-50%, -50%);

            box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);

            border-radius: 3px;

            background: #fff;

      

        }



        /* Inner */

        .popup-inner2 {

            width: 700px;
            height: 90%;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
            border-radius: 3px;
            background: #fff;
            z-index: 5;
   
        }





        /* Close Button */

        .popup-close {

            width: 30px;

            height: 30px;

            padding-top: 4px;

            display: inline-block;

            position: absolute;

            top: 0px;

            right: 0px;

            transition: ease 0.25s all;

            -webkit-transform: translate(50%, -50%);

            transform: translate(50%, -50%);

            border-radius: 1000px;

            background: rgba(0, 0, 0, 0.8);

            font-family: Arial, Sans-Serif;

            font-size: 20px;

            text-align: center;

            line-height: 100%;

            color: #fff;

        }



        .popup-close:hover {

            -webkit-transform: translate(50%, -50%) rotate(180deg);

            transform: translate(50%, -50%) rotate(180deg);

            background: rgba(0, 0, 0, 1);

            text-decoration: none;

        }
        #getRequestesData{
            overflow:scroll; 
            height:100%;
            width:100%;
            padding: 5px; 
        }



    </style>



    <script src="{{ asset('public/js/app.js') }}"></script>



    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

        <li>

            <a href="{{ url('/home') }}">Prokakis</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            Rewards and Gamifications

        </li>



    </ul>



    <div class="row justify-content-center">

        <div class="portlet light">

            <div class="portlet-title">

                <div class="caption">

                    <i class="icon-settings font-blue"></i>

                    <span class="caption-subject font-blue sbold uppercase">Redemption Request for Accounts Payable</span>

                    
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

                </div>

            </div>

            <div id="container" class="table-scrollable">

                <table id="system_data" class="table table-hover table-light">

                    <thead>

                    <tr>

                        <th style="width:5%">Request Id</th>

                        <th style="width:20%">Name</th>

                        <th style="width:20%">Points / Earned Amount</th>

                        <th style="width:20%">Sales</th>

                        <th style="width:20%">Accounts Payable</th>

                        
                        <th style="width:30%">Points</th>

                        <th style="width:20%">Actions</th>
                        
                        

                    </tr>

                    </thead>

                    <tbody>

                    <?php 

                    if(isset($adReq)){

                    foreach($adReq as $data){
                       
                      $usr = App\User::find($data->user_id);  
                        
                    ?>

                    <tr>

                        <td><?php echo $data->id; ?></td>

                        <td id="tdDesc<?php echo $data->id; ?>" class="wrap"><b><?php echo $usr->firstname.', '.$usr->lastname; ?></b></td>

                        <td id="tdJson<?php echo $data->id; ?>"><b><?php echo $data->earned_points .' / USD $'.$data->earned_amount; ?></b></td>

                        <td id="tdJson<?php echo $data->id; ?>"><b><?php  if($data->approver1 == null){ echo "Pending"; } else { echo "Approved"; } ?></b></td>
                        
                        <td id="tdJson<?php echo $data->id; ?>"><b><?php  if($data->approver2 == null){ echo "Pending"; $disable=''; } else { echo "Approved"; $disable='disabled'; } ?></b></td>
                        
                        <td>

                            <a id="edit_icon"  onclick="ajxViewRedemptionDetails('<?php echo $data->id; ?>')" data-popup-open="popup-2" class="btn btn-outline btn-circle btn-sm blue">
                                <i class="fa fa-edit"></i>Preview Data
                            </a>
                            
                            
                            <a id="edit_icon" target="_blank" href="{{ url('/redeem-accpay-preview') }}/{{ $data->id }}"  class="btn btn-outline btn-circle btn-sm blue">
                                <i class="fa fa-edit"></i>Print Preview
                            </a>

                        </td>

                        <td>
                            <form id="approveForm" style="padding-top: 10px;" action="{{ route('redeemGetApprovedAP') }}" method="post">
                                {{ csrf_field() }}  
                            <input type="hidden" name="reqId" value="<?php echo $data->id; ?>">   
                            
                            <button type="button" <?php echo $disable; ?>  id="submit_button" class="btn btn-outline btn-circle btn-sm red"><i class="fa fa-edit"></i> Approve</button>
                             
                            
                          </form>
                        </td>
                        

                    </tr>

                    <?php }

                     } ?>

                    </tbody>

                 

                </table>



            </div>

        </div>

    </div>


    <div class="popup" data-popup="popup-1">
        <div class="popup-inner">
            <div class="col-lg-8">
                <input type="hidden" id="companyTransferId" name="companyTransferId">
           
                <div class="portlet light portlet-fit ">
                      <div id="viewCompanies"></div>

                </div>
            </div>
            <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
        </div>
    </div>

    <div class="popup" data-popup="popup-2">
        <div class="popup-inner2" style="width:60%">
                    <div id="getRequestesData"></div>
            <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
        </div>
    </div>

    <div class="popup" data-popup="popup-3">

        <div class="popup-inner" style="width:80%">
            <div class="col-lg-12">
                <div class="portlet light portlet-fit ">
                            <div id="addCompanies"></div>

                </div>

            <button type="button" id="processSelectedCompanies" class="btn red mt-ladda-btn ladda-button btn-circle btn-outline" data-style="slide-right" data-spinner-color="#333">
                <span class="ladda-label">
                    <i class="icon-login"></i> Save Added Token </span>
                <span class="ladda-spinner"></span>
            </button>

            </div>

           <a class="popup-close" data-popup-close="popup-3" href="#">x</a>
        </div>
    </div>


<link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">

<script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>



<script>

$(document).ready( function () {

    $('#system_data').DataTable();
    $('#sample_1').DataTable();
    $(".popup").hide();
} );

$("#submit_button").click(function(){
    swal({

        title: "This will approve the redemption request",
        text: "Are you sure you want to proceed?",
        icon: "warning",

        buttons: [
          'No, cancel it!',
          'Yes, I am sure!'
        ],
        dangerMode: true,

      }).then(function(isConfirm) {

        if (isConfirm) {
            $("#approveForm").submit();  
        } else {

          swal("Cancelled", "Approving process was cancelled :)", "error");
           return false; 

        }

      })

  });   


function ajxProcessView(cId, codeName)
{

    formData = new FormData();

    formData.append("userId", cId);



    $.ajax({

        url: "{{ route('ViewAjxCompany') }}",

        type: "POST",

        data: formData,

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

        processData: false,

        contentType: false,



        success: function (data) {

            $("#viewCompanies").html(data);

         

        }

    });



}


function  ajxApproved(rId){

    formData = new FormData();

    formData.append("reqId", rId);

    $.ajax({

        url: "{{ route('redeemGetApproved') }}",

        type: "POST",

        data: formData,

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

        processData: false,

        contentType: false,

        success: function (data) {

        }
    });

}

function ajxViewRedemptionDetails(rId)
{

    formData = new FormData();

    formData.append("reqId", rId);

    $.ajax({

        url: "{{ route('redeemDetails') }}",

        type: "POST",

        data: formData,

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

        processData: false,

        contentType: false,

        success: function (data) {

            $("#getRequestesData").html(data);
        }
    });

}


        $("#ajxUpdate").click(function () {

            var idc = $("#configID").val();

            var desc = $("#config_desc").val();

            var jsonV = $("#config_json").val();



            formData = new FormData();

            formData.append("config_id", idc);

            formData.append("config_desc", desc);

            formData.append("config_json", jsonV);



            $.ajax({

                url: "{{ route('sysUpdate') }}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,



                success: function (data) {

                    $("#tdDesc" + idc).text(desc);

                    $("#tdJson" + idc).text(jsonV);

                    $(".popup").hide(250);

                    document.location = "{{ route('sysIndex') }}"

                }

            });



        });



        //----- OPEN

        $('[data-popup-open]').on('click', function (e) {

            var targeted_popup_class = jQuery(this).attr('data-popup-open');

            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);



            e.preventDefault();

        });



        //----- CLOSE

        $('[data-popup-close]').on('click', function (e) {

            var targeted_popup_class = jQuery(this).attr('data-popup-close');

            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);



            e.preventDefault();

        });



    </script>



@endsection