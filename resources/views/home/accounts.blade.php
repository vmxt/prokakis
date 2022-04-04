@extends('layouts.app')

@section('content')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>


        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 30px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .btn-x3 {
            font-size: 15px;
            border-radius: 5px;
            width: 25%;
            background-color: orangered;
        }
@media (max-width: 425px){
    .col-md-12{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
}

    </style>

    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>All Accounts</span>
            </li>
        </ul>
        <div class="row justify-content-center">
           
            <div class="col-md-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb font-blue"></i>
                                <span class="caption-subject font-blue sbold uppercase">Registered Users</span>
                            </div>

                        </div>
                        <div class="portlet-body">
                            <div id="container" class="table-scrollable">

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

                                <table id="system_data" class=" table hover row-border striped compact" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Firstname</th>
                                        <th >Lastname</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Company Website</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Reason they found</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $counter = 1;
                                    if(count((array)$result) > 0){
                                    foreach($result as $res){    
                                
                                        ?>
                                    <tr>
                                        <td>{{ $res->firstname }}</td>
                                        <td>{{ $res->lastname }}</td>
                                        <td>{{ $res->email }}</td>
                                        <td>{{ $res->company_name }}</td>
                                        <td><a href="{{  $res->company_website }}">{{ $res->company_website }}<a/></td>
                                        <td>{{ $res->status == '1' ? 'active':'inactive' }}</td>
                                        <td>{{ isset($res->created_at)?date('m d,Y H:i:s',strtotime($res->created_at) ):'-' }}</td>
                                        <td>{{ $res->reason_heard }}</td>
                                    </tr>
                                    <?php
                                    $counter++;
                                    }

                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                </div>

        </div>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                {width:"5%",targets:1},
                { targets:"_all", orderable: true },
                { targets:[0,1,2,3,4,5], className: "desktop" },
                { targets:[0,1], className: "tablet, mobile" }
            ]
            });
       
        });




    </script>

@endsection
