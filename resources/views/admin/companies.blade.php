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

                                <span class="caption-subject font-blue sbold uppercase">List of registered companies</span>



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

                                                    <th>Company Name</th>

                                                    <th>Company Description</th>

                                                    <th>Email</th>

                                                    <th>Website</th>

                                                    <th>Address</th>

                                                    <th>Industry</th>

                                                    <th>Action</th>

                                                </tr>

                                        </thead>

                                                <tbody>



                                                <?php

                                                if( count((array)$rs) > 0 )

                                                {



                                                 foreach($rs as $d)

                                                 {





                                                ?>

                                                    <tr class="danger">



                                                    <td align="center">

                                                      <?php echo $d->company_name; ?>

                                                    </td>



                                                    <td align="center">

                                                        <?php echo $d->description; ?>

                                                    </td>



                                                    <td align="center">

                                                        <?php echo $d->email; ?>

                                                    </td>





                                                    <td align="center">

                                                        <?php echo $d->company_website; ?>

                                                    </td>



                                                    <td align="center">

                                                        <?php echo $d->registered_address; ?>

                                                    </td>



                                                    <td align="center">

                                                        <?php echo $d->industry; ?>

                                                    </td>





                                                    <td align="center">

                                                        <a href="{{ url('/profile/viewer/'.$d->id) }}" target="_blank" class="btn btn-primary">View More</a>

                                                    </td>



                                                    </tr>





                                                <?php



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

