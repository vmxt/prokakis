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
</style>
<br />

<script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<div class="container">
    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Investor Alert List, Offshore </span>
        </li>
    </ul>
    <div class="row justify-content-center">

             <div class="col-md-12">

              <div id="container">
              <table id="system_data_offshore" class="display hover row-border stripe compact">
                    <thead>
                        <tr>
                            <th style="text-align: center"><h3><strong></strong></h3></th>
                        </tr>
                    </thead>

                    <tbody>


                            <?php
                            if(count((array)$offshoreData) > 0)
                            {
                                foreach($offshoreData as $d){
                            ?>
                              <tr>
                                <td style="padding:20px;">


                                    <h3><b style="color:#4a4a4a;"><?php echo $d['Name']; ?></b></h3>
                                    <i id="iconx<?php echo $d['id']; ?>" class="icon-arrow-up" style="color:black"></i> <button onclick="showhideMe('<?php echo $d['id']; ?>', '<?php echo $d['Name']; ?>');" id="but<?php echo $d['id']; ?>"> Show details</button>
                                    <div id="showhide_<?php echo $d['id']; ?>" style="display:none;">
                                    <?php
                                     
                                        echo "<b style='color:#4a4a4a;'>Country:</b> <br />".$d['Country'].'<br />';
                                        echo "<br /><b style='color:#4a4a4a;'>Incorporation Date:</b> <br />".$d['IncorporationDate'].'<br />';
                                        echo "<br /><b style='color:#4a4a4a;'>Jurisdiction:</b> <br />".$d['Jurisdiction'].'<br />';
                                     
                                    ?>
                                    <br />
                                    </div>

                                </td>
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

<script src="{{ asset('public/js/app.js') }}"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready( function () {
   // $('#system_data').DataTable();

   $('#system_data_offshore').DataTable({
    "aSorting": [[ 5, "desc" ]],
    "bJQueryUI": true,
    "aLengthMenu": [[5, 10, 15, 20, 25, 50, 100, 250, 500, -1], [5, 10, 15, 20, 25, 50, 100, 250, 500, "All"]],
    "sPaginationType": "full_numbers",
        "oLanguage": {
            "sSearch": "Search Entity: "
        }
    });

});

function showhideMe(idx, namex){

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
              formData.append("model", 'Offshore Alert List');
              formData.append("action", 'Viewing');
              formData.append("details", idx+" | "+namex);
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
