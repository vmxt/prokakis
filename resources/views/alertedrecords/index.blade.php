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

<script>
          tinymce.init({
            selector: '#businessnewsArea, #opportunitiesArea',
            branding: false,
             height: 400
          });
</script>

<div class="container">
    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Investor Alert List </span>
        </li>
    </ul>
    <div class="row justify-content-center">


            <div class="col-md-12">

              <div id="container">
              <table id="system_data" class="display hover row-border stripe compact">
                    <thead>
                        <tr>
                            <th style="text-align: center"><h3>Click here to <strong>sort</strong></h3></th>
                        </tr>
                    </thead>

                    <tbody>


                            <?php
                            if(count((array)$data_ia) > 0)
                            {
                              //$data = array_reverse($data_ia, true);

                                    foreach($data_ia as $d){
                            ?>
                              <tr>
                                <td style="padding:20px;">


                                    <h3><b style="color:#4a4a4a;"><?php echo $d->unregulatedpersons_t[0]; ?></b></h3>
                                    <i id="iconx<?php echo $d->id; ?>" class="icon-arrow-up" style="color:black"></i> <button onclick="showhideMe('<?php echo $d->id; ?>');" id="but<?php echo $d->id; ?>"> Show details</button>
                                    <div id="showhide_<?php echo $d->id; ?>" style="display:none;">
                                    <?php
                                      if(trim($d->address_s) != ''){
                                        echo "<b style='color:#4a4a4a;'>Address:</b> <br />".$d->address_s.'<br />';
                                      }
                                      if(trim($d->phonenumber_s) != ''){
                                        echo "<br /><b style='color:#4a4a4a;'>Phone Number:</b> <br />".$d->phonenumber_s.'<br />';
                                      }

                                      if(trim($d->website_s) != ''){
                                        echo "<br /><b style='color:#4a4a4a;'>Website:</b> <br />".$d->website_s.'<br />';
                                      }

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

        $('#system_data').DataTable({
        "aSorting": [[ 5, "desc" ]],
        "bJQueryUI": true,
        "aLengthMenu": [[5, 10, 15, 20, 25, 50, 100, 250, 500, -1], [5, 10, 15, 20, 25, 50, 100, 250, 500, "All"]],
        "sPaginationType": "full_numbers",
            "oLanguage": {
                "sSearch": "Search Entity: "
            }
        });

});

function showhideMe(idx){

var r = $("#but"+idx).html();

if(r=='Hide details'){
$("#but"+idx).html("Show details");
$("#showhide_"+idx).hide();
$("#iconx"+idx).prop('class', 'icon-arrow-up');

}else{
$("#but"+idx).html("Hide details");
$("#showhide_"+idx).show();
$("#iconx"+idx).prop('class', 'icon-arrow-down');
}


}

</script>

<!--
<script src="https://unpkg.com/vue"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.2/axios.js"></script>

  <script>
            new Vue({
                el: '#app',
                data () {
                    return {
                    infoVic: null
                    }
                },
                mounted () {
                    axios
                    .get('https://www.mas.gov.sg/api/v1/ialsearch?json.nl=map&wt=json&sort=date_dt%20desc&q=*:*&rows=1000&start=0')
                    .then(response => (this.infoVic = response))
                }
            })

</script>
-->
@endsection
