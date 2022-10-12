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

            overflow:scroll;

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

  .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}
.center {
  height: 150px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #000;
}
.wave {
  width: 5px;
  height: 100px;
  background: linear-gradient(45deg, #7cda24, #fff);
  margin: 10px;
  animation: wave 1s linear infinite;
  border-radius: 20px;
}
.wave:nth-child(2) {
  animation-delay: 0.1s;
}
.wave:nth-child(3) {
  animation-delay: 0.2s;
}
.wave:nth-child(4) {
  animation-delay: 0.3s;
}
.wave:nth-child(5) {
  animation-delay: 0.4s;
}
.wave:nth-child(6) {
  animation-delay: 0.5s;
}
.wave:nth-child(7) {
  animation-delay: 0.6s;
}
.wave:nth-child(8) {
  animation-delay: 0.7s;
}
.wave:nth-child(9) {
  animation-delay: 0.8s;
}
.wave:nth-child(10) {
  animation-delay: 0.9s;
}

@keyframes wave {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}

.addCompanies table{
    width:100% !important;
}

#usersList option{
    margin:1px !important;
    padding:3px !important;
}
    </style>

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

    <script src="{{ asset('public/js/app.js') }}"></script>



    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

        <li>

            <a href="{{ url('/home') }}">Intellinz</a>

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

                    <i class="icon-settings "></i>

                    <span class="caption-subject  sbold uppercase">Company Transfer and Add Credits</span>

                </div>

            </div>

            <div id="container" class="table-scrollable" style="border:none !important">
                <div class="table_loader center">
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                        </div>
                <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped" style="display:none">

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

                                data-toggle="modal" data-target="#exampleModal" class="btn btn-outline  btn-sm blue">

                                <i class="fa fa-edit"></i> View 

                             </a>



                               

                                <a id="edit_icon"  onclick="ajxProcessTransfer('<?php echo $data->id; ?>','<?php echo $data->firstname.' '.$data->lastname; ?>')"

                                    data-toggle="modal" data-target="#exampleModal2" class="btn btn-outline  btn-sm blue">

                                   <i class="fa fa-edit"></i> Transfer 

                                </a>



                                <a id="edit_icon"  onclick="ajxProcessAdd('<?php echo $data->id; ?>','<?php echo $data->firstname.' '.$data->lastname; ?>')"

                                    data-popup-open="popup-3" class="btn btn-outline  btn-sm blue">

                                    <i class="fa fa-edit"></i> Add Credit 

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









    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width:80%">
    <div class="modal-content">
 <div class="modal-body">
     <div class="row">
            <div class="col-lg-12">

                <div class="portlet light portlet-fit ">

                            <div id="viewCompanies"></div>

            </div>

            </div>


</div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
  </div>
    </div>
      </div>



    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width:80%">
    <div class="modal-content">
 <div class="modal-body">
     <div class="row">

            <input type="hidden" id="companyTransferId" name="companyTransferId">

            <div class="col-lg-12">

                <div class="portlet light portlet-fit ">



                            <div id="editCompanies"></div>

            </div>



            <button type="button" id="processSelectedItems" class="btn btn-primary  mt-ladda-btn ladda-button btn-outline" data-style="slide-right" data-spinner-color="#333">

                <span class="ladda-label">

                    <i class="fa fa-save "></i> Save Transfer </span>

                <span class="ladda-spinner"></span>

            </button>



            </div>
</div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
  </div>
    </div>
      </div>
 </div>




    <div class="popup" data-popup="popup-3">

        <div class="popup-inner">

            <div class="col-lg-12">

                <div class="portlet light portlet-fit ">

                            <div id="addCompanies"></div>

            </div>



            <button type="button" id="processSelectedCompanies" class="btn btn-primary mt-ladda-btn ladda-button  btn-outline" data-style="slide-right" data-spinner-color="#333">

                <span class="ladda-label">

                    <i class="fa fa-save"></i> Save Added Credit </span>

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

    $('#system_data').DataTable({
        "drawCallback": function( settings ) {
                        $(".table_loader").fadeOut();
                        $(".table_loader").remove();
                        $('#system_data').show();
                        
                }
    });

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

        text: "You are about to add credit to the selected companies",

        icon: "warning",

        buttons: [

          'No, cancel it!',

          'Yes, I am sure!'

        ],



        dangerMode: true,

      }).then(function(isConfirm) {



        if (isConfirm) {

        swal({

            title: 'Company Adding Credit',

            text:  'Done on adding credits',

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