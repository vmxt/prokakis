@extends('layouts.app')



@section('content')


    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

    <style>



        .btn-x3 {

            font-size: 15px;

            border-radius: 5px;

            width: 25%;

            background-color: orangered;

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

                <a href="{{ url('/consultants/pending-projects') }}">Pending Projects</a>

            </li>

        </ul>

        <div class="row justify-content-center">



            <div class="col-md-12">



                    <div class="portlet light ">

                        <div class="portlet-title">

                            <div class="caption">

                                <i class="icon-bulb "></i>

                                <span class="caption-subject sbold uppercase">List of Pending Projects</span>

                            </div>



                        </div>

                        <div class="portlet-body">

                            <div class="table-scrollable" style="border:none !important">

                                <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped">

                                    <thead>

                                    <tr>

                                        <th># Project Id</th>

                                        <th> Project Name</th>

                                        <th>Start Date</th>

                                        <th>Due Date</th>

                                        <th>Requested By</th>

                                        <th>Search On</th>

                                        <th>Progress</th>

                                        <th>Action</th>

                                    </tr>

                                    </thead>

                                    <tbody>



                                    <?php if(count((array)$rs) > 0){

                                    foreach($rs as $d){

                                     ?>

                                    <tr>

                                        <form action="{{ route('updateProjectSC') }}" method="POST">

                                           {{ csrf_field() }}

                                           <input type="hidden" name="project_id" value="<?php echo $d->id; ?>">

                                           <input type="hidden" name="new_project_status" value="ONGOING">



                                            <td align="center"><?php echo $d->id; ?></td>

                                            <td align="center">

                                                <?php

                                                echo App\RequestReport::getProjectName($d->request_id);

                                                ?>

                                            </td>

                                            <td align="center"><?php echo $d->start_date; ?></td>

                                            <td align="center"><?php echo $d->due_date; ?></td>

                                            <td align="center">

                                                <?php

                                                $usr = App\User::find($d->company_requester_id);

                                                if(count((array)$usr) > 0){

                                                  echo $usr->firstname.' '.$usr->lastname;

                                                }

                                                ?>

                                            </td>

                                            <td align="center"><?php echo $d->search_on; ?></td>



                                            <td align="center">

                                              0%

                                            </td>

                                            <td align="center">

                                              <?php if($d->project_status == 'PENDING'){  ?>

                                              <input type="submit" class="btn btn-danger" value="ACCEPT">

                                              <?php } ?>

                                            </td>



                                        </form>

                                    </tr>

                                    <?php }

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











    <script src="{{ asset('public/js/app.js') }}"></script>

    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>



    <script>

        $(document).ready(function () {

            $('#system_data').DataTable();



            $("#searchMyOpportunity").click(function () {

                var industry = $("#industry").val();

                var business = $("#businessType").val();



                var getUrl = window.location;

                var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];



                if (industry != "" && business != "") {

                    window.location.href = baseUrl + "/opportunity/exploreMy/" + industry + "/" + business;

                } else {

                    window.location.href = baseUrl + "/opportunity";

                }

            });



        });



    </script>



@endsection

