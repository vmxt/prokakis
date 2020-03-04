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

                <a href="{{ url('/home') }}">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="{{ route('approvalPageAdmin') }}">System Users Accounts</a>

            </li>

        </ul>

        <div class="row justify-content-center">



            <div class="col-md-12">



                    <div class="portlet light ">

                        <div class="portlet-title">

                            <div class="caption">

                                <i class="icon-users"></i>

                                <span class="caption-subject font-blue sbold uppercase">List of registered users</span>



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

                                                    <th>First Name</th>

                                                    <th>Last Name</th>

                                                    <th>Email</th>

                                                    <th>Company Name</th>

                                                    <th>Company Website</th>

                                                    <th>User Type</th>



                                                    <th>Registration Status</th>

                                                    <th>Registration Date</th>

                                                    <th>Action</th>

                                                </tr>

                                        </thead>

                                                <tbody>



                                                <?php

                                                if( count((array)$rs) > 0 )

                                                {



                                                 $i = 1;

                                                 foreach($rs as $d)

                                                 {





                                                ?>

                                                    <tr class="active">



                                                    <td align="center">

                                                        <?php echo $d->firstname; ?>

                                                    </td>



                                                    <td align="center">

                                                        <?php echo $d->lastname; ?>

                                                    </td>



                                                    <td align="center">

                                                            <?php echo $d->email; ?>

                                                    </td>





                                                    <td align="center">

                                                        <?php

                                                        $company_id_result = App\CompanyProfile::getCompanyId($d->id);

                                                        ?>

                                                        <a href="{{ url('/profile/viewer/'.$company_id_result) }}" target="_blank"><?php echo $d->company_name; ?></a>

                                                    </td>



                                                    <td align="center">

                                                        <?php echo '<a href="http://'.$d->company_website.'" target="_blank">'.$d->company_website.'</a>'; ?>

                                                    </td>





                                                    <td align="center">



                                                         <?php

                                                            switch ($d->user_type) {

                                                                case 2:

                                                                    echo '<span class="label label-sm label-success">Sub Consultant</span>';

                                                                    break;



                                                                case 3:

                                                                    echo '<span class="label label-sm label-info">Master Consultant</span>';

                                                                    break;



                                                                case 4:

                                                                    echo '<span class="label label-sm label-danger">Ebos Staff</span>';

                                                                    break;



                                                                case 1:

                                                                    echo ' <span class="label label-sm label-warning">Company </span>';

                                                                    break;

                                                            }



                                                            ?>



                                                    </td>



                                                    <td align="center">

                                                        <?php

                                                        switch ($d->status) {

                                                            case 1:

                                                                echo '<i>Active</i>';

                                                                break;



                                                            case 0:

                                                                echo '<b>Deactivated</b>';

                                                                break;



                                                            case 2:

                                                                echo '<b>Pending</b>';

                                                                break;



                                                            case 3:

                                                                echo '<b>Rejected</b>';

                                                                break;

                                                        }



                                                        ?>

                                                    </td>



                                                    <td align="center">

                                                        <?php

                                                        echo date("F j, Y", strtotime($d->created_at));

                                                        ?>

                                                    </td>



                                                    <td align="center">

                                                    <form class="user-form" action="{{ route('storeApprovalAdmin') }}" method="POST" style="display: block;">

                                                     {{ csrf_field() }}

                                                        <input type="hidden" name="user_id" value="<?php echo $d->id; ?>">

                                                        <select name="user_status" id="user_status" onchange="this.form.submit()">

                                                          <?php if($d->status == 1) { ?>

                                                            <option value=""></option>

                                                             <option value="0">Deactivate</option>

                                                          <?php }elseif($d->status == 2){ ?>

                                                            <option value=""></option>

                                                            <option value="1">--Approve--</option>

                                                            <option value="3">--Rejected--</option>

                                                         <?php }elseif($d->status == 0){  ?>

                                                            <option value=""></option>

                                                            <option value="1">--Activate--</option>

                                                        <?php }elseif($d->status == 3){  ?>

                                                            <option value=""></option>

                                                            <option value="1">--Approve--</option>

                                                       <?php } ?>

                                                        </select>

                                                    </form>

                                                    </td>



                                                    </tr>





                                                <?php

                                                         $i++;

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





    <script src="{{ asset('public/js-tabs/jquery-1.12.4.js') }}"></script>

    <script src="{{ asset('public/js-tabs/jquery-ui.js') }}"></script>



    <!--<script src="{{ asset('public/js/app.js') }}"></script>-->

    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>



    <script>



        $(document).ready(function () {

            $('#system_data').DataTable();



          //  $('form select').on('change', function(){

          //      $(this).closest('form').submit();

          //  });



        });



        $(function() {

            $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

          });







    </script>



@endsection

