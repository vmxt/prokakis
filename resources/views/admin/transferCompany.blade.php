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
            max-width: 900px;
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

    </style>

    <script src="{{ asset('public/js/app.js') }}"></script>

    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Prokakis</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Settings
        </li>

    </ul>

    <div class="row justify-content-center">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-blue"></i>
                    <span class="caption-subject font-blue sbold uppercase">Company Transfer</span>
                </div>
            </div>
            <div id="container" class="table-scrollable">
                <table id="system_data" class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th style="width:5%">Id</th>
                        <th style="width:20%">Name</th>
                        <th style="width:20%">Email</th>
                        <th style="width:55%">Companies</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if(isset($usr)){
                    foreach($usr as $data){
                    ?>
                    <tr>
                        <td><?php echo $data->id; ?></td>
                        <td id="tdDesc<?php echo $data->id; ?>" class="wrap"><?php echo $data->firstname.', '.$data->lastname; ?></td>
                        <td id="tdJson<?php echo $data->id; ?>"><?php echo $data->email; ?> </td>
                        <td>

                            <a id="edit_icon"  onclick="ajxProcessView('<?php echo $data->id; ?>','<?php echo $data->firstname.' '.$data->lastname; ?>')"
                                data-popup-open="popup-1" class="btn btn-outline btn-circle btn-sm blue">
                                <i class="fa fa-edit"></i> View 
                             </a>

                               
                                <a id="edit_icon"  onclick="ajxProcessTransfer('<?php echo $data->id; ?>','<?php echo $data->firstname.' '.$data->lastname; ?>')"
                                   data-popup-open="popup-2" class="btn btn-outline btn-circle btn-sm blue">
                                   <i class="fa fa-edit"></i> Transfer 
                                </a>

                                <a id="edit_icon"  onclick="ajxProcessAdd('<?php echo $data->id; ?>','<?php echo $data->firstname.' '.$data->lastname; ?>')"
                                    data-popup-open="popup-3" class="btn btn-outline btn-circle btn-sm blue">
                                    <i class="fa fa-edit"></i> Add Token 
                                 </a>

                              
                                
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
                <div class="portlet light portlet-fit ">
                            <div id="viewCompanies"></div>
            </div>
            </div>

            <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->
            <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
        </div>
    </div>

    <div class="popup" data-popup="popup-2">
        <div class="popup-inner2" style="width:80%">
            <input type="hidden" id="companyTransferId" name="companyTransferId">
            <div class="col-lg-8">
                <div class="portlet light portlet-fit ">

                            <div id="editCompanies"></div>
            </div>

            <button type="button" id="processSelectedItems" class="btn red mt-ladda-btn ladda-button btn-circle btn-outline" data-style="slide-right" data-spinner-color="#333">
                <span class="ladda-label">
                    <i class="icon-login"></i> Save Transfer </span>
                <span class="ladda-spinner"></span>
            </button>

            </div>
          
            <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->
            <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
        </div>
    </div>


    <div class="popup" data-popup="popup-3">
        <div class="popup-inner">
            <div class="col-lg-8">
                <div class="portlet light portlet-fit ">
                            <div id="addCompanies"></div>
            </div>

            <button type="button" id="processSelectedCompanies" class="btn red mt-ladda-btn ladda-button btn-circle btn-outline" data-style="slide-right" data-spinner-color="#333">
                <span class="ladda-label">
                    <i class="icon-login"></i> Save Added Token </span>
                <span class="ladda-spinner"></span>
            </button>

            </div>
         
            <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->
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

$("#processSelectedItems").on('click', function(e){
    
    swal({
        title: "Are you sure?",
        text: "You are about to tranfer the selected companies to another user account",
        icon: "warning",
        buttons: [
          'No, cancel it!',
          'Yes, I am sure!'
        ],

        dangerMode: true,
      }).then(function(isConfirm) {

        if (isConfirm) {
        swal({
            title: 'Company Transfer',
            text:  'Done on transferring to another user account',
            icon:  'success'
        }).then(function() 
        {    

                    var favorite = [];
                    $.each($("input[name='checkboxes1[]']:checked"), function(){            
                        favorite.push($(this).val());
                    });
                    //alert("My favourite sports are: " + favorite.join(","));
                    var result = favorite.join(",");
                    var userId = $("#companyTransferId").val();
                    //alert(result+ '  '+ companyId);
                // $("#selectedItems").val(result);

                formData = new FormData();
                formData.append("userId", userId);
                formData.append("companies", result);
                
                $.ajax({
                    url: "{{ route('TransferSelectedCompany') }}",
                    type: "POST",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    processData: false,
                    contentType: false,

                    success: function (data) {
                        //$("#usrCompanyList").html(data);
                        document.location = "{{ route('GetTransferCompany') }}"
                    }
                });

            });

        } 
        
    });

});

$("#processSelectedCompanies").on('click', function(e){
    
    swal({
        title: "Are you sure?",
        text: "You are about to add token to the selected companies",
        icon: "warning",
        buttons: [
          'No, cancel it!',
          'Yes, I am sure!'
        ],

        dangerMode: true,
      }).then(function(isConfirm) {

        if (isConfirm) {
        swal({
            title: 'Company Adding Token',
            text:  'Done on adding token',
            icon:  'success'
        }).then(function() 
        {   

                    var favorite = [];
                    $.each($("input[name='checkboxes1[]']:checked"), function(){            
                        favorite.push($(this).val());
                    });

                    //alert("My favourite sports are: " + favorite.join(","));
                    var result = favorite.join(",");
                    var tokenAmount = $("#companyAmount").val();
                    //alert(tokenAmount);
                    
                     formData = new FormData();
                     formData.append("amountToken", tokenAmount);
                     formData.append("companiesList", result);
                     
                     $.ajax({
                        url: "{{ route('AddTokenSelectedCompany') }}",
                        type: "POST",
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        processData: false,
                        contentType: false,
    
                        success: function (data) {
                            //$("#addCompanies").html(data);
                            //$("#usrCompanyList").html(data);
                            document.location = "{{ route('GetTransferCompany') }}"
                        }
                    });

           });

        } 
        
    }); 

});


function usrCompany(tor)
{
   var usrId = tor.value;
   formData = new FormData();
   formData.append("userId", usrId);
   
   $.ajax({
       url: "{{ route('SelectedUserCompany') }}",
       type: "POST",
       data: formData,
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       processData: false,
       contentType: false,

       success: function (data) {
           $("#usrCompanyList").html(data);
           //document.getElementById("usr"+usrId).value = data;
        
       }
   });


}

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

function ajxProcessTransfer(cId, codeName)
{

    formData = new FormData();
    formData.append("userId", cId);
    $("#companyTransferId").val(cId);
    
    $.ajax({
        url: "{{ route('TransferAjxCompany') }}",
        type: "POST",
        data: formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        processData: false,
        contentType: false,

        success: function (data) {
            $("#editCompanies").html(data);
         
        }
    });
   

}

function ajxProcessAdd(cId, codeName)
{
    formData = new FormData();
    formData.append("userId", cId);
    
    $.ajax({
        url: "{{ route('AddAjxCompany') }}",
        type: "POST",
        data: formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        processData: false,
        contentType: false,

        success: function (data) {
            $("#addCompanies").html(data);
         
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