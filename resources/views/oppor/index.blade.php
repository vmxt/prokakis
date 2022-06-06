@extends('layouts.app')

@section('content')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">

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
 .cardborder-radius{
        border-radius: 20px !important;
        border: 1px solid #a5a5a5; ;
    }
    
     .cardborder-radius:hover{
        box-shadow:  0 8px 16px 0 rgb(187 187 187) !important;
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

                    <div id="list_div" class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb "></i>
                                <span class="caption-subject  sbold uppercase">List of your submitted opportunities</span>
                            </div>

                            <div class="actions">
                                        <a href="{{ url('/opportunity/select') }}" class="add_opp_btn btn blue"
                                           style="color:white">Add An Opportunity</a>

                                        <a href="{{ url('/opportunity/chatbox') }}" class="message_btn btn blue"
                                           style="color:white">View Messages</a>

                            </div>

                        </div>
                        <div class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">
                            <div id="container" style="border:none !important" class="table_div table-scrollable">

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
    
                                <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Seeking</th>
                                        <th>Expectations</th>
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
                                        <td>
                                            <ul>
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
                                        <td> <?php echo $b->timeframe_goal; ?> <br/></td>
                                       

                                        <td> Building Capability <br/>

                                                                        </td>
                                                                        <td class="btn">

                                                                                <a href="{{ url('/opportunity/editBuild/'.$b->id) }}"
                                                                                     class="btn btn-primary"
                                                                                    style="color: white">Edit</a>

                                            <a href="{{ url('/opportunity/deleteBuild/'.$b->id) }}"
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
                                        <td> <?php echo $s->timeframe_goal; ?> <br/></td>
                                      

                                        <td>Sell/Offer <br/>

                                            </td>
                                            <td class="btn">

                                                    <a href="{{ url('/opportunity/editSellOffer/'.$s->id) }}"
                                                         class="btn btn-primary" style="color: white">Edit</a>

                                            <a href="{{ url('/opportunity/deleteSell/'.$s->id) }}"
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
                                        <td> <?php echo $bb->timeframe_goal; ?> <br/></td>
                                        

                                        <td>Buy <br/>

                                                        </td>
                                                        <td class="btn">
                                            <a href="{{ url('/opportunity/editBuy/'.$bb->id) }}" 
                                                                    class="btn btn-primary" style="color: white">Edit</a>

                                            <a href="{{ url('/opportunity/deleteBuy/'.$bb->id) }}"
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
        </div>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{-- <script src="{{ asset('public/js/app.js') }}"></script> --}}
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
    
    <script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>

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
            
            var tour = new Tour({
              steps: [
              {
                element: "#list_div",
                title: "LIST OF YOUR OPPORTUNITIES",
                content: "This is the list of your opportunities added",
                placement: "top"
              },
              {
                element: ".add_opp_btn",
                title: "ADD OPPORTUNITY BUTTON",
                content: "This is the button to add new opportunity",
                placement: "top"
              },
              {
                element: ".message_btn",
                title: "MESSAGE BUTTON",
                content: "This is the button that will redirect you to the message box page",
                placement: "top"
              },
              {
                element: ".table_div",
                title: "OPPORTUNITY TABLE",
                content: "This is the table containing the list of your opportunities",
                placement: "top"
              },
              {
                element: "a.btn-primary:first",
                title: "EDIT BUTTON",
                content: "This is the button that will redirect you to the opportunity edit page",
                placement: "top"
              },
              {
                element: "a.btn-danger:first",
                title: "DELETE BUTTON",
                content: "This is the button that will delete the opportunity",
                placement: "top"
              },
            ],
            
              container: "body",
              smartPlacement: false,
              keyboard: true,
              storage: window.localStorage,
              //storage: false,
              debug: false,
              backdrop: true,
              backdropContainer: 'body',
              backdropPadding: 0,
              redirect: false,
              orphan: true,
              duration: false,
              delay: false,
              basePath: "",
              //placement: 'auto',
               // autoscroll: true,
              afterGetState: function (key, value) {},
              afterSetState: function (key, value) {},
              afterRemoveState: function (key, value) {},
              onStart: function (tour) {},
              onEnd: function (tour) {
                 $('.intro-tour-overlay').hide();
                  $('html').css('overflow','unset')
                 $('.menu-dropdown').removeClass('open');
                 updateTour('end');
              },
              onShow: function (tour) {},
              onShown: function (tour) {},
              onHide: function (tour) {},
              onHidden: function (tour) {},
              onNext: function (tour) {},
              onPrev: function (tour) {},
              onPause: function (tour, duration) {},
              onResume: function (tour, duration) {},
              onRedirectError: function (tour) {}
            
            });
            
            // Clear bootstrap tour session data
            localStorage.removeItem('tour_current_step');
            localStorage.removeItem('tour_end');
            
            // Initialize the tour
            tour.init();
            
            // Start the tour
            if( $('#is_tour').val() == 1 ){
                $('html').css('overflow','visible');
                 $('.intro-tour-overlay').show();
                tour.start();
            }

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
