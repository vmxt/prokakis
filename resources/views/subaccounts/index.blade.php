@extends('layouts.app')



@section('content')


    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

    <style>



        .btn-x3 {

            font-size: 15px;

            border-radius: 5px;

            width: 25%;

            background-color: orangered;

        }
  .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
  
   
    .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}

    </style>



    <div class="container">

        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

            <li>

                <a href="{{ url('/home') }}">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="{{ route('setSubaccounts') }}">User Control </a>

            </li>

        </ul>

        <div class="row justify-content-center">



            <div class="col-md-12">



                    <div class="portlet light ">

                            <div class="portlet-title">

                            <div>
                                <a href="<?php echo $url_result; ?>" class="btn btn-primary"> Add User</a>
                                <br />
                                <br />
                                 <b>Your registration link, copy and give it to your personnel:</b>
                                    <div class="input-group" style="margin-top:5px">
                                      <span class="input-group-btn">
                                        <button class="btn btn-warning" onclick="myFunction()">Copy Link</button>
                                      </span>
                                      <input type="text" class=form-control value="<?php echo $url_result; ?>" id="myInput">
                                    </div>
                            </div>
                            
                            
                        

                    </div>


                    <div class="portlet light ">

                        <div class="portlet-title">


                            <div class="caption">

                                <i class="icon-share"></i>

                                <span class="caption-subject sbold uppercase">Your list of sub-accounts </span>



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

                      <div id="table_section" class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">
              <div id="container table-responsive table-scrollable table-scrollable-borderless" style="overflow-x:scroll">

                                <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped">

                                        <thead>

                                                <tr>

                                                    <th>First Name</th>

                                                    <th>Last Name</th>

                                                    <th>Email Address</th>

                                                    <th>Created At</th>

                                                    <th>Access by Company</th>

                                                    <th>Account Access </th>


                                                </tr>

                                        </thead>

                                                <tbody>

                                                 <?php if(isset($usrs)){ 
                                                 foreach($usrs as $u){    
                                                 ?>   
                                                  <tr>   
                                                    <td><?php echo $u->firstname; ?></td>    
                                                    <td><?php echo $u->lastname; ?></td>    
                                                    <td><?php echo $u->email; ?></td>    
                                                    <td><?php echo $u->created_at; ?></td>    

                                                    <td> 
                                                        <?php if($u->status == 1){ ?>
                                                        <button class="btn btn-info"  id="bsa<?php echo $u->id; ?>" onclick="openAssign('sa<?php echo $u->id; ?>', '<?php echo $u->id; ?>')">Close</button>
                                                        <?php } else { ?>
                                                        Deactivated
                                                        <?php } ?>
                                                        
                                                    </td>   
                                                    <td> 
                                                        <?php if($u->status == 1){ ?>
                                                        <button class="btn btn-danger" id="bsa<?php echo $u->id; ?>" onclick="remAssign('sa<?php echo $u->id; ?>', '<?php echo $u->id; ?>')"><?php if($u->status == 1){ echo "Deactivate"; } else { echo "Activate"; } ?>  </button> 
                                                        <?php } else { ?>
                                                            Deactivated
                                                        <?php } ?>
                                                    
                                                    </td>   

                                                  </tr>  
                                                  
                                                  <tr>
                                                      <td colspan="6">
                                                       <div id="sa<?php echo $u->id; ?>">

                                                       <table cellspacing="5" cellpadding="5">
                                                          
                                                        <tr>
                                                         <?php
                                                         if($u->status == 1){ 
                                                         foreach($company as $c){ ?>     
                                                            <th>{{ $c->company_name }}</th>
                                                        <?php } }  ?>    
                                                        </tr>

                                                           <tr>


    <?php 
    if($u->status == 1){ 

    $sa = App\SAConfiguration::all();  
    foreach($company as $c){ 
    ?>  
                                                        <td>
    <?php foreach($sa as $s) {  
    ?>                                                    
       
        <input <?php if(App\SAaccess::checkUserAccess($u->id, $c->id, $s->id)){ echo "checked='true'"; } ?> onclick="ajxP('{{ $u->id }}', '{{ $c->id }}', '{{ $s->id }}')" type="checkbox" id="sa{{ $u->id }}{{ $c->id }}{{ $s->id }}" name="sa{{ $c->id }}{{ $s->id }}" value="{{ $s->id }}">
        <label for="sa{{ $s->id }}"> {{ strtoupper($s->action) }} - {{ $s->module_controller }} </label> <br>
       
        <?php } ?> 


                                                        </td>
    <?php }
    
                                                     }  ?>        
    
    


                                                           </tr>

                                                       </table>
                                                    
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

                </div>

</div>

        </div>





    <script src="{{ asset('public/js-tabs/jquery-1.12.4.js') }}"></script>

    <script src="{{ asset('public/js-tabs/jquery-ui.js') }}"></script>



    <!--<script src="{{ asset('public/js/app.js') }}"></script>-->

    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>

    <script>
function myFunction() {
/* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  alert("Copied the link: " + copyText.value);
}
        function ajxP(uid, cid, sid)
        {
          var chkbox = document.getElementById('sa'+uid+cid+sid);  

            if (chkbox.checked == true) {
               // alert("checked");
                var txt;
                var r = confirm("Are you sure to add this role?");
                if (r == true) {
                    ajaxCallP(uid, cid, sid, 'add'); 
                    document.getElementById('sa'+cid+sid).checked = true; 
                } else {
                    document.getElementById('sa'+cid+sid).checked = false; 
                   // return false;
                }

               
            } else {

                var txt;
                var r = confirm("Are you sure to remove this role?");
                if (r == true) {
                    ajaxCallP(uid, cid, sid, 'rem'); 
                    document.getElementById('sa'+cid+sid).checked = false; 
                } else {
                    document.getElementById('sa'+cid+sid).checked = true; 
                   // return false;
                }
            
            }

        }

        function ajaxCallP(uid, cid, sid, mood)
        {
            formData = new FormData();
            formData.append("user_id", uid);
            formData.append("company_id", cid);
            formData.append("sa_config_id", sid);
            formData.append("mood", mood);
            
            $.ajax({
                url: "{{ route('AjaxRegistration') }}",
                type: "POST",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
    
                    // console.log(data);
    
                }
    
            });

        }
      
        function openAssign(tor, vic){  
         
         var x = document.getElementById(tor);
         var y = document.getElementById('bsa'+vic);

        if (x.style.display === "none") {
             x.style.display = "block";
             y.textContent = "Close";

        } else {
        x.style.display = "none";
            y.textContent = "Open";

        }

        }

        function remAssign(tor, vic){


            var txt;
            var r = confirm("Are you sure to deactivate his account access?");
            if (r == true) {
            
                formData = new FormData();
                formData.append("sa_user_id", vic);
                
                $.ajax({
                    url: "{{ route('AjaxSADeactivation') }}",
                    type: "POST",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (data) {
        
                        window.location.reload();
        
                    }
        
                });

           
             } 

        }


        $(document).ready(function () {
           // $('#system_data').DataTable();
           // $("p").hide(500);
           $('#system_data').DataTable();
        });

        $(function() {

            $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

        });

    </script>



@endsection
