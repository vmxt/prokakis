<?php $__env->startSection('content'); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/grid/jquery.dataTables.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('public/css/opporIndex.css')); ?>">



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

                <a href="<?php echo e(url('/home')); ?>">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="<?php echo e(route('manageRegsLink')); ?>">Registration Links</a>

            </li>

        </ul>

        <div class="row justify-content-center">



            <div class="col-md-12">



                    <div class="portlet light ">

                            <div class="portlet-title">

                                    <form action="<?php echo e(route('addRegsLink')); ?>" method="POST" style="display: block;" onSubmit="if(!confirm('Are you sure to add a new link?')){return false;}">

                                            <?php echo e(csrf_field()); ?>


                                            <div class="form-group">

                                                    <label> Select A Category </label>

                                            <select style="float:right;"  name="user_type" class="form-control" >

                                                    <option value="0"></option>

                                                  <!--  <option value="1">Company</option> -->

                                                    <option value="2">Assistant Consultant</option>

                                                    <option value="3">Master Consultant</option>

                                                    <option value="4">Ebos Staff</option>

                                                </select>

                                            </div>

                                            <div class="form-group">

                                            <input type="submit" style="float:right;" class="btn btn-primary" value="ADD LINK">

                                            </div>

                                    </form>

                            </div>

                        </div>





                    <div class="portlet light ">

                        <div class="portlet-title">





                            <div class="caption">



                                <i class="icon-share"></i>

                                <span class="caption-subject font-blue sbold uppercase">List of Registration links</span>



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



                            </div>



                        </div>

                        <div class="portlet-body">

                            <div class="table-scrollable">

                                <table id="system_data" class="table table-bordered table-hover">

                                        <thead>

                                                <tr>

                                                    <th>Category</th>

                                                    <th>Link</th>

                                                    <th>Token</th>

                                                    <th>Active</th>

                                                    <th>Created At</th>

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



                                                    <td align="center">

                                                        <?php echo $d->category; ?>

                                                    </td>



                                                    <td align="center">

                                                        <?php echo $d->link; ?>

                                                    </td>



                                                    <td align="center">

                                                            <?php echo $d->token; ?>

                                                        </td>



                                                    <td align="center">

                                                            <?php

                                                            if($d->status == 1){

                                                              echo 'True';

                                                            } else{

                                                              echo 'False';

                                                            }

                                                            ?>

                                                    </td>


                                                    <td align="center">

                                                        <?php

                                                        echo date("F j, Y", strtotime($d->created_at));

                                                        ?>

                                                    </td>



                                                    </tr>





                                                <?php

                                                         $i++;

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





    <script src="<?php echo e(asset('public/js-tabs/jquery-1.12.4.js')); ?>"></script>

    <script src="<?php echo e(asset('public/js-tabs/jquery-ui.js')); ?>"></script>



    <!--<script src="<?php echo e(asset('public/js/app.js')); ?>"></script>-->

    <script type="text/javascript" charset="utf8" src="<?php echo e(asset('public/grid/jquery.dataTables.min.js')); ?>"></script>



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



<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>