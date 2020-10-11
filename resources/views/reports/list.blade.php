@extends('layouts.app')



@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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

        .intro-tour-overlay {
            display: none;
            background: #666;
            opacity: 0.5;
            z-index: 1000;
            min-height: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
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

            Report Status

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

                <table id="system_data" class="display hover row-border stripe compact" style="width:100%">

                    

                        <thead>

                        <tr>

                            <th id='th1'>No</th>

                            <th id='th2'>Requested Report</th>

                            <th id='th3'>Search On</th>

                            <th id='th4'>Report Status</th>

                            <th id='th5'>Completed Date</th>

                            <th id='th6'>Action</th>

                        </tr>

                        </thead>

                        <tbody>
                            <?php

$i = 1;

foreach ($listData as $data) {

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



    if (count((array) $rec) > 0) {



        $pr = App\ProcessedReport::where('approval_id', $rec->request_approval_id)->first();



        if (count((array) $pr) > 0) {



            $today = date('Y-m-d');

            $todayFinal = strtotime($today);



            $end_date = $pr->month_subscription_end;

            $subEnd = strtotime($end_date);



            if (isset($pr->report_link) && trim($pr->report_link) != '') {

                echo '<i>Discontinued subscription.</i>';

            } elseif ($todayFinal > $subEnd) {

                echo '<i>Subscription Ended</i>';

            } elseif ($data->is_approve == 'yes') {

                echo '<span class="btn-x3" style="color:white">Approved - Ongoing Monitoring</span>';

            } else {

                echo '<i>Pending</i>';

            }



        } else {

            echo ($data->is_approve == 'yes') ? '<span class="btn-x3" style="color:white">Approved - Ongoing Monitoring</span>' : 'Pending';

        }



    } else {

        echo 'Our consultants is now preparing the report. ';

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



    if (count((array) $rec) > 0) {

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

                                        <input type="submit" name="" <?php echo $disabled; ?> class="btn btn-primary"

                                               <?php echo $butStat; ?>  value="Buy Report">



                                    </form>

                                </td>



                            </tr>

                            <?php }?>



                    </tbody>

                </table>

            </div>

        </div>

    </div>



 <div class='intro-tour-overlay'></div>
  



    {{-- <script src="{{ asset('public/js/app.js') }}"></script> --}}

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>



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
 <script>
// Instance the tour
var tour = new Tour({
  steps: [
  {
    element: ".portlet",
    title: "Report Status",
    content: "Report Status Section",
    placement: 'top'
  },
    {
    element: "#system_data_length",
    title: "Show Entries",
    content: "Choose how many entries to display",
    placement: 'top'
  },
   {
    element: "#system_data_filter",
    title: "Filter Entries",
    content: "Enter text to filter the entries",
    placement: 'top'
  },
    {
    element: "#th1",
    title: "Number of Entries",
    content: "Number of Entries",
    placement: 'down'
  },
     {
    element: "#th2",
    title: "Requested Report",
    content: "Requested Reports",
    placement: 'down'
  },
     {
    element: "#th3",
    title: "Report Status ",
    content: "Report Reports",
    placement: 'down'
  },
       {
    element: "#th4",
    title: "Report Status ",
    content: "Report Reports",
    placement: 'down'
  },
         {
    element: "#th5",
    title: "Completed Date ",
    content: "Completed Date",
    placement: 'down'
  },
           {
    element: "#th6",
    title: "Action ",
    content: "clicking the button to buy a report",
    placement: 'down'
  },
],

  container: "body",
  smartPlacement: false,
  keyboard: true,
  // storage: window.localStorage,
  storage: false,
  debug: false,
  backdrop: true,
  backdropContainer: 'body',
  backdropPadding: 0,
  redirect: false,
  orphan: false,
  duration: false,
  delay: false,
  basePath: "",
  placement: 'auto',
    autoscroll: true,
  afterGetState: function (key, value) {},
  afterSetState: function (key, value) {},
  afterRemoveState: function (key, value) {},
  onStart: function (tour) {},
  onEnd: function (tour) {
     $('.intro-tour-overlay').hide();
      $('html').css('overflow','unset')
     $('.menu-dropdown').removeClass('open');
     updateTour('end');
  },
  onShow: function (tour) {},
  onShown: function (tour) {},
  onHide: function (tour) {},
  onHidden: function (tour) {},
  onNext: function (tour) {},
  onPrev: function (tour) {},
  onPause: function (tour, duration) {},
  onResume: function (tour, duration) {},
  onRedirectError: function (tour) {}

});

// Initialize the tour
tour.init();

// Start the tour
if( $('#is_tour').val() == 1 ){
    $('html').css('overflow','visible');
     $('.intro-tour-overlay').show();
    tour.start();
}

        $(document).ready(function () {
            $(".close").click(function () {
                $(".jumbotron").remove();
            });
        });

    </script>


@endsection

