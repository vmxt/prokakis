@extends('layouts.app')



@section('content')



    <style>



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



    <div class="row justify-content-center">

        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

            <li>

                <a href="{{ url('/home') }}">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="#">Reports</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                Ongoing Monitoring

            </li>



        </ul>



        <div class="card">



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



        <div class="portlet light portlet-fit portlet-datatable">

            <div class="portlet-title">

                <div class="caption">

                    <i class="icon-settings font-green"></i>

                    <span class="caption-subject font-blue sbold uppercase">Ongoing Monitoring Report</span>

                </div>

                <div class="actions">

                   

                   <!-- <div class="btn-group">

                        <a class="btn blue btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">

                            <i class="fa fa-share"></i>

                            <span class="hidden-xs"> Trigger Tools </span>

                            <i class="fa fa-angle-down"></i>

                        </a>

                        <ul class="dropdown-menu pull-right" id="sample_3_tools">

                            <li>

                                <a href="javascript:;" data-action="0" class="tool-action">

                                    <i class="icon-printer"></i> Print</a>

                            </li>

                            <li>

                                <a href="javascript:;" data-action="1" class="tool-action">

                                    <i class="icon-check"></i> Copy</a>

                            </li>

                            <li>

                                <a href="javascript:;" data-action="2" class="tool-action">

                                    <i class="icon-doc"></i> PDF</a>

                            </li>

                            <li>

                                <a href="javascript:;" data-action="3" class="tool-action">

                                    <i class="icon-paper-clip"></i> Excel</a>

                            </li>

                            <li>

                                <a href="javascript:;" data-action="4" class="tool-action">

                                    <i class="icon-cloud-upload"></i> CSV</a>

                            </li>

                            <li class="divider"> </li>

                            <li>

                                <a href="javascript:;" data-action="5" class="tool-action">

                                    <i class="icon-refresh"></i> Reload</a>

                            </li>



                        </ul>

                    </div> -->



                </div>

            </div>

            <div class="portlet-body">

                <div class="table-container">

                    <div id="sample_3_wrapper" class="dataTables_wrapper no-footer"><div class="row"><div class="col-md-6 col-sm-6"><div class="dataTables_length" id="sample_3_length"><label><select name="sample_3_length" aria-controls="sample_3" class="form-control input-sm input-xsmall input-inline"><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="-1">All</option></select> entries</label></div></div><div class="col-md-6 col-sm-6"><div id="sample_3_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="sample_3"></label></div></div></div><div class="table-scrollable"><table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="sample_3" role="grid" aria-describedby="sample_3_info" style="width: 1096px;">

                                <thead>

                                <tr role="row">

                                   <!-- <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> No </th> -->

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 221px;" aria-label=" Browser : activate to sort column ascending"> Requested Report </th>

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 221px;" aria-label=" Browser : activate to sort column ascending"> Company </th>

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 198px;" aria-label=" Platform(s) : activate to sort column ascending"> Interval </th>

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 150px;" aria-label=" Engine version : activate to sort column ascending"> Start Date </th>

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 107px;" aria-label=" CSS grade : activate to sort column ascending"> End Date </th>

                                   <!-- <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> Generated Report Status </th> -->

                                   <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> Status </th>

                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> Download Report </th>
                                   
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> Request Update </th>

                                </tr>

                                </thead>

                                <tbody>

                                <?php

                                $i = 1;

                                $today = date('Y-m-d');

                                echo  $today.'<br />';

                                $dStart = 0;

                                $dEnd  = 0;    

                                foreach($listData as $data){



                                    $dStart = (int)strtotime($data->month_subscription_start);

                                    $dEnd = (int)strtotime($data->month_subscription_end);



                                ?>

                                <tr>

                               

                                    <td><?php 

                                        $rc = App\ProcessedReport::getReqRepId($data->approval_id);

                                        if($rc != false){

                                            echo '<b>'.$rc->id . '-' . $rc->source_company_id . '-' . $rc->fk_opportunity_id.'</b>';

                                        }

                                        ?></td>

                                    

                                    <td id="tdDesc<?php echo $data->id; ?>"><?php

                                        echo App\CompanyProfile::getCompanyName($data->source_company_id);

                                        ?>

                                    </td>



                                    <td>

                                        <?php

                                        $freq = App\RequestFrequency::find($data->request_frequency_id);

                                        echo $freq->frequency_name;

                                        ?>

                                    </td>

                                    <td>

                                        <?php echo date("F j, Y", strtotime($data->month_subscription_start)); ?>

                                    </td>

                                    <td>

                                        <?php echo date("F j, Y", strtotime($data->month_subscription_end)); ?>

                                    </td>


                                    <td>

                                        <?php 

                                       $today = date('Y-m-d');

                                       $karunAdlawa =  strtotime($today);  

                                       $endTime = strtotime($data->month_subscription_end);

                                        if($endTime < $karunAdlawa)
                                        {
                                         echo  '<div class="alert alert-info"><b>Completed</b></div>';
                                        } 
                                        ?>

                                    </td>



                                        <td>

                                            <?php $req_id = App\RequestApproval::getRequestId($data->approval_id);  ?>

                                            

                                            <a href="{{ url('/buyReport/download/') }}/<?php echo base64_encode($data->source_company_id) . '/' . base64_encode($req_id); ?>"

                                               onclick="return confirm('Are you sure you want to download the company report of <?php echo App\CompanyProfile::getCompanyName($data->source_company_id); ?> ?')"

                                               class="btn btn-danger">Download</a>

    

                                        </td>

    
    

                                        <td>

                                            <a href="{{ url('/reports/requestUpdate/') }}/<?php echo $data->id; ?>"

                                               onclick="return confirm('Are you sure to send request update of the company details? This will deduct one token to process.')"

                                               class="btn btn-success">Request</a>

                                        </td>

                                </tr>
                                <tr><td colspan="8">
                                    <div class="note note-danger"><b> Download Report</b>; "Please download your KYB Due Diligence report within <?php echo $freq->description; ?>. There will be no replacement or refund after the link expires"</div>
                                    <div class="note note-success"><b> Request Update</b>; "User can request provider to update their current information to request for their latest report"</div>
                                </td></tr>
                             

                                <?php } ?>

                               

                                </tbody>

                            </table></div>
<!--<div class="row"><div class="col-md-5 col-sm-5"><div class="dataTables_info" id="sample_3_info" role="status" aria-live="polite">Showing 1 to 10 of 43 entries</div></div><div class="col-md-7 col-sm-7"><div class="dataTables_paginate paging_bootstrap_number" id="sample_3_paginate"><ul class="pagination" style="visibility: visible;"><li class="prev disabled"><a href="#" title="Prev"><i class="fa fa-angle-left"></i></a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#" title="Next"><i class="fa fa-angle-right"></i></a></li></ul></div></div></div></div> -->

                </div>

            </div>

        </div>

    </div>











    <script src="{{ asset('public/js/app.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">

    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>



    <script>

        $(document).ready(function () {

            $('#system_data').DataTable();



        });





    </script>



@endsection