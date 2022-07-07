@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

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
                <span>All Accounts</span>
            </li>
        </ul>
        <div class="row justify-content-center">
           
            <div class="col-md-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb "></i>
                                <span class="caption-subject  sbold uppercase">Registered Users</span>
                            </div>

                        </div>
                        <div class="portlet-body">
                            <div id="container" class="table-scrollable" style="border:none !important">

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

                                <table id="system_data" class=" table pure-table pure-table-horizontal pure-table-striped" style="width:100%;display:none">
                                    <thead>
                                    <tr>
                                        <th>Firstname</th>
                                        <th >Lastname</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Company Website</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Reason</th>
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
            "drawCallback": function( settings ) {
                $('#system_data').show();
                        $(".table_loader").fadeOut();
                        $(".table_loader").remove();
                        
                },
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
