<?php $__env->startSection('content'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('public/css/opporIndex.css')); ?>">

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
                <a href="<?php echo e(url('/home')); ?>">Home</a>
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
                        <form id="opportunity_search" method="POST" action="<?php echo e(route('opportunityStoreNewBuild')); ?>">
                            <?php echo e(csrf_field()); ?>


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
                                        <a href="<?php echo e(url('/opportunity/select')); ?>" class="btn blue"
                                           style="color:white">Add An Opportunity</a>

                                        <a href="<?php echo e(url('/opportunity/chatbox')); ?>" class="btn blue"
                                           style="color:white">View Messages</a>

                            </div>

                        </div>
                        <div class="portlet-body">
                            <div id="container" class="table-scrollable">

                                    <?php if(session('status')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(session('message')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session('message')); ?>

                                    </div>
                                <?php endif; ?>

                                <table id="system_data" class="display hover row-border stripe compact" style="width:100%">
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
                                                <?php if($b->business_goal): ?>
                                                <li> <?php echo e($b->business_goal); ?> </li>
                                                <?php endif; ?>
                                                <?php if($b->ideal_partner_business): ?>
                                                <li> <?php echo e($b->ideal_partner_business); ?> </li>
                                                <?php endif; ?>
                                                <?php if($b->ideal_partner_base): ?>
                                                <li> <?php echo e($b->ideal_partner_base); ?> </li>
                                                <?php endif; ?>
                                            </ul>
                                        </td>
                                        <td> <?php echo $b->timeframe_goal; ?> <br/></td>
                                       

                                        <td> Building Capability <br/>

                                                                        </td>
                                                                        <td class="btn">

                                                                                <a href="<?php echo e(url('/opportunity/editBuild/'.$b->id)); ?>"
                                                                                     class="btn btn-primary"
                                                                                    style="color: white">Edit</a>

                                            <a href="<?php echo e(url('/opportunity/deleteBuild/'.$b->id)); ?>"
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
                                                <?php if($s->what_sell_offer): ?>
                                                <li> <?php echo e($s->what_sell_offer); ?> </li>
                                                <?php endif; ?>
                                                <?php if($s->ideal_partner_business): ?>
                                                <li> <?php echo e($s->ideal_partner_business); ?> </li>
                                                <?php endif; ?>
                                                <?php if($s->ideal_partner_base): ?>
                                                <li><?php echo e($s->ideal_partner_base); ?></li>
                                                <?php endif; ?>
                                            </ul>
                                        </td>
                                        <td> <?php echo $s->timeframe_goal; ?> <br/></td>
                                      

                                        <td>Sell/Offer <br/>

                                            </td>
                                            <td class="btn">

                                                    <a href="<?php echo e(url('/opportunity/editSellOffer/'.$s->id)); ?>"
                                                         class="btn btn-primary" style="color: white">Edit</a>

                                            <a href="<?php echo e(url('/opportunity/deleteSell/'.$s->id)); ?>"
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
                                                <?php if($bb->what_sell_offer): ?>
                                                <li><?php echo e($bb->what_sell_offer); ?></li>
                                                <?php endif; ?>
                                                <?php if($bb->ideal_partner_business): ?>
                                                <li><?php echo e($bb->ideal_partner_business); ?></li>
                                                <?php endif; ?>
                                                <?php if($bb->ideal_partner_base): ?>
                                                <li><?php echo e($bb->ideal_partner_base); ?></li>
                                                <?php endif; ?>
                                            </ul>
                                        </td>
                                        <td> <?php echo $bb->timeframe_goal; ?> <br/></td>
                                        

                                        <td>Buy <br/>

                                                        </td>
                                                        <td class="btn">
                                            <a href="<?php echo e(url('/opportunity/editBuy/'.$bb->id)); ?>" 
                                                                    class="btn btn-primary" style="color: white">Edit</a>

                                            <a href="<?php echo e(url('/opportunity/deleteBuy/'.$bb->id)); ?>"
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
    
    <script src="<?php echo e(asset('public/sweet-alert/sweetalert.min.js')); ?>"></script>

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
                            url: "<?php echo e(route('opportunityPrivacyOption')); ?>",
                            type: "POST",
                            data: formData,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            processData: false,
                            contentType: false,

                            success: function (data) {
                                document.location = "<?php echo e(route('opportunityIndex')); ?>"
                            }
                        });

                  });
                } else {
                  swal("Cancelled", "Privacy option to the opportunity was cancelled :)", "error");
                }
              })

        }


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>