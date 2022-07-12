@extends('layouts.app')



@section('content')

    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <style>



@media only screen and (max-width: 600px) {

  li {

    font-size: 14.4px;

  }

}



@media only screen and (max-width: 430px) {

  .span6 {

    float: none;

    width: 100%;

  }

  body {

    padding-top: 0;

  }

  ul {

    height: auto;

    position: static;

  }

  li {

    display: block;

    width: 100%;

  }

  li a {

    white-space: normal;

  }

  a.active:after {

    display: none;

  }

}



        /* Outer */

        .popup {

            width: 100%;

            height: 100%;

            display: none;

            position: fixed;

            top: 0px;

            left: 0px;

            background: rgba(0, 0, 0, 0.75);

        }



        .btn-x3 {

            font-size: 15px;

            border-radius: 5px;

            width: 25%;

            background-color: orangered;

        }



           /* Inner */

           .popup-inner {

            max-width: 700px;

            width: 90%;

            padding: 40px;

            position: absolute;

            top: 50%;

            left: 50%;

            -webkit-transform: translate(-50%, -50%);

            transform: translate(-50%, -50%);

            box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);

            border-radius: 3px;

            background: #fff;

        }



        /* Close Button */

        .popup-close {

            width: 30px;

            height: 30px;

            padding-top: 4px;

            display: inline-block;

            position: absolute;

            top: 0px;

            right: 0px;

            transition: ease 0.25s all;

            -webkit-transform: translate(50%, -50%);

            transform: translate(50%, -50%);

            border-radius: 1000px;

            background: rgba(0, 0, 0, 0.8);

            font-family: Arial, Sans-Serif;

            font-size: 20px;

            text-align: center;

            line-height: 100%;

            color: #fff;

        }



        .popup-close:hover {

            -webkit-transform: translate(50%, -50%) rotate(180deg);

            transform: translate(50%, -50%) rotate(180deg);

            background: rgba(0, 0, 0, 1);

            text-decoration: none;

        }



        .chart {

  position: relative;

  display: inline-block;

  width: 110px;

  height: 110px;

  margin-top: 5px;

  margin-bottom: 5px;

  text-align: center;

}





        .chart canvas {

  position: absolute;

  top: 0;

  left: 0;

}

