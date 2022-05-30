@extends('layouts.app')

@section('content')

<style>
.niceDisplay{
        font-family: 'PT Sans Narrow', sans-serif;
        background-color: white;
        padding: 30px;
        border-radius: 3px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.btn-x3 {
    font-size: 15px;
    border-radius: 5px;
    width: 40%;
    background-color: orangered;
    }

.btn-x4 {
    font-size: 15px;
    border-radius: 5px;
    width: 10%;
    background-color: orangered;
    }
    
    .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: black !important;
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
    }
    
    .text-company{
        color: #7cda24 !important;
    }
</style>


<script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css' />

<div class="container">
    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>INVESTOR ALERT LIST BY</span>
        </li>
    </ul>
    <div class="row justify-content-center">

             <div class="col-md-12">
            
            <div class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">
                    <h4 class="card-title mb-2"><i style="color: #7cda24" class="fa fa-sort">&nbsp;</i>SORT INVESTOR ALERT LIST BY:</h4>
                    <div class="row">
                        <div class="col-md-12 mb-2 ">
                            <div class="form-group">
                                    <select class="form-control" id="type_cb">
                                    <option value="desc">LATEST TO OLDEST</option>
                                    <option value="asc">OLDEST TO LATEST</option>
                                    <!--<option value="date">DATE</option>-->
                                </select>
                            </div>
                        </div>
                        <!--<div class="col-md-2 mb-2 ">
                            <div class="form-group">
                                <button style="" id="filter_search_btn" class="btn btn-dark bg-dark text-white"><i style="color: #7cda24" class="icon-magnifier">&nbsp;</i>SORT</button>
                            </div>
                            
                        </div>-->
                    </div>
                    
                    <h4 class="card-title mb-2"><i style="color: #7cda24" class="icon-magnifier">&nbsp;</i>SEARCH INVESTOR ALERT LIST BY DATE:</h4>
                    <div class="row">
                        <div class="col-md-10 mb-2 ">
                            <div class="form-group">
                                    <select class="form-control" id="date_type_cb">
                                    <option value="all">ALL DATE</option>
                                    <option value="this_year">THIS YEAR</option>
                                    <option value="last_year">LAST YEAR</option>
                                    <option value="last_3_year">LAST 3 YEARS</option>
                                    <option value="custom">CUSTOM</option>
                                </select>
                            </div>
                        </div>
                        <div style="display:none" class="custom_div  col-md-5 mb-2 ">
                            <label><b>FROM:</b></label>
                            <input style="margin-top:4px" type="text" placeholder="Click to select date.." id="from_date_txt" class=" form-control" />
                        </div>
                        <div style="display:none" class="custom_div  col-md-5 mb-2 ">
                            <label><b>TO:</b></label>
                            <input style="margin-top:4px" type="text" placeholder="Click to select date.." id="to_date_txt" class=" form-control" />
                        </div>
                        <div class="col-md-2 mb-2 ">
                            <div class="form-group">
                                <button style="" id="filter_search_btn" class="btn btn-dark bg-dark text-white"><i style="color: #7cda24" class="icon-magnifier">&nbsp;</i>GO</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">
              <div id="container table-responsive">
                <b></b>
              <table id="panama_data" class="table pure-table pure-table-horizontal " >
                    <thead>
                        <tr>
                            <th class="hide"></th>
                            <th class="hide"></th>
                            <th class="hide"></th>
                            <th class="hide"></th>
                            <th style="height:1px !important">This database provides a regularly updated list from The Monetary Authority of Singapore (MAS) Investor Alert List of unregulated persons from who, based on information received by MAS, may have been wrongly perceived as being licensed or regulated by MAS. This list is not exhaustive and is based on what was known to MAS at the time of publication.</th>
                            <th class="hide" style="height:1px !important"></th>
                            <th class="hide" style="height:1px !important"></th>
                        </tr>
                    </thead>    
                    <tbody>
                </tbody>
                

                 </table>
<div class="table_loader center">
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                          <div class="wave"></div>
                        </div>

              </div>

</div>

    </div>
             </div>

    </div>

  </div>

<script src="{{ asset('public/js/app.js') }}"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

