@extends('layouts.app')



@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">

    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">



    <style>



        .btn-x3 {

            font-size: 15px;

            border-radius: 5px;

            width: 25%;

            background-color: orangered;

        }

    </style>



    <div class="container">

        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

            <li>

                <a href="{{ url('/homeSubConsul') }}">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="{{ route('projectOverviewMC') }}">Project Overview</a>

            </li>

        </ul>

        <div class="row justify-content-center">



            <div class="col-md-12">



                    <div class="portlet light ">

                        <div class="portlet-title">

                            <div class="caption">

                                <i class="icon-notebook"></i>

                                <span class="caption-subject font-blue sbold uppercase">Completed Projects</span>



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

                            <div class="table-scrollable">

                                <table id="system_data" class="table table-bordered table-hover">

                                        <thead>

                                                <tr>

                                                    <th>No</th>

                                                    <th>Project Name</th>

                                                    <th>Due Date</th>

                                                    <th>Assigned Consultant</th>

                                                    <th>Progress</th>

                                                    <th>Status</th>

                                                    <th>View Report</th>

                                                </tr>

                                        </thead>

                                                <tbody>



                                                <?php

                                                if( count((array)$rs) > 0 ){

                                                 $i = 1;

                                                 foreach($rs as $d){



                                                ?>

                                                    <tr class="success">

                                                    <td align="center"><?php echo $i; ?></td>

                                                    <td align="center">

                                                        <?php

                                                            echo App\RequestReport::getProjectName($d->request_id);

                                                        ?>

                                                    </td>

                                                    <td align="center"><?php echo $d->due_date; ?></td>

                                                    <td align="center">

                                                        <?php

                                                            $usr = App\User::find($d->assigned_consultant_id);

                                                            if(count((array)$usr) > 0){

                                                               echo $usr->firstname.' '.$usr->lastname;

                                                            }

                                                        ?>

                                                    </td>

                                                    <td align="center">

                                                        <?php

                                                           echo $d->progress."%";

                                                        ?>

                                                    </td>



                                                    <td align="center"><?php

                                                        if(is_numeric($d->project_status))

                                                        {

                                                           echo $d->project_status."0%";

                                                        } else{

                                                           echo $d->project_status;

                                                        }

                                                     ?></td>



                                                    <td align="center"><a>

                                                        <?php

                                                        $ff = explode(",", $d->remarks);

                                                        echo 'File uploaded on: <br />';

                                                        foreach($ff as $f){

                                                           $ext = explode(":", $f);

                                                           if(isset($ext[1])) {

                                                             $upImg =  App\UploadImages::find($ext[1]);

                                                             if(count((array)$upImg) > 0){

                                                           ?>

                                                           <a target="_blank" href="{{ url('/public/consultantproject/'.$upImg->file_name) }}"><?php echo $ext[0].']'; ?> </a><br />

                                                           <?php

                                                             }

                                                           }

                                                        }

                                                       ?>

                                                    </td>

                                                    </tr>

                                                <?php

                                                     $i++;



                                                    } //loop of accepted projects

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





    <script src="{{ asset('public/js-tabs/jquery-1.12.4.js') }}"></script>

    <script src="{{ asset('public/js-tabs/jquery-ui.js') }}"></script>



    <!--<script src="{{ asset('public/js/app.js') }}"></script>-->

    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>



    <script>



        $(document).ready(function () {

            $('#system_data').DataTable();





        });



        $(function() {

            $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

          });







    </script>



@endsection

