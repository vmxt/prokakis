@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>


        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 30px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .btn-x3 {
            font-size: 15px;
            border-radius: 5px;
            width: 25%;
            background-color: orangered;
        }
@media (max-width: 425px){
    .col-md-12{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
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
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Opportunities</span>
            </li>
        </ul>
        <div class="row justify-content-center">
            <div class="col-md-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb "></i>
                                <span class="caption-subject  sbold uppercase">User History</span>
                            </div>

                        </div>
                        <div class="portlet-body">
                            <div id="container" class="table-scrollable" style="border:none !important">

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
                                <style>
                                    .mb-2{
                                        margin-bottom:15px;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-md-10 mb-2">
                                        <select class="form-control" id="type_cb">
                                            
                                            <option <?php if($type == "All"){ echo "selected"; } ?> value="All">All</option>
                                            <option <?php if($type == "Registered"){ echo "selected"; } ?> value="Registered">Registered</option>
                                            
                                            <option <?php if($type == "Logged In"){ echo "selected"; } ?> value="Logged In">Logged In</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <button id="load_btn" class="btn btn-success"><i class="fa fa-spinner"></i> LOAD</button>
                                    </div>
                                </div>
                                
                                <script>
                                    $("#load_btn").click(function(){
                                        window.location.href = "<?php echo env('APP_URL'); ?>userAccountsHistory/" + $("#type_cb option:selected").val();
                                    });
                                </script>
                                <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Event</th>
                                        <th>IP Address</th>
                                        <th>Agent</th>
                                        <th>Date</th>

                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $counter = 1;
                                    if(count((array)$result) > 0){
                                        foreach($result as $b){  ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><p> <?php echo $b->user_email ?></p></td>
                                        <td><p> <?php echo $b->event ?></p></td>
                                        <td><p> <?php echo $b->ip_address ?></p></td>
                                        <td><p> <?php echo $b->user_agent ?></p></td>
                                        <td><p> <?php echo $b->created_at ?></p></td>
                                 
                                    </tr>

                                    <?php
                                    $counter++;
                                        }

                                    } ?>

                                    </tbody>
                                 
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
                </div>

        </div>

<script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                { targets:"_all", orderable: false },
                { targets:[0,1,2,3,4,5], className: "desktop" },
                { targets:[0,1], className: "tablet, mobile" }
            ]
            });
    
        });

       


    </script>






@endsection
