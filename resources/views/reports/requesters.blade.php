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
            Report Requesters
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
            <span class="caption-subject font-blue sbold uppercase">Report Requesters</span>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover table-light">
                    <tbody>
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Requesters Company Name</th>
                            <th>Company Website</th>
                            <th>Company Address</th>
                            <th>Request Date</th>


                        </tr>
                        </thead>
                            <?php
$i = 1;
foreach ($listData as $data) {
	?>
                            <tr>
                                <td align="center"><?php echo $i++; ?></td>

                                <td>
                                    <?php //echo $data->created_at;
	//echo date("F j, Y, g:i a", strtotime($data->created_at));
	$companyInfo = App\CompanyProfile::find($data->company_id);
	if (count((array) $companyInfo) - 1 > 0) {
		echo $companyInfo->registered_company_name;
	}
	?>
                                </td>

                                <td valign="top" align="center">
                                    <?php
echo '<a href="https://' . $companyInfo->company_website . '">' . $companyInfo->company_website . '</a>';
	?>
                                </td>

                                <td valign="top" align="center">
                                    <?php
echo $companyInfo->registered_address;
	?>
                                </td>

                                <td valign="top" align="center">
                                    <?php //echo $data->updated_at;

	//$date=date_create($data->updated_at);
	//echo date_format($date,"Y-m-d H:i:s");

	echo date("F j, Y, g:i a", strtotime($data->created_at));

	?>
                                </td>


                            </tr>
                            <?php }?>

                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Requesters Company Name</th>
                                    <th>Company Website</th>
                                    <th>Company Address</th>
                                    <th>Request Date</th>
                                </tr>
                            </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            // $('#system_data').DataTable();

        });


    </script>

@endsection
