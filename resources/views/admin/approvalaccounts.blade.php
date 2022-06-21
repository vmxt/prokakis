@extends('layouts.app')



@section('content')


    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap.min.css">



<style>
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



       



                    <div class="portlet light ">

                        <div class="portlet-title">

                            <div class="caption">

                                <i class="icon-users"></i>

                                <span class="caption-subject sbold uppercase">List of registered users</span>



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

                            <!-- <div class="table-scrollable"> -->
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
                                <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped" style="width:100%;display:none">
                                        <thead>
                                            <tr>
                                                <th  class="all">First Name</th>
                                                <th class="all">Last Name</th>
                                                <th class="all">Email</th>
                                                <th class="all">User Type</th>
                                                <th class="all">Reason</th>

                                                <th  class="none">Company Name</th>
                                                <th  class="none">Company Website</th>
                                                <th  class="none">Registration Status</th>
                                                <th  class="none">Registration Date</th>
                                                <th  class="none">Action</th>
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
                                                    <td align="center" class="d-inline-block text-truncate" style="max-width: 150px; overflow: hidden;">
                                                        <?php echo $d->firstname; ?>
                                                    </td>

                                                    <td align="center" class="d-inline-block text-truncate" style="max-width: 150px; overflow: hidden;">
                                                        <?php echo $d->lastname; ?>
                                                    </td>

                                                    <td align="center">
                                                            <?php echo $d->email; ?>
                                                    </td>

                                                    <td align="center">
<?php                                                   switch ($d->user_type) {
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
                                                        <?php echo $d->reason_heard; ?>
                                                    </td>

                                                    <td align="center">
<?php                                               $company_id_result = App\CompanyProfile::getCompanyId($d->id); ?>
                                                        <a href="{{ url('/profile/viewer/'.$company_id_result) }}" target="_blank"><?php echo $d->company_name; ?></a>
                                                    </td>

                                                    <td align="center">
                                                        <?php echo '<a href="http://'.$d->company_website.'" target="_blank">'.$d->company_website.'</a>'; ?>
                                                    </td>



                                                    <td align="center">
<?php
                                                        switch ($d->status) {
                                                            case 1:
                                                                echo 'Active';
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
<?php                                                   echo date("F j, Y", strtotime($d->created_at)); ?>
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

                               

                            <!-- </div> -->

                        </div>

                    </div>















               

                </div>



        </div>



    <script src="{{ asset('public/js-tabs/jquery-1.12.4.js') }}"></script>

    <script src="{{ asset('public/js-tabs/jquery-ui.js') }}"></script>



    <script src="{{ asset('public/js/app.js') }}"></script>

    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
    <!-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap.min.js"></script>



    <script>

$(document).ready(function() {
    $('#system_data').DataTable( {
        "ordering": false,
            "aSorting": [[ 3, "desc" ]],
          "bJQueryUI": true,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },
         "drawCallback": function( settings ) {
                        $(".table_loader").fadeOut();
                        $(".table_loader").remove();
                        $('#system_data').show();
                },
    } );
} );

        // $(document).ready(function () {

            // $('#system_data').DataTable( {
            //     "order": [[ 3, "desc" ]],
            //      "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
            // } );



          //  $('form select').on('change', function(){

          //      $(this).closest('form').submit();

          //  });



        // });



        $(function() {

            // $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

          });







    </script>



@endsection

