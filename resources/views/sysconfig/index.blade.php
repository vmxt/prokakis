@extends('layouts.app-profile-edit')

@section('content')

    <style>
        #edit_icon {
            cursor: pointer;
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

        table {
            table-layout:fixed;
        }
        table td {
            word-wrap: break-word;
            max-width: 400px;
        }
        #system_data td {
            white-space:inherit;
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

    </style>

    <script src="{{ asset('public/js/app.js') }}"></script>

    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Prokakis</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Settings
        </li>

    </ul>

    <div class="row justify-content-center">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-blue"></i>
                    <span class="caption-subject font-blue sbold uppercase">Configurations Variables</span>
                </div>
            </div>
            <div id="container" class="table-scrollable">
                <table id="system_data" class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Description</th>
                        <th>Value</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach($rs as $data){
                    $js = json_encode($data->json_value, true);
                    ?>
                    <tr>
                        <td><?php echo $data->id; ?></td>
                        <td id="tdDesc<?php echo $data->id; ?>" class="wrap"><?php echo $data->description; ?></td>
                        <td id="tdJson<?php echo $data->id; ?>"><?php echo $data->json_value; ?> </td>
                        <td>
                            <a id="edit_icon"  onclick="ajxProcess('<?php echo $data->id; ?>','<?php echo $data->description; ?>')"
                               data-popup-open="popup-1" class="btn btn-outline btn-circle btn-sm blue">
                                <i class="fa fa-edit"></i> Edit </a>
                        </td>


                    </tr>
                    <?php } ?>
                    </tbody>
                 
                </table>

            </div>
        </div>
    </div>




    <div class="popup" data-popup="popup-1">
        <div class="popup-inner">

            <h2><input type="text" id="config_desc"/></h2>
            <input type="hidden" name="configID" id="configID" value="">
            <p>
                <textarea rows="5" cols="20" class="form-control" name="config_json" id="config_json"></textarea>

            </p>
            <p>
                <button align="right" id="ajxUpdate" type="button" class="btn btn-outline-primary">Update</button>
            </p>

            <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->
            <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
        </div>
    </div>


<link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
<script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

<script>
$(document).ready( function () {
    $('#system_data').DataTable();
    $(".popup").hide();
} );


function ajxProcess(cId, codeName){
 //alert(cId); 
   swal("You are about to edit system configuration for '"+codeName+"' !", "", "success");
   

            $("#configID").val(cId);
            var d = $("#tdDesc" + cId).text();
            var j = $("#tdJson" + cId).text();
            $("#config_desc").val(d);
            $("#config_json").text(j);

        }

        $("#ajxUpdate").click(function () {
            var idc = $("#configID").val();
            var desc = $("#config_desc").val();
            var jsonV = $("#config_json").val();

            formData = new FormData();
            formData.append("config_id", idc);
            formData.append("config_desc", desc);
            formData.append("config_json", jsonV);

            $.ajax({
                url: "{{ route('sysUpdate') }}",
                type: "POST",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,

                success: function (data) {
                    $("#tdDesc" + idc).text(desc);
                    $("#tdJson" + idc).text(jsonV);
                    $(".popup").hide(250);
                    document.location = "{{ route('sysIndex') }}"
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

    </script>

@endsection