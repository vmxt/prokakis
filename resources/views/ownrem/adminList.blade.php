@extends('layouts.app')



@section('content')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
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
    <div class="row justify-content-center">

        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Reports</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Request List of Owning a Company and Removal
            </li>
        </ul>

        <div class="card">
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



            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

        </div>



        <div class="portlet light portlet-fit portlet-datatable">

            <div class="portlet-title">

                <div class="caption">

                    <i class="icon-settings"></i>

                    <span class="caption-subject  sbold uppercase">Request List of Company Ownership and Removal</span>

                </div>


            </div>

            <div class="portlet-body">

                <div class="table-container">
       

                            <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped" style="width:100%">
                                <thead>

                                <tr role="row">

                                    <th style="width: 5%;"> No </th>

                                    <th style="width: 10%;" aria-label=" Browser : activate to sort column ascending"> Submitted At </th>

                                    <th style="width: 15%;" aria-label=" Browser : activate to sort column ascending"> User Requester </th>

                                    <th style="width: 10%;" aria-label=" Platform(s) : activate to sort column ascending"> Company Request Subject </th>

                                    <th style="width: 10%;" aria-label=" Engine version : activate to sort column ascending">Requester Business Profile </th>

                                    <th style="width: 10%;" aria-label=" CSS grade : activate to sort column ascending"> Requester Passpot File </th>

                                    <th style="width: 10%;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> Request Type </th>

                                    <th style="width: 20%;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> Actions </th>
                                   

                                </tr>

                                </thead>

                                <tbody>

                                <?php

                                $i = 1;

                                foreach($rs as $data){
                                ?>

                                <tr role="row">

                                    <td>{{ $data->id }}</td>

                                    <td><?php echo $data->created_at; ?></td>

                                    <td><?php 
                                    if(trim($data->requester_name) != ''){    
                                        echo '<strong>'.$data->requester_name.'</strong><br />';
                                        echo $data->requester_contact.'<br />';
                                        echo $data->requester_email;

                                    } else {
                                        $c = App\User::find($data->requester_user_id);    
                                        echo '<strong>'.$c->firstname.' '.$c->lastname.'</strong>'.'<br />';
                                        echo $c->phone.'<br />';
                                        echo $c->email;  

                                    }    
                                    ?></td>

                                    <td><?php 
                                        $c = App\CompanyProfile::find($data->subject_company_id);    
                                        echo '<strong>'.$c->company_name.'</strong>'.'<br />';
                                        echo $c->company_email.'<br />';
                                        echo $c->office_phone; 
                                    ?></td>

                                    <td> <?php if($data->request_type == 'own') { ?> <a target="_blank" href="{{ $data->businessFile }}"><strong>download</strong></a> <?php }else { echo 'none'; } ?> </td>

                                    <td> <?php if($data->request_type == 'own') { ?> <a target="_blank" href="{{ $data->passportFile }}"><strong>download</strong></a> <?php }else { echo 'none'; } ?> </td>

                                    <td><?php echo $data->request_type; ?></td>

                                    <td colspan="2" style="width: 176px;" aria-label=" Rendering engine : activate to sort column descending" aria-sort="ascending"> 
                                    <button onclick="acceptRequest({{ $data->id }}, '{{ $data->request_type }}')" class="btn btn-primary"> Accept </button>
                                    <button onclick="rejectRequest({{ $data->id }})" class="btn btn-danger"> Reject </button>
                                     
                                   </td>
                                   

                                </tr>

                        
                                <?php 
                                $i++;
                                } ?>

                               

                                </tbody>

                            </table>
                 

                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('public/js/app.js') }}"></script> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}"> --}}
    {{-- <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script> --}}

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>


    <script>


        $(document).ready(function () {

            $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                { targets:"_all", orderable: false },
                { targets:[0,1,2,3,4,5,6,7], className: "desktop" },
                { targets:[0], className: "tablet, mobile" }
            ]
            });
        });

        function acceptRequest(ReqNo, ReqType)
        {
            if(ReqType == "own")
            {  
                swal({
                    title: "Are you sure to approve this request number #"+ ReqNo +", Company transfer to requester? ", 
                    text: "You are about to transfer a company ownership to a new user",
                    icon: "warning",
                    buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                    ],
                    dangerMode: true,

                }).then(function(isConfirm) {

                    if (isConfirm) {
                    swal({
                        title: 'Click OK to confirm request approval',
                        text:  '',
                        icon:  'success'
                    }).then(function() {

                        formData = new FormData();
                        formData.append("reqId", ReqNo);
                        formData.append("reqType", ReqType);
                            $.ajax({
                                url: "{{ route('adminApproveCompanyReq') }}",
                                type: "POST",
                                data: formData,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                processData: false,
                                contentType: false,

                                success: function (data) {
                                    document.location = '{{ url("/req-list") }}';
                                }
                            });
                    

                    });
                    } else {
                    swal("Cancelled", "Request to transfer a company to another user was cancelled :)", "error");
                    }
                });
            }  

            if(ReqType == "remove")
            {  
                swal({
                    title: "Are you sure to approve this request number #"+ ReqNo +", Company removal from Prokakis system? ", 
                    text: "You are about to deactivate a company in Prokakis",
                    icon: "warning",
                    buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                    ],
                    dangerMode: true,

                }).then(function(isConfirm) {

                    if (isConfirm) {
                    swal({
                        title: 'Click OK to confirm request approval',
                        text:  '',
                        icon:  'success'
                    }).then(function() {

                        formData = new FormData();
                        formData.append("reqId", ReqNo);
                        formData.append("reqType", ReqType);
                        
                            $.ajax({
                                url: "{{ route('adminApproveCompanyReq') }}",
                                type: "POST",
                                data: formData,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                processData: false,
                                contentType: false,

                                success: function (data) {
                                    document.location = '{{ url("/req-list") }}';
                                }
                            });
                    

                    });
                    } else {
                    swal("Cancelled", "Request to remove a company from Prokakis system user was cancelled :)", "error");
                    }
                });
            } 
        }

        function rejectRequest(ReqNo)
        {
            swal({
                title: "Are you sure to reject this request number #"+ ReqNo +".", 
                text: "You are about to reject a request",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {
                  swal({
                    title: 'Click OK to confirm request rejection',
                    text:  '',
                    icon:  'success'
                  }).then(function() {

                    formData = new FormData();
                    formData.append("reqId", ReqNo);
                        $.ajax({
                            url: "{{ route('adminApproveCompanyReq') }}",
                            type: "POST",
                            data: formData,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            processData: false,
                            contentType: false,

                            success: function (data) {
                                document.location = '{{ url("/req-list") }}';
                            }
                        });
                   

                  });
                } else {
                  swal("Cancelled", "Request to transfer a company to another user was cancelled :)", "error");
                }
              });

        }


    </script>



@endsection