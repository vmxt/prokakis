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
    }
</style>


<script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">

<div class="container">
    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>HIGH RISK PROILE</span>
        </li>
    </ul>
    <div class="row justify-content-center">

             <div class="col-md-12">
            
            <div class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">
                    <h4 class="card-title mb-2"><i style="color: #7cda24" class="icon-magnifier">&nbsp;</i>SELECT HIGH RISK PROILE:</h4>
                    <div class="row">
                        <div class="col-md-10 mb-2 ">

                            <div id="type_section" class="form-group">

                                    <select class="form-control" id="type_cb">
                                    <option <?php if($type == "panama"){echo "selected";} ?>  value="panama">PANAMA</option>
                                    <option <?php if($type == "bahamas"){echo "selected";} ?>  value="bahamas">BAHAMAS</option>
                                    <option <?php if($type == "paradise"){echo "selected";} ?>  value="paradise">PARADISE</option>
                                    <option <?php if($type == "offshore"){echo "selected";} ?>  value="offshore">OFFSHORE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2 ">

                            <div id="select_section" class="form-group">
r
                                <button style="" id="filter_search_btn" class="btn btn-dark bg-dark text-white"><i style="color: #7cda24" class="icon-magnifier">&nbsp;</i>SELECT</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div id="table_section" class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">
              <div id="container table-responsive">

              <table id="panama_data" class="table pure-table pure-table-horizontal pure-table-striped" >
                    <thead>
                        <tr>
                            <th class="hide"></th>
                            <th>NAME</th>
                            <th style="text-align:left">COUNTRY</th>
                            <th class="fit" style="text-align:center">DATE</th>
                            <th style="text-align:right">JURISDICTION</th>
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

<script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>

<script>
$(document).ready( function () {
    //$('#system_data').DataTable();
    
    var tour;
        
         tour = new Tour({
          steps: [
          {
            element: "#type_section",
            title: "TYPE OF HIGH RISK",
            content: "This is where you choose on what type of high risk you want to view",
            placement: "top"
          },
          {
            element: "#select_section",
            title: "SELECT BUTTON",
            content: "Click this to load the high risk list based on chooses type",
            placement: "top"
          },
          
          {
            element: "#table_section",
            title: "LIST OF HIGH RISK PROFILE",
            content: "This is where you can view the list of high risk profile",
            placement: "top"
          },
          {
            element: "#panama_data_filter label",
            title: "SEARCH RELEVANCE",
            content: "This is where you can filter the list of investors using keywords",
            placement: "top"
          }
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
    
            $('#panama_data').DataTable({
                "data" : <?php echo json_encode($panamaData); ?>,
                "columns" : [
                    { "data" : "id" },
                    { "data" : "Name" },
                    { "data" : "Country" },
                    { "data" : "IncorporationDate" },
                    { "data" : "Jurisdiction" }
                ],
                "createdRow": function ( row, data, index ) {
                    $('td', row).eq(0).hide();
                    $('td', row).eq(0).addClass("fit");
                      $('td', row).eq(3).addClass("fit");
                      $('td', row).eq(3).css("text-align","center");
                      $('td', row).eq(4).css("text-align","right");
                      $('td', row).eq(2).css("text-align","left");
                    },
                    "drawCallback": function( settings ) {
                        $(".table_loader").fadeOut();
                        $(".table_loader").remove();
                        
                         // Start the tour
                        if( $('#is_tour').val() == 1 ){
                            $('html').css('overflow','visible');
                             $('.intro-tour-overlay').show();
                            tour.start();
                        }

                },

          "aSorting": [[ 10, "desc" ]],
          "bJQueryUI": true,
          "aLengthMenu": [[10, 15, 20, 25, 50, 100, 250, 500, -1], [5, 10, 15, 20, 25, 50, 100, 250, 500, "All"]],
          "sPaginationType": "full_numbers",
              "oLanguage": {
                  "sSearch": "Search Entity: "
              }
          });
          
          
          $("#filter_search_btn").click(function(){
              var type = $("#type_cb option:selected").val();
              
              var base_url = "<?php echo env("APP_URL"); ?>";
              window.location.href = base_url + "highRisk/" + type;
          });

});

function showhideMe(idx,namex){

var r = $("#but"+idx).html();

if(r=='Hide details'){
$("#but"+idx).html("Show details");
$("#showhide_"+idx).hide();
$("#iconx"+idx).prop('class', 'icon-arrow-up');

}else{
$("#but"+idx).html("Hide details");
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