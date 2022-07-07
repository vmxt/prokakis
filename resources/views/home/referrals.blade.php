@extends('layouts.app')



@section('content')

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css'>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <style>



        .btn-x3 {

            font-size: 15px;

            border-radius: 5px;

            width: 25%;

            background-color: orangered;

        }
  .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
  
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
    </style>



    <div class="container">

        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

            <li>

                <a href="{{ url('/home') }}">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="{{ route('referralsList') }}">Referrals </a>

            </li>

        </ul>

        <div class="row justify-content-center">



            <div class="col-md-12">



                    <div class="portlet light ">

                            <div class="portlet-title">

                            <div class="alert bg-dark text-company" style="width: 100%; overflow: hidden; margin-left: 0px !important;">

                            <p>

                              Your referral link: <b><?php echo $url_result; ?></b>

                            </p>



                            <p>

                              Start earning system points and future rewards, share your links to your friends and social media accounts.

                            </p>

                            </div>
                                <div class="alert alert-success " id="refer_alert" role="alert" style="display: none">
                                  Copy to Clipboard!
                                </div>
                              <div class="input-group">
                                <div class="input-group-btn ">
                                  <button class="btn btn-primary" type="submit" onclick="myFunction()"  >
<i class="fa fa-copy" ></i> Copy
                                  </button>
                                </div>
                                
                                <input id="refer_url" type="text" class="form-control" name="refer_url" value="{{ $url_result }}" readonly>
                              </div>

                            <div >
                                 <h4>Social Media Outlet:</h4>

                                   <a class="btn btn-social-icon btn-facebook"
                                        target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($url_result); ?>" 
                                   >
                                    <span class="fa fa-facebook"></span> Share on Facebook
                                  </a>
            
                                   <a class="btn btn-social-icon btn-twitter"
                                        target="_blank"
                                        href="https://twitter.com/share?url=<?php echo urlencode($url_result); ?>" 
                                   >
                                    <span class="fa fa-twitter"></span> Share on Twiiter
                                  </a>
                    
                             <h4>How do you want to keep your referral information:</h4>
                            <input type="checkbox" 
                              onchange="referStatus(this)"
                              id="refer_info_status"
                              checked 
                              data-toggle="toggle" 
                              data-on="PUBLIC" 
                              data-off="PRIVATE" 
                              data-width="100" 
                              data-onstyle="success" 
                              data-offstyle="primary" 
                              data-style="slow">
                            </div>

                            </div>





                    </div>





                    <div class="portlet light ">

                        <div class="portlet-title">





                            <div class="caption">



                                <i class="icon-share"></i>

                                <span class="caption-subject  sbold uppercase">List of referrals under your account. </span>



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

                            <div class="table-scrollable" style="border:none !important">

                                <table id="system_data" class="table table-bordered table-hover">

                                        <thead>

                                                <tr>

                                                    <th>First Name</th>

                                                    <th>Last Name</th>

                                                    <th>Email Address</th>

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



                                                    <td>

                                                        <?php echo $d->firstname; ?>

                                                    </td>



                                                    <td>

                                                        <?php echo $d->lastname; ?>

                                                    </td>



                                                    <td>

                                                        <?php echo $d->email; ?>

                                                    </td>



                                                    <td>

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

                <div class="panel panel-success">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h3 class="panel-title"><b>Ten Most Referrals</b></h3>
                    </div>
                 
                    <!-- List group -->
                    <ul class="list-group">
                       <?php 
                        $i = 1;
                        foreach($topReferral as $refer){
                          $userD = App\User::find($refer->referral_id);
                          $referName = $userD->lastname.", ".$userD->firstname;
                       ?>
                        <li class="list-group-item"><a href="#top_referral_{{ $userD->id }}" rel="modal:open">{{ $referName }}</a>
                            <span class="badge badge-info">{{ $refer->count_refer }}</span>
                        </li>

                        <div id="top_referral_{{ $userD->id }}" class="modal modalq">
                           <hr>
                            <p><h4><strong>Name: </strong></h4>
                              {{ $referName }}
                            </p>  
                             <hr>
                            <p><h4><strong>Email: </strong></h4>
                              {{ $userD->email }}
                            </p> 
                            <hr>
                            <p><h4><strong>Company Name: </strong></h4>
                              {{ $userD->company_name }}
                            </p> 
                            <hr>
                            <p><h4><strong>Company Website: </strong></h4>
                              {{ $userD->company_website }}
                            </p> 
                            <hr>
                            <a href="#" class="btn btn-primary" rel="modal:close">Close</a>
                          </div>
                          
                        <?php
                        $i++; 
                        } 
                        ?>
                    </ul>
                </div>














                </div>

                </div>



        </div>





    <script src="{{ asset('public/js-tabs/jquery-1.12.4.js') }}"></script>

    <script src="{{ asset('public/js-tabs/jquery-ui.js') }}"></script>



    <!--<script src="{{ asset('public/js/app.js') }}"></script>-->

   <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>



    <script>

          var referFlagStatus = '{{ $user_details->referral_status }}'
          if(referFlagStatus == 1)
             $('#refer_info_status').prop('checked', false).change()
          else
             $('#refer_info_status').prop('checked', true).change()

      function referStatus(val){

        var referStatus = 1;
        if($(val).prop('checked')) referStatus = 2;
        
        formData = new FormData();
        formData.append("referStatus", referStatus);
       
        $.ajax({

            url: "{{ route('updateReferStatus') }}",

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


        function myFunction() {
          var copyText = document.getElementById("refer_url");
          copyText.select();
          copyText.setSelectionRange(0, 99999);
          document.execCommand("copy");
          
          $('#refer_alert').attr("style","display:true");
          // var tooltip = document.getElementById("myTooltip");
          // tooltip.innerHTML = "Copied: " + copyText.value;
        }

        // function outFunc() {
        //   var tooltip = document.getElementById("myTooltip");
        //   tooltip.innerHTML = "Copy to clipboard";
        // }


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



@endsection
