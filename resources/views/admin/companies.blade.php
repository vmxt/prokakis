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
        
            .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}


.center {
  height: 150px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #000;
}
.wave {
  width: 5px;
  height: 100px;
  background: linear-gradient(45deg, #7cda24, #fff);
  margin: 10px;
  animation: wave 1s linear infinite;
  border-radius: 20px;
}
.wave:nth-child(2) {
  animation-delay: 0.1s;
}
.wave:nth-child(3) {
  animation-delay: 0.2s;
}
.wave:nth-child(4) {
  animation-delay: 0.3s;
}
.wave:nth-child(5) {
  animation-delay: 0.4s;
}
.wave:nth-child(6) {
  animation-delay: 0.5s;
}
.wave:nth-child(7) {
  animation-delay: 0.6s;
}
.wave:nth-child(8) {
  animation-delay: 0.7s;
}
.wave:nth-child(9) {
  animation-delay: 0.8s;
}
.wave:nth-child(10) {
  animation-delay: 0.9s;
}

@keyframes wave {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}


    </style>

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />
<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

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

                                <span class="caption-subject sbold uppercase">List of registered companies</span>



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

                            <div class="table-scrollable" style="border:none !important">
                                 <div class="table_loader center">
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                        </div>
                                <table id="system_data"  class="table pure-table pure-table-horizontal pure-table-striped" style="width:100%;display:none">

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

                                                    <tr class="">



                                                    <td >

                                                      <?php echo $d->company_name; ?>

                                                    </td>



                                                    <td >

                                                        <?php echo $d->description; ?>

                                                    </td>



                                                    <td >

                                                        <?php echo $d->email; ?>

                                                    </td>





                                                    <td >

                                                        <?php echo $d->company_website; ?>

                                                    </td>



                                                    <td >

                                                        <?php echo $d->registered_address; ?>

                                                    </td>



                                                    <td >

                                                        <?php echo $d->industry; ?>

                                                    </td>





                                                    <td >

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

            $('#system_data').DataTable({
                "drawCallback": function( settings ) {
                        $(".table_loader").fadeOut();
                        $(".table_loader").remove();
                        $('#system_data').show();
                },
            });



          //  $('form select').on('change', function(){

          //      $(this).closest('form').submit();

          //  });



        });



        $(function() {

            $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

          });







    </script>



@endsection

