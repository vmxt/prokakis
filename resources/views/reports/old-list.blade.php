@extends('layouts.app')

@section('content')

    <style>

        html, body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
        }

        .btn-x3 {
            font-size: 15px;
            border-radius: 5px;
            width: 100%;
            background-color: orangered;
        }

        #edit_icon {
            cursor: pointer;
        }

    </style>
    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Report</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            View Reports
        </li>

    </ul>
    <div class="portlet light ">
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
        <div class="caption">
            <i class="icon-pie-chart font-blue"></i>
            <span class="caption-subject font-blue sbold uppercase">Report Status</span>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover table-light">
                    <tbody>
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Requested Report</th>
                            <th>Search On</th>
                            <th>Report Status</th>
                            <th>Completed Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                            <?php
                            $i = 1;
                            foreach($listData as $data){
                            ?>
                            <tr>
                                <td align="center"><?php echo $i++; ?></td>
                                <td align="center">

                                    <?php
                                    echo $data->id . '-' . $data->source_company_id . '-' . $data->fk_opportunity_id;
                                    //$comp_id = App\RequestReport::getRequestProviderCompanyID($data->opportunity_type, $data->fk_opportunity_id);
                                    //echo App\CompanyProfile::getCompanyName($comp_id);

                                    ?>
                                </td>

                                <td>
                                    <?php //echo $data->created_at;
                                    echo date("F j, Y, g:i a", strtotime($data->created_at));
                                    ?>
                                </td>

                                <td style="text-align: center; font-weight:bold;">
                                    
                                    <?php 
                                    $rec = App\ConsultantProjects::where('request_id', $data->id)->where('project_status', 'DONE')->first();
                                    
                                    if(count($rec) > 0){
                                     echo ($data->is_approve == 'yes') ? '<span class="btn-x3" style="color:white">Approved</span>' : 'Pending'; 
                                    }else{
                                     echo 'A consultant still working on this request project.';    
                                    }
                                    ?>

                                </td>

                                <td valign="top" align="center">
                                    <?php //echo $data->updated_at;

                                    //$date=date_create($data->updated_at);
                                    //echo date_format($date,"Y-m-d H:i:s");

                                    echo date("F j, Y, g:i a", strtotime($data->updated_at));

                                    ?>
                                </td>

                                <td>
                                    <?php
                                    $butStat = 'disabled';
                                     
                                    if(count($rec) > 0){
                                        if ($data->is_approve == 'yes') {
                                            $butStat = '';
                                        }
                                    }   
                                    ?>
                                    <form id="buyreport_form" method="POST" action="{{ route('setBuyReport') }}">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="company_id" id="company_id"
                                               value="<?php echo $data->source_company_id; ?>">
                                        <input type="hidden" name="request_id" id="request_id" value="<?php echo $data->id; ?>">
                                        <?php
                                        $disabled = '';
                                        $proc_record = App\RequestApproval::getProcessedRecord($data->id);
                                        if ($proc_record == true) {
                                            $disabled = 'disabled';
                                        }
                                        ?>
                                        <input type="submit" name="" <?php echo $disabled; ?> class="btn btn-primary btn-x3"
                                               <?php echo $butStat; ?>  value="Buy Report">

                                    </form>
                                </td>

                            </tr>
                            <?php } ?>
                            <!-- <input type="hidden" id="c_value<?php //echo $data->id; ?>" value="<?php //echo $js; ?>"> -->
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Requested Report</th>
                                    <th>Search On</th>
                                    <th>Report Status</th>
                                    <th>Completed Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--
    <div class="portlet light ">
       
        <div class="caption">
            <i class="icon-paper-clip font-blue"></i>
            <span class="caption-subject font-blue sbold uppercase">Report status, Who has viewed me</span>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th style="width:5%">No</th>
                        <th style="width:40%">Company Name</th>
                        <th style="width:20%">Date of Request</th>
                        <th style="width:20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach($viewedMe as $data){
                    ?>
                    <tr>
                        <td align="center"><?php echo $i++; ?></td>
                        <td id="tdDesc<?php echo $data->id; ?>" align="center">
                            <?php
                            $c = App\CompanyProfile::find($data->viewer_company_id);
                            if(count($c) > 0){
                            echo $c->company_name;
                            }   
                            ?>

                        </td>

                        <td align="center">
                            <?php echo date("F j, Y", strtotime($data->created_at)); ?>
                        </td>

                        <td><input type="submit" name="" disabled class="btn btn-primary btn-x3" value="Buy Report">
                        </td>

                    </tr>
                    <?php } ?>
                    <!-- <input type="hidden" id="c_value<?php //echo $data->id; ?>" value="<?php //echo $js; ?>"> -->
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Date of Request</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
-->




    <script src="{{ asset('public/js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            // $('#system_data').DataTable();

        });


    </script>

@endsection