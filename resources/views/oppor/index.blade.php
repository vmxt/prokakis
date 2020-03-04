@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">
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
    </style>

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
                                <span class="caption-subject font-blue sbold uppercase">List of your submitted opportunities</span>
                            </div>

                            <div class="actions">
                                        <a href="{{ url('/opportunity/select') }}" class="btn blue"
                                           style="color:white">Add An Opportunity</a>

                            </div>

                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable">

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

                                <table id="system_data" class="table table-hover table-light">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Seeking</th>
                                        <th>Expectations</th>
                                        <th>Title</th>
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
                                        <td>
                                            - <?php echo $b->business_goal; ?> <br/>
                                            - <?php echo $b->ideal_partner_business; ?> <br/>
                                            - <?php echo $b->ideal_partner_base; ?>
                                        </td>
                                        <td> <?php echo $b->timeframe_goal; ?> <br/></td>
                                        <td> <?php echo $b->opp_title; ?></td>

                                        <td> Building Capability <br/>

                                                                        </td>
                                                                        <td class="btn">

                                                                                <a href="{{ url('/opportunity/editBuild/'.$b->id) }}"
                                                                                    target="_blank" class="btn btn-primary"
                                                                                    style="color: white">Edit</a>

                                            <a href="{{ url('/opportunity/deleteBuild/'.$b->id) }}"
                                                                            class="btn btn-danger" onclick="return confirm('Are you sure to delete an opportunity item?')"
                                                                            style="color: white">Delete</a>

                                            <?php if( App\SpentTokens::validateLeftBehindToken($company_id) != false ){
                                             $bWCI = '';
                                             $bKP = '';

                                               if( $b->view_type == 1 ){
                                                $bWCI = '';
                                                $bKP = 'disabled';
                                               } else {
                                                $bWCI = 'disabled';
                                                $bKP = '';
                                               }

                                            ?>
                                            <button <?php echo $bWCI; ?> class="btn default" onclick="privacyOption('build', 'company_info', '<?php echo $b->id; ?>');" style="color: black"><span class="fa fa-credit-card" /></span> With Company Info</button>
                                            <button <?php echo $bKP; ?> class="btn default" onclick="privacyOption('build', 'keep_private', '<?php echo $b->id; ?>')" style="color: black"><span class="fa fa-lock"></span> Keep Private</button>
                                            <?php } ?>

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
                                        <td>
                                            - <?php echo $s->what_sell_offer; ?> <br/>
                                            - <?php echo $s->ideal_partner_business; ?> <br/>
                                            - <?php echo $s->ideal_partner_base; ?>
                                        </td>
                                        <td> <?php echo $s->timeframe_goal; ?> <br/></td>
                                        <td> <?php echo $s->opp_title; ?></td>

                                        <td>Sell/Offer <br/>

                                            </td>
                                            <td class="btn">

                                                    <a href="{{ url('/opportunity/editSellOffer/'.$s->id) }}"
                                                        target="_blank" class="btn btn-primary" style="color: white">Edit</a>

                                            <a href="{{ url('/opportunity/deleteSell/'.$s->id) }}"
                                                     class="btn btn-danger" onclick="return confirm('Are you sure to delete an opportunity item?')"
                                                    style="color: white">Delete</a>

                                            <?php if( App\SpentTokens::validateLeftBehindToken($company_id) != false ){
                                                $sWCI = '';
                                                $sKP = '';

                                                  if( $s->view_type == 1 ){
                                                   $sWCI = '';
                                                   $sKP = 'disabled';
                                                  } else {
                                                   $sWCI = 'disabled';
                                                   $sKP = '';
                                                  }
                                            ?>
                                            <button <?php echo $sWCI; ?> class="btn default" onclick="privacyOption('sell', 'company_info', '<?php echo $s->id; ?>');" style="color: black"><span class="fa fa-credit-card" /></span> With Company Info</button>
                                            <button <?php echo $sKP; ?> class="btn default" onclick="privacyOption('sell', 'keep_private', '<?php echo $s->id; ?>')" style="color: black"><span class="fa fa-lock"></span> Keep Private</button>


                                            <?php } ?>

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
                                        <td>
                                            - <?php echo $bb->what_sell_offer; ?> <br/>
                                            - <?php echo $bb->ideal_partner_business; ?> <br/>
                                            - <?php echo $bb->ideal_partner_base; ?>
                                        </td>
                                        <td> <?php echo $bb->timeframe_goal; ?> <br/></td>
                                        <td> <?php echo $bb->opp_title; ?></td>

                                        <td>Buy <br/>

                                                        </td>
                                                        <td class="btn">
                                            <a href="{{ url('/opportunity/editBuy/'.$bb->id) }}" target="_blank"
                                                                    class="btn btn-primary" style="color: white">Edit</a>

                                            <a href="{{ url('/opportunity/deleteBuy/'.$bb->id) }}"
                                                             class="btn btn-danger" onclick="return confirm('Are you sure to delete an opportunity item?')"
                                                            style="color: white">Delete</a>

                                            <?php if( App\SpentTokens::validateLeftBehindToken($company_id) != false ){
                                                $byWCI = '';
                                                $byKP = '';

                                                  if( $bb->view_type == 1 ){
                                                   $byWCI = '';
                                                   $byKP = 'disabled';
                                                  } else {
                                                   $byWCI = 'disabled';
                                                   $byKP = '';
                                                  }
                                            ?>

                                            <button <?php echo $byWCI; ?> class="btn default" onclick="privacyOption('buy', 'company_info', '<?php echo $bb->id; ?>');" style="color: black"><span class="fa fa-credit-card" /></span> With Company Info</button>
                                            <button <?php echo $byKP; ?> class="btn default" onclick="privacyOption('buy', 'keep_private', '<?php echo $bb->id; ?>')" style="color: black"><span class="fa fa-lock"></span> Keep Private</button>


                                            <?php } ?>

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

    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function () {

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