<script>
$(document).ready( function () {
    //$('#system_data').DataTable();
    
        function content(id, unregulatedpersons_t, address_s, phonenumber_s,website_s, date_dt){
            
            var date = date_dt;
            if(date_dt == ""){
                date = "N/A";
            }
            
            var data = '<h4 style="margin-top:0px;margin-bottom:5px;font-size:12px;font-weight:600;text-align:right">DATE LISTED: <b style="color:black;font-weight:bold !important">'+date+'</b></h4>';
            
            data += '<h3 style="margin-top:7px;font-size:16px"><b style="color:black;">'+unregulatedpersons_t.toUpperCase()+'</b></h3>';
            
            data += '<i id="iconx'+id+'" class="icon-arrow-up" style="color:black"></i> <button class="btn btn-dark bg-dark text-white btn-sm det_btn" name="'+ id +'<split>'+unregulatedpersons_t+'" id="but'+id+'"><i class="text-company fa fa-list-alt"></i> Show details</button>';
            data += '<div id="showhide_'+id+'" style="display:none;margin-left:15px">';
            
            if(address_s != ""){
                data += "<br><b class='mb-2' style='color:#4a4a4a;'>ADDRESS:</b> <br />" + address_s + "<br><br>";
            }
            
            if(phonenumber_s != ""){
                data += "<b class='mb-2' style='color:#4a4a4a;'>PHONE NUMBER:</b> <br />" + phonenumber_s  + "<br><br>";
            }
            
            if(website_s != ""){
                data += "<b class='mb-2' style='color:#4a4a4a;'>WEBSITE:</b> <br />" + website_s  + "<br><br>";
            }
            data += '</div><p style="margin-bottom:4px"></p>';
            
            return data;
        }
        
        var datatable;
        
        var minDate, maxDate;
        
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[6] );
                
                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );
        
        
        minDate = new DateTime($('#from_date_txt'), {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime($('#to_date_txt'), {
            format: 'MMMM Do YYYY'
        });
        
        $('#filter_search_btn').on('click', function(){
            datatable.draw();
        });
        
        $("#date_type_cb").change(function(){
            var type = $("#date_type_cb option:selected").val();
            
            <?php 
            
            $currentDate = new DateTime();
            
            $lastYearDT = $currentDate->sub(new DateInterval('P1Y'));
            $lastYear = $lastYearDT->format('Y');
            
            $lastThreeYearsDT = $currentDate->sub(new DateInterval('P3Y'));
            $lastThreeYears = $lastThreeYearsDT->format('Y');
            
            $thisYear = date("Y");
            
            ?>
            
            var this_date  = "<?php echo date("F jS Y"); ?>";
            
            
            var this_year = "January 1st <?php echo $thisYear; ?>";
            var last_year = "December 31st <?php echo $lastYear; ?>";
            var last_3_year = "December 31st <?php echo $lastThreeYears; ?>";
            
            if(type == "custom"){
                $(".custom_div").show();
                $('#from_date_txt, #to_date_txt').val("");
                minDate.val(null);
                maxDate.val(null);
            }
            else if(type == "all"){
                $(".custom_div").hide();
                $('#from_date_txt, #to_date_txt').val("");
                minDate.val(null);
                maxDate.val(null);
            }
            else{
                $(".custom_div").hide();
                
                if(type == "this_year"){
                    maxDate.val(this_date);
                    minDate.val(this_year);
                }
                
                if(type == "last_year"){
                    maxDate.val("January 1st <?php echo $lastYear; ?>");
                    minDate.val(last_year);
                }
                
                if(type == "last_3_year"){
                    maxDate.val("January 1st <?php echo $lastThreeYears; ?>");
                    minDate.val(last_3_year);
                }
            }
        });
        
        $(".custom_div").hide();
        
        
        $("#type_cb").change(function(){
            var type = $("#type_cb option:selected").val();
            if(type == "date"){
                $("#date_txt").show();
            }
            else{
                $("#date_txt").hide();
                datatable.order([5, type]).draw();
            }
        });

        datatable = $('#panama_data').DataTable({
            "data" : <?php echo json_encode($data_ia); ?>,
            "columns" : [
                { "data" : "id" },
                { "data" : "unregulatedpersons_t" },
                { "data" : "address_s" },
                { "data" : "website_s" },
                { "data" : "id" },
                { "data" : "date_dt" },
                { "data" : "date_dt_raw" }
            ],
            "columnDefs" : [{"targets":5, "type":"date-eu"}],
            order: [0, 'desc'],
            "createdRow": function ( row, data, index ) {
                $('td', row).eq(0).hide();
                $('td', row).eq(1).hide();
                $('td', row).eq(2).hide();
                $('td', row).eq(3).hide();
                $('td', row).eq(5).hide();
                $('td', row).eq(6).hide();
                
                $('td', row).eq(4).html(content(data.id, data.unregulatedpersons_t[0], data.address_s, data.phonenumber_s, data.website_s, data.date_dt)); 
            },
            "drawCallback": function( settings ) {
                $("#panama_data_wrapper").append("");
                
                $(".table_loader").fadeOut();
                $(".table_loader").remove();
            },

          "aSorting": [[ 10, "desc" ]],
          "bJQueryUI": true,
          "aLengthMenu": [[5, 10, 15, 20, 25, 50, 100, 250, 500, -1], [5, 10, 15, 20, 25, 50, 100, 250, 500, "All"]],
          "sPaginationType": "full_numbers",
              "oLanguage": {
                  "sSearch": "SEARCH RELEVANCE: "
              }
          });
          
});

$("body").on("click", ".det_btn", function(){
    var splits = $(this).attr("name").split("<split>");
    showhideMe(splits[0], splits[1]);
});

function showhideMe(idx,namex){

var r = $("#but"+idx).html();

if(r=='<i class="text-company fa fa-list-alt"></i> Hide Details'){
$("#but"+idx).html('<i class="text-company fa fa-list-alt"></i> Show Details');
$("#showhide_"+idx).hide();
$("#iconx"+idx).prop('class', 'icon-arrow-up');

}else{
$("#but"+idx).html('<i class="text-company fa fa-list-alt"></i> Hide Details');
$("#showhide_"+idx).show();
$("#iconx"+idx).prop('class', 'icon-arrow-down');

              formData = new FormData();
              formData.append("model", 'Panama Alert List');
              formData.append("action", 'Viewing');
              formData.append("details", idx+" | " + namex);
              $.ajax({
                  url: "{{ route('saveAuditTrailLog') }}",
                  type: "POST",
                  data: formData,
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  processData: false,
                  contentType: false,
                  cache: false,
                  success: function (data) {
                    console.log(data);
                  }
              });

}


}

</script>

@endsection