@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

   <style>

         /* Outer */
    .popup {
        width:100%;
        height:100%;
        display:none;
        position:fixed;
        top:0px;
        left:0px;
        background:rgba(0,0,0,0.75);
    }

            /* Inner */
    .popup-inner {
        max-width:700px;
        width:90%;
        padding:40px;
        position:absolute;
        top:50%;
        left:50%;
        -webkit-transform:translate(-50%, -50%);
        transform:translate(-50%, -50%);
        box-shadow:0px 2px 6px rgba(0,0,0,1);
        border-radius:3px;
        background:#fff;
    }

    /* Close Button */
    .popup-close {
        width:30px;
        height:30px;
        padding-top:4px;
        display:inline-block;
        position:absolute;
        top:25px;
        left:0px;
        transition:ease 0.25s all;
        -webkit-transform:translate(50%, -50%);
        transform:translate(50%, -50%);
        border-radius:1000px;
        background:rgba(0,0,0,0.8);
        font-family:Arial, Sans-Serif;
        font-size:20px;
        text-align:center;
        line-height:100%;
        color:#fff;
    }

    .popup-close:hover {
        -webkit-transform:translate(50%, -50%) rotate(180deg);
        transform:translate(50%, -50%) rotate(180deg);
        background:rgba(0,0,0,1);
        text-decoration:none;
    }
    
        .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}
    </style>
<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">
    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/homeSubConsul') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ url('/consultants/pending-projects') }}">Commission History</a>
            </li>
        </ul>
        <div class="row justify-content-center">

            <div class="col-md-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb "></i>
                                <span class="caption-subject  sbold uppercase">Commission History</span>

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

                            </div>

                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable" style="border:none !important">
                                <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped"  >
                                    <thead>
                                    <tr>
                                        <th width="10%"># Project Id</th>
                                        <th width="20%"> Project Name</th>
                                        <th width="10%">Due Date</th>
                                        <th width="20%">Rate</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(count((array)$rs) - 1 > 0){

                                    foreach($rs as $d){
                                     ?>
                                    <tr>

                                           <input type="hidden" name="project_id" value="<?php echo $d->id; ?>">

                                            <td align="center"><?php echo $d->id; ?></td>
                                            <td align="center">
                                                <?php
                                                echo App\RequestReport::getProjectName($d->request_id);
                                                ?>
                                            </td>
                                            <td align="center"><?php echo $d->due_date; ?></td>




                                            <td align="center">

                                             <?php echo $con_com['Commission'].' '.$con_com['Currency']; ?>

                                            </td>


                                    </tr>
                                    <?php

                                        }
                                    }
                                    ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                </div>
                </div>

        </div>



        <div class="popup" data-popup="popup-1">
                <div class="popup-inner" style="overflow: scroll; height:850px; width:900px;">
                    <div id="requester_result"></div>
                    <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                </div>
     </div>



     <div class="popup" data-popup="popup-2">
            <div class="popup-inner" style="overflow: scroll; height:850px; width:900px;">
                <div id="provider_result"></div>
                <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
            </div>
 </div>



    <script src="{{ asset('public/js/app.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#system_data').DataTable();

              //----- OPEN
              $('[data-popup-open]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-open');
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                e.preventDefault();
            });

            //----- CLOSE
            $('[data-popup-close]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-close');
                $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                e.preventDefault();
            });

        });


        function openTR_requester(tor, vic){

            formData= new FormData();
            formData.append("requester_id", tor);
            formData.append("request_id", vic);

             $.ajax({
              url: "{{ route('getRequesterInformation') }}",
              type: "POST",
              data: formData,
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              processData: false,
              contentType: false,

              success: function(data){
                $("#requester_result").html(data);
              }
            });
        }


        function openTR_provider(tor){

            alert('You are about to open the company profile in another tab page.');

           // $('#provider_result').load('http://localhost/prokakis/profile/viewer/'+tor);
            window.open('http://localhost/prokakis/profile/viewer/'+tor, '_blank');
        }


    </script>

@endsection
