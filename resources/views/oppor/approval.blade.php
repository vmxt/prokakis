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

.table-fill {
  border-radius:3px;
  border-collapse: collapse;
  margin: auto;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color: #7cda24 !important;
  background:black !important;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-weight: 100;
  padding:24px;
  text-align:center !important;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
  text-transform:uppercase;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:black !important;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  padding:10px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}

td:first-child, th:first-child {
  display:none;
}

    </style>
    
    <link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Opportunities</span>
            </li>
        </ul>
        <div class="row justify-content-center">
            <!--
            <div class="col-md-2">
                <div class="portlet light">
                    <div class="portlet-body light">
                    <div class="card">
                        <form id="opportunity_search" method="POST" action="{{ route('opportunityStoreNewBuild') }}">
                            {{ csrf_field() }}

                                <div class="form-group">
                                    <label> Industry Type</label>
                                    <select class="form-control" name="industry" id="industry">
                                        <option> Please select one from below</option>
                                        <?php foreach($industry as $key => $value){
                                        ?>
                                        <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label> Business Type</label>
                                    <select class="form-control" name="businessType" id="businessType">
                                        <option> Please select one from below</option>
                                        <?php foreach($businessType as $key => $value){
                                        ?>
                                        <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                                <button type="button" class="btn btn blue" id="searchMyOpportunity">Search</button>

                        </form>
                    </div>
                </div>
                </div>
            </div> -->

            <div class="col-md-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb font-blue"></i>
                                <span class="caption-subject font-blue sbold uppercase">List of {{ $status }} opportunities</span>
                            </div>

                        </div>
                        <div class="portlet-body">
                            <div id="container" class="table-scrollable" style="padding:10px">

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

                                <table id="system_data" class="display hover row-border stripe compact responsive" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="20%">Title</th>
                                        <th>User</th>
                                        <th>Seeking</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $counter = 1;
                                    if(count((array)$build) > 0){
                                    foreach($build as $b){  ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><p> <?php echo $b->opp_title; ?></p></td>
                                        <td><p> @if($b->company_id != "") {{ App\CompanyProfile::find($b->company_id)->userdetail()->first()->email }} @endif </p></td>
                                        <td>
                                            <ul style="list-style-type: none;">
                                                @if($b->business_goal)
                                                <li> {{ $b->business_goal }} </li>
                                                @endif
                                                @if($b->ideal_partner_business)
                                                <li> {{ $b->ideal_partner_business }} </li>
                                                @endif
                                                @if($b->ideal_partner_base)
                                                <li> {{ $b->ideal_partner_base }} </li>
                                                @endif
                                            </ul>
                                        </td>
                                       

                                        <td> Building Capability <br/>

                                                                        </td>
                                                                        <td class="btn-group">
                                                                            
                                                                            <?php 
                                                    if($status == "pending"){ ?>
                                                       <a href="{{ url('/opportunity/approvedOpportunity/'.$s->id .':build') }}"
                                                         class="btn btn-info" style="color: white"
                                                         
                                                         onclick="return confirm('Are you sure you want to approve this opportunity item?')"
                                                         
                                                         >Approve</a> 
                                                <?php }
                                                ?>

                                                                                <a href="{{ url('/opportunity/editApprovalBuild/'.$b->id) }}"
                                                                                     class="btn btn-primary"
                                                                                    style="color: white">Edit</a>

                                            <a href="{{ url('/opportunity/deleteBuild/'.$b->id.':'.$status) }}"
                                                                            class="btn btn-danger" onclick="return confirm('Are you sure to delete an opportunity item?')"
                                                                            style="color: white">Delete</a>

                                       

                                        </td>
                                    </tr>

                                    <?php
                                    $counter++;
                                    }

                                    } ?>

                                    <?php
                                    if(count((array)$sell) > 0){
                                    foreach($sell as $s){  ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td> <?php echo $s->opp_title; ?></td>
                                        <td><p> @if($s->company_id != "") {{ App\CompanyProfile::find($s->company_id)->userdetail()->first()->email }} @endif </p></td>
                                   
                                        <td>
                                            <ul>
                                                @if($s->what_sell_offer)
                                                <li> {{ $s->what_sell_offer }} </li>
                                                @endif
                                                @if($s->ideal_partner_business)
                                                <li> {{ $s->ideal_partner_business }} </li>
                                                @endif
                                                @if($s->ideal_partner_base)
                                                <li>{{ $s->ideal_partner_base }}</li>
                                                @endif
                                            </ul>
                                        </td>
                                      

                                        <td>Sell/Offer <br/>

                                            </td>
                                            <td class="btn-group">
                                                
                                                <?php 
                                                    if($status == "pending"){ ?>
                                                       <a href="{{ url('/opportunity/approvedOpportunity/'.$s->id .':sell') }}"
                                                         class="btn btn-info" style="color: white"
                                                         
                                                         onclick="return confirm('Are you sure you want to approve this opportunity item?')"
                                                         
                                                         >Approve</a> 
                                                <?php }
                                                ?>

                                                    <a href="{{ url('/opportunity/editApprovalSellOffer/'.$s->id) }}"
                                                         class="btn btn-primary" style="color: white">Edit</a>

                                            <a href="{{ url('/opportunity/deleteSell/'.$s->id.':'.$status) }}"
                                                     class="btn btn-danger" onclick="return confirm('Are you sure to delete an opportunity item?')"
                                                    style="color: white">Delete</a>


                                            </td>
                                    </tr>

                                    <?php
                                    $counter++;
                                    }

                                    } ?>

                                    <?php
                                    if(count((array)$buy) > 0){
                                    foreach($buy as $bb){  ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td> <?php echo $bb->opp_title; ?></td>
                                        <td><p> @if($bb->company_id != "") {{ App\CompanyProfile::find($bb->company_id)->userdetail()->first()->email }} @endif </p></td>
                                        <td>
                                            <ul>
                                                @if($bb->what_sell_offer)
                                                <li>{{ $bb->what_sell_offer }}</li>
                                                @endif
                                                @if($bb->ideal_partner_business)
                                                <li>{{ $bb->ideal_partner_business }}</li>
                                                @endif
                                                @if($bb->ideal_partner_base)
                                                <li>{{ $bb->ideal_partner_base }}</li>
                                                @endif
                                            </ul>
                                        </td>
                                        

                                        <td>Buy <br/>

                                                        </td>
                                                        <td class="btn-group">
                                                            
                                                            <?php 
                                                    if($status == "pending"){ ?>
                                                       <a  href="{{ url('/opportunity/approvedOpportunity/'.$s->id .':buy') }}"
                                                         class="btn btn-info" style="color: white"
                                                         
                                                         onclick="return confirm('Are you sure you want to approve this opportunity item?')"
                                                         
                                                         >Approve</a> 
                                                <?php }
                                                ?>
                                                            
                                            <a href="{{ url('/opportunity/editApprovalBuy/'.$bb->id) }}" 
                                                                    class="btn btn-primary" style="color: white">Edit</a>

                                            <a href="{{ url('/opportunity/deleteBuy/'.$bb->id.':'.$status) }}"
                                                             class="btn btn-danger" onclick="return confirm('Are you sure to delete an opportunity item?')"
                                                            style="color: white">Delete</a>


                                        </td>
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
    {{-- <script src="{{ asset('public/js/app.js') }}"></script> --}}
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                { targets:"_all", orderable: false },
                { targets:[0,1,2,3,4,5], className: "desktop" },
                { targets:[0,1], className: "tablet, mobile" }
            ]
            });
            $(".popup").hide();

           if($('.popup-1').modal('show') == true){
               alert('sdfsd');
           }

            $("#closeBut1").click(function () {
                $('#edit_news').dialog('close');
            });

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

        function privacyOption(str, ptype, idx)
        {

            swal({
                title: "Are you sure?",
                text: "You are about to set the privacy option of this opportunity with company information!",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {
                  swal({
                    title: 'With Company Information',
                    text: 'Done on setting privacy option!',
                    icon: 'success'
                  }).then(function() {
                    //form.submit(); // <--- submit form programmatically

                    formData = new FormData();
                    formData.append("oppor_type", str);
                    formData.append("privacy_type", ptype);
                    formData.append("id", idx);

                        $.ajax({
                            url: "{{ route('opportunityPrivacyOption') }}",
                            type: "POST",
                            data: formData,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            processData: false,
                            contentType: false,

                            success: function (data) {
                                document.location = "{{ route('opportunityIndex') }}"
                            }
                        });

                  });
                } else {
                  swal("Cancelled", "Privacy option to the opportunity was cancelled :)", "error");
                }
              })

        }


    </script>

@endsection