.percent {

  display: inline-block;

  line-height: 110px;

  z-index: 2;
  font-weight:bold;

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

 
    .cardborder-radius{
        border-radius: 20px !important;
        border: 1px solid #a5a5a5; ;
    }
    
     .cardborder-radius:hover{
        box-shadow:  0 8px 16px 0 rgb(187 187 187) !important;

    </style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

    <div class="container">

        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

            <li>

                <a href="{{ url('/homeSubConsul') }}">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="{{ route('projectOverviewMC') }}">Project Overview</a>

            </li>

        </ul>

        <div class="row justify-content-center">



            <div class="col-md-12">



                    <div class="portlet light ">

                        <div class="portlet-title">

                            <div class="caption">

                                <i class="icon-notebook"></i>

                                <span class="caption-subject  sbold uppercase">Project Overview</span>



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

                                <table id="project_table" class="table pure-table pure-table-horizontal pure-table-striped">

                                        <thead>

                                                <tr>

                                                    <th >No</th>

                                                    <th>Project Name</th>

                                                    <th class="fit">Due Date</th>

                                                    <th class="fit">Assigned Consultant</th>

                                                    <th >Progress</th>

                                                    <th>Status</th>

                                                    <th>View Report</th>

                                                </tr>

                                        </thead>

                                                <tbody>



                                                <?php

            
                                                 if( count((array)$rs) > 0 ){



                                                 $i = 1;

                                                 foreach($rs as $d){



                                                    $cp = App\ConsultantProjects::where('request_approval_id', $d->id)->first();

                                                    if(count((array)$cp) > 0){



                                                ?>

                                                    <tr class="">

                                                    <td  ><?php echo $i; ?></td>

                                                    <td >

                                                        <?php

                                                            echo App\RequestReport::getProjectName2($cp->request_id);

                                                        ?>

                                                    </td>

                                                    <td >

                                                      <span id="dueDate<?php echo $cp->id; ?>">

                                                          <a href="#" data-popup-open="popup-1" onclick="updateDueDate('<?php echo $cp->due_date; ?>','<?php echo $cp->id; ?>');"><?php echo $cp->due_date; ?></a>

                                                      </span>

                                                    </td>

                                                    <td >

                                                        <?php

                                                            $usr = App\User::find($cp->assigned_consultant_id);

                                                            if(count((array)$usr) > 0){

                                                               echo $usr->firstname.' '.$usr->lastname;

                                                            }

                                                        ?>

                                                    </td>

                                                    <td >



                                                    <span class="chart" data-percent="<?php echo $cp->progress; ?>">

                                                        <span class="percent"></span>

                                                    </span>





                                                    </td>



                                                    <td ><?php

                                                        if(is_numeric($cp->project_status))

                                                        {

                                                           echo $cp->project_status."0%";

                                                        } else{

                                                           echo $cp->project_status;

                                                        }

                                                     ?></td>



                                                    <td ><a>

                                                        <?php

                                                        $ff = explode(",", $cp->remarks);

                                                        echo 'File uploaded on: <br />';

                                                        foreach($ff as $f){

                                                           $ext = explode(":", $f);

                                                           if(isset($ext[1])) {

                                                             $upImg =  App\UploadImages::find($ext[1]);

                                                             if($upImg){

                                                           ?>

                                                           <a target="_blank" href="{{ url('/public/consultantproject/'.$upImg->file_name) }}"><?php echo $ext[0].']'; ?> </a><br />

                                                           <?php

                                                             }

                                                           }

                                                        }

                                                       ?>

                                                    </td>

                                                    </tr>

                                                <?php

                                                     } else {

                                                ?>



                                                 <tr>
                                                     
                                                    <td  ><?php echo $i; ?></td>
                                                    
                                                    <form action="{{ route('saveProjectMC') }}" method="POST">

                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="request_approval_id" value="<?php echo (isset($d->id))? $d->id : 0; ?>">

                                                    <input type="hidden" name="request_id" value="<?php echo (isset($d->req_rep_id))? $d->req_rep_id : 0; ?>">

                                                    <input type="hidden" name="form_id" value="<?php echo $i; ?>">
                                                    
                                                    <td >

                                                    <?php



                                                        $req = App\RequestReport::find($d->req_rep_id);

                                                        if(  $req->count() > 0 ){

                                                        echo $req->company_name;

                                                        }

                                                    ?>

                                                    </td>

                                                    <td class="fit" > <input type="text" style="min-width:100px !important" class="form-control datepicker" placeholder="select date" name="due_date<?php echo $i; ?>"></td>

                                                    <td >

                                                        <?php

                                                          if(sizeof($subsConsultants) > 0){

                                                        ?>
                                                        
                                                        <select class="form-control" name="assignedConsultants" id="assignedConsultants">

                                                              <!--  <option value="<?php //echo $subsConsultants[0]->MainConsultantID ?>"><?php //echo $subsConsultants[0]->MainConsultant.' '.$subsConsultants[0]->MainConsultantLastname; ?></option> -->

                                                                <option value="<?php echo $subsConsultants[0]->Sub1ConsultantID ?>"><?php echo $subsConsultants[0]->Sub1Consultant.' '.$subsConsultants[0]->Sub1ConsultantLastname; ?></option>

                                                                <option value="<?php echo $subsConsultants[0]->Sub2ConsultantID ?>"><?php echo $subsConsultants[0]->Sub2Consultant.' '.$subsConsultants[0]->Sub2ConsultantLastname; ?></option>

                                                         </select>
                                                        <input type="submit" value="save" class="btn btn-primary " style="float:right;margin-top:5px">
                                                         <?php }  ?>

                                                    </td>

                                                    <td >

                                                       0%

                                                    </td>

                                                    <td> </td>

                                                    <td ><a>View Report</a></td>

                                                    </form>

                                                 </tr>



                                                <?php

                                                     }



                                                     $i++;



                                                    } //loop of accepted projects

                                                 }

                                                ?>





                                                </tbody>

                                </table>

                            </div>

                        </div>





                </div>



        </div>







    <div class="popup" data-popup="popup-1">

            <div class="popup-inner">

                    <input type="hidden" name="projectID" id="projectID" value="">

                    <div class="form-group">

                            <label for="dob">Enter Due Date</label>

                            <input type="text" id="dueDateField" name="dueDateField" class="datepicker" />

                    </div>



                <p>

                    <button align="right" id="ajxUpdate" type="button" class="btn bg-dark text-white btn-primary">Update</button>

                </p>



                <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->

                <a class="popup-close" data-popup-close="popup-1" href="#">x</a>

            </div>

        </div>





    <script src="{{ asset('public/js-tabs/jquery-1.12.4.js') }}"></script>

    <script src="{{ asset('public/js-tabs/jquery-ui.js') }}"></script>



    <!-- <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>

  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    -->

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

  <script src="{{ asset('public/dist-easypiechart/jquery.easypiechart.min.js') }}"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>



        $(document).ready(function () {
            
            $('#project_table').DataTable({
                responsive: true,
                columnDefs: [ 
                    { targets:"_all", orderable: false },
                    { targets:[0,1,2,3,4,5,6], className: "desktop" },
                    { targets:[0,1], className: "tablet, mobile" }
                ],
                "ordering": false,
                "drawCallback": function( settings ) {
                    $('.chart').easyPieChart({

              easing: 'easeOutBounce',
        
              onStep: function(from, to, percent) {
        
                $(this.el).find('.percent').text(Math.round(percent)+"%");
        
              },
              barColor: "#7cda24"
        
            });
            
            $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
                },
                
                
            });

            $(".popup").hide();
            
            $('body').on('click', '#project_table > tbody > tr > td:first-child', function (){
                
                $(".chart").easyPieChart({

              easing: 'easeOutBounce',
        
              onStep: function(from, to, percent) {
        
                $(this.el).find('.percent').text(Math.round(percent)+"%");
        
              },
              barColor: "#7cda24"
        
            });
            });

       });



        $(function() {

            $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

        });



        function updateDueDate(strDate, pId)

        {

         $("#projectID").val(pId);

         $("#dueDateField").val(strDate);

        }



        $("#ajxUpdate").click(function () {

            var id_project = $("#projectID").val();

            var new_dd = $("#dueDateField").val();



            formData = new FormData();

            formData.append("projectId", id_project);

            formData.append("newDueDate", new_dd);



            $.ajax({

                url: "{{ route('updateDuedateMC') }}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,



                success: function (data) {

                    //$("#dueDate" + id_project).innerHTML = '';

                    $("#dueDate"+id_project).innerHTML = data;

                    $(".popup").hide(250);

                    document.location = "{{ route('projectOverviewMC') }}"



                }

            });



        });



        //----- OPEN

        $('[data-popup-open]').on('click', function (e) {

            var targeted_popup_class = jQuery(this).attr('data-popup-open');

            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);



            e.preventDefault();

        });



        //----- CLOSE

        $('[data-popup-close]').on('click', function (e) {

            var targeted_popup_class = jQuery(this).attr('data-popup-close');

            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);



            e.preventDefault();

        });





        $(function() {

    $('.chart').easyPieChart({

      easing: 'easeOutBounce',

      onStep: function(from, to, percent) {

        $(this.el).find('.percent').text(Math.round(percent)+"%");

      }

    });

    var chart = window.chart = $('.chart').data('easyPieChart');

    $('.js_update').on('click', function() {

      chart.update(Math.random()*200-100);

    });

  });



    </script>



@endsection

