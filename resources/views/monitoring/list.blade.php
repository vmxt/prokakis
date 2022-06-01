@extends('layouts.app')



@section('content')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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

 .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}
 .cardborder-radius{
        border-radius: 20px !important;
        border: 1px solid #a5a5a5; ;
    }
    
     .cardborder-radius:hover{
        box-shadow:  0 8px 16px 0 rgb(187 187 187) !important;
    }

    </style>

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

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

            </div>

            <div class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">
            
            <div class="table-scrollable" style="border:none">

                    <div id="sample_3_wrapper" class="dataTables_wrapper no-footer">

                        <div class="row">
                            
                              
                        </div> 

                    <div class="table-scrollable">

                            <table id="system_data" class="display hover row-border stripe compact" style="width:100%">
                                <thead>

                                <tr role="row">

                                   <!-- <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> No </th> -->

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 221px;" aria-label=" Browser : activate to sort column ascending"> Requested Report </th>

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 221px;" aria-label=" Browser : activate to sort column ascending"> Company </th>

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 198px;" aria-label=" Platform(s) : activate to sort column ascending"> Interval </th>

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 150px;" aria-label=" Engine version : activate to sort column ascending"> Start Date </th>

                                    <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 107px;" aria-label=" CSS grade : activate to sort column ascending"> End Date </th>

                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> Status </th>

                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> Download Report </th>
                                   
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> Request Update </th>

                                </tr>

                                </thead>

                                <tbody>

                                <?php

                                $i = 1;

                                $today = date('Y-m-d');

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

                                        ?> 
                                    </td>

                                    

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
                                         echo  '<div class="alert"><b>Completed</b></div>';
                                        } else {
                                            echo  '<div class="alert"><b>Active</b></div>';  
                                        } 
                                        ?>

                                    </td>



                                        <td>

                                            <?php $req_id = App\RequestApproval::getRequestId($data->approval_id);  ?>

                                            <div class="btn-group-vertical">

                                            <a href="{{ url('/buyReport/download/') }}/<?php echo base64_encode($data->source_company_id) . '/' . base64_encode($req_id) .'?aprvl='.$data->approval_id ; ?>"

                                               onclick="return confirm('Are you sure you want to download the company report of <?php echo App\CompanyProfile::getCompanyName($data->source_company_id); ?> ?')"

                                               class="btn btn-warning">Company Overview</a>
                                                
                                               <a width: 150px;
                                               display: inline-block; href="{{ url('/genReportAml/') }}/<?php echo base64_encode($data->id).'-'.time(); ?>" class="btn btn-success"> World-Check-Refinitiv</a> 
                                               <a width: 150px;
                                               display: inline-block; href="{{ url('/genReportIa/') }}/<?php echo base64_encode($data->id).'-'.time(); ?>"  class="btn btn-info"> Investors Alert </a>                                         
                                               <a width: 150px;
                                               display: inline-block; href="{{ url('/genReportAm/') }}/<?php echo base64_encode($data->id).'-'.time(); ?>"  class="btn btn-primary"> Adverse Media </a> 
                                               <a width: 150px;
                                               display: inline-block; href="{{ url('/genReportAll/') }}/<?php echo base64_encode($data->id).'-'.time(); ?>" onclick="return confirm('Are you sure you want to download the reports such as World-Check-Refinitiv, Investors Alert, and Adverse Media into a zip file?, this will take a while to process.')"
                                                class="btn btn" style="background-color:white;">Download All</a>
                                             
                                            </div>
    

                                        </td>

    
    

                                        <td>
                                            <div class="btn-group-vertical">
                                            <a href="{{ url('/reports/requestUpdate/') }}/<?php echo $data->id; ?>"

                                               onclick="return confirm('Are you sure to send request update of the company details? This will deduct one token to process.')"

                                               class="btn btn-warning" style="background-color:#FC6600;">Request</a>

                                            </div>
                                        </td>

                                </tr>


                                <tr><td colspan="8">
                                    <div class="note note-danger"><b> Download Report</b>; "Please download your KYB Due Diligence report within <?php echo $freq->description; ?>. There will be no replacement or refund after the link expires"</div>
                                </td></tr>


                            
                                <?php } ?>



                                <tfoot>
                                    
                        
                                    <tr><td colspan="8">
                                        <div class="note note-success"><b> Request Update</b>; "User can request provider to update their current information to request for their latest report"</div>
                                    </td></tr>
                                 
                                    </tfoot>

                               

                                </tbody>

                            </table>
                        </div>
                     </div>
                </div>

            </div>

        </div>

    </div>











    {{-- <script src="{{ asset('public/js/app.js') }}"></script> --}}

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}"> --}}

    {{-- <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script> --}}

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




    <script>

        $(document).ready(function () {

            $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                { targets:"_all", orderable: false },
                { targets:[0,1,2,3,4,5,6,7], className: "desktop" },
                { targets:[0], className: "tablet, mobile" }
            ]
            });
        });

      /*  function downloadAll(idx, compOverview)
        {
            //alert(compOverview);

            if (confirm("Are you sure to download all the files?")) {
                
                setTimeout(function(){
                    window.open("{{ url('/genReportAml/') }}/"+idx, "_blank");
                    }, 2000);
        
                setTimeout(function(){
                    window.open("{{ url('/genReportIa/') }}/"+idx, "_blank");
                    }, 4000);
        
                setTimeout(function(){
                    window.open("{{ url('/genReportAm/') }}/"+idx, "_blank");
                    }, 6000);
                    
                setTimeout(function(){
                    window.open(compOverview, "_blank");
                    }, 8000);
            
            } 
     
        }*/

       

    </script>



@endsection