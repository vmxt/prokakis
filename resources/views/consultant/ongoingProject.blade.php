@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

   <style>

         /* Outer */
    .popup {
        width:100%;
        height:100%;
        display:none;
        position:fixed;
        top:0px;
        left:0px;
        background:rgba(0,0,0,0.75);
    }

            /* Inner */
    .popup-inner {
        max-width:700px;
        width:90%;
        padding:40px;
        position:absolute;
        top:50%;
        left:50%;
        -webkit-transform:translate(-50%, -50%);
        transform:translate(-50%, -50%);
        box-shadow:0px 2px 6px rgba(0,0,0,1);
        border-radius:3px;
        background:#fff;
    }

    /* Close Button */
    .popup-close {
        width:30px;
        height:30px;
        padding-top:4px;
        display:inline-block;
        position:absolute;
        top:25px;
        left:0px;
        transition:ease 0.25s all;
        -webkit-transform:translate(50%, -50%);
        transform:translate(50%, -50%);
        border-radius:1000px;
        background:rgba(0,0,0,0.8);
        font-family:Arial, Sans-Serif;
        font-size:20px;
        text-align:center;
        line-height:100%;
        color:#fff;
    }

    .popup-close:hover {
        -webkit-transform:translate(50%, -50%) rotate(180deg);
        transform:translate(50%, -50%) rotate(180deg);
        background:rgba(0,0,0,1);
        text-decoration:none;
    }
    </style>

    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/homeSubConsul') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ url('/consultants/pending-projects') }}">On-Going Projects</a>
            </li>
        </ul>
        <div class="row justify-content-center">

            <div class="col-md-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb font-blue"></i>
                                <span class="caption-subject font-blue sbold uppercase">List of On-going Projects</span>

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
                            <div class="table-scrollable">
                                <table id="system_data" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="10%"># Project Id</th>
                                        <th width="20%"> Project Name</th>
                                        <th width="10%">Start Date</th>
                                        <th width="10%">Due Date</th>
                                        <th width="20%">Requested By Company</th>
                                        <th width="20%">Company Provider</th>
                                        <th width="10%">Search On</th>
                                        <th width="10%">Progress %</th>
                                        <th width="5%">Upload Report</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(count((array)$rs) - 1 > 0){

                                    foreach($rs as $d){
                                     ?>
                                    <tr>
                                        <form action="{{ route('updateOngoingProjectSC') }}" method="POST" enctype="multipart/form-data" id="form_<?php echo $d->id; ?>">

                                           {{ csrf_field() }}
                                           <input type="hidden" name="project_id" value="<?php echo $d->id; ?>">

                                            <td align="center"><?php echo $d->id; ?></td>
                                            <td align="center">
                                                <?php
                                                echo App\RequestReport::getProjectName($d->request_id);
                                                ?>
                                            </td>
                                            <td align="center"><?php echo $d->start_date; ?></td>
                                            <td align="center"><?php echo $d->due_date; ?></td>
                                            <td align="center">
                                                <?php
                                                //echo "company_requester_id". $d->company_requester_id; exit;
                                                $usr = App\User::find($d->company_requester_id);

                                                //echo "usr->id: ".$usr->id; exit;

                                                //$company_id_result = App\CompanyProfile::getCompanyId($usr->id);


                                                if(count((array)$usr) - 1 > 0){
                                                  echo '<a data-popup-open="popup-1" onclick="openTR_requester(\''.$company_id_result.'\', \''.$d->request_id.'\');">'.$usr->firstname.' '.$usr->lastname.'</a>';
                                                }
                                                ?>
                                            </td>

                                            <td align="center">
                                                    <?php
                                                    $usr = App\User::find($d->company_source_id);
                                                    $company_id_result = App\CompanyProfile::getCompanyId($usr->id);
                                                    if(count((array)$usr) - 1 > 0)
                                                    { ?>
                                                     <a href="{{ url('/profile/viewer/'.$company_id_result) }}" target="_blank" onclick="return confirm('Are you sure to open the company profile in another page?')"><?php echo $usr->firstname.' '.$usr->lastname; ?></a>
                                                   <?php }
                                                    ?>
                                                </td>

                                            <td align="center"><?php echo $d->search_on; ?></td>

                                            <td align="center">
                                             <input type="text" style="width:100px;" name="project_progress<?php echo $d->id; ?>" value="<?php echo (isset($d->progress))?  $d->progress : 0; ?>">
                                            </td>

                                            <td align="center">
                                                <input type="file" name="reportUpload<?php echo $d->id; ?>" id="reportUpload<?php echo $d->id; ?>" style="width:100px;">
                                                <br />
                                                <?php
                                                 $ff = explode(",", $d->remarks);
                                                 echo 'File uploaded on:';
                                                 foreach($ff as $f){
                                                    $ext = explode(":", $f);
                                                    if(isset($ext[1])) {
                                                      $upImg =  App\UploadImages::find($ext[1]);
                                                      if(count((array)$upImg) - 1 > 0){
                                                    ?>
                                                    <a target="_blank" href="{{ url('/public/consultantproject/'.$upImg->file_name) }}"><?php echo $ext[0].']'; ?> </a><br /><br />
                                                    <?php
                                                      }
                                                    }
                                                 }
                                                ?>
                                            </td>

                                            <td align="center">

                                              <input type="submit" class="btn btn-success" value="UPDATE">

                                            </td>

                                        </form>
                                    </tr>
                                    <?php

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



        <div class="popup" data-popup="popup-1">
                <div class="popup-inner" style="overflow: scroll; height:850px; width:900px;">
                    <div id="requester_result"></div>
                    <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                </div>
     </div>



     <div class="popup" data-popup="popup-2">
            <div class="popup-inner" style="overflow: scroll; height:850px; width:900px;">
                <div id="provider_result"></div>
                <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
            </div>
 </div>



    <script src="{{ asset('public/js/app.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#system_data').DataTable();

        });
              //----- OPEN
              $('[data-popup-open]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-open');
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                e.preventDefault();
            });

            //----- CLOSE
            $('[data-popup-close]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-close');
                $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                e.preventDefault();
            });

        });


        function openTR_requester(tor, vic){

            formData= new FormData();
            formData.append("requester_id", tor);
            formData.append("request_id", vic);

             $.ajax({
              url: "{{ route('getRequesterInformation') }}",
              type: "POST",
              data: formData,
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              processData: false,
              contentType: false,

              success: function(data){
                $("#requester_result").html(data);
              }
            });
        }

    </script>

@endsection
