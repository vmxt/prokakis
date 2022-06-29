@extends('layouts.app')

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
        
    


/*** Table Styles **/

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
  font-size:16px;
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
  font-size:18px;
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



    </style>

    <script src="{{ asset('public/js/app.js') }}"></script>
    
    <link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css'>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Intellinz</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Opportunity Details
        </li>

    </ul>

    <div class="row justify-content-center">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-blue"></i>
                    <span class="caption-subject font-blue sbold uppercase">Opportunity Details</span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="container" class="table-scrollable" style="padding:15px">
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
                                
                        <table id="system_data" class=" table ">
                            <thead>
                            <tr>
                                <th >Id</th>
                                <th >Opportunity Title</th>
                                <th >Type</th>
                                <th >Company Email</th>
                                <th >User Name</th>
                                <th >User Email</th>
        
                            </tr>
                            </thead>
                            <tbody class="table-hover">
                                @foreach($result as $data)
                                <tr>
                                    <td class="wrap"> {{ $data->opp_id }} </td>
                                    <td class="wrap"> {{ $data->opp_title }} </td>
                                    <td> {{ $data->opp_type }} </td>
                                    <td> {{ $data->company_email }} </td>
                                    <td> {{ $data->last_name.", ".$data->first_name }} </td>
                                    <td> {{ $data->user_email }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                         
                        </table>
        
                    </div>
                </div>
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


 <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

<script>
$(document).ready( function () {
    $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                { targets:"_all", orderable: false },
                { targets:[0,1,2,3,4,5], className: "desktop" },
                { targets:[0, 1], className: "tablet, mobile" }
            ]
            });
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