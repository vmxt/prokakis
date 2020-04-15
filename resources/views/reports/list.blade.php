@extends('layouts.app')



@section('content')

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

                            <th>No</th>

                            <th>Requested Report</th>

                            <th>Search On</th>

                            <th>Report Status</th>

                            <th>Completed Date</th>

                            <th>Action</th>

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



  



    {{-- <script src="{{ asset('public/js/app.js') }}"></script> --}}

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



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

