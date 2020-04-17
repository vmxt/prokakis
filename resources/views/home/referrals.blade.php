@extends('layouts.app')



@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">

    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">



    <style>



        .btn-x3 {

            font-size: 15px;

            border-radius: 5px;

            width: 25%;

            background-color: orangered;

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

                            <div class="alert alert-info" style="width: 100%; overflow: hidden; margin-left: 0px !important;">

                            <p>

                              Your referral link: <b><?php echo $url_result; ?></b>

                            </p>



                            <p>

                              Start earning system points and future rewards, share your links to your friends and social media accounts.

                            </p>

                            </div>
                                <div class="alert alert-info " id="refer_alert" role="alert" style="display: none">
                                  Copy to Clipboard!
                                </div>
                              <div class="input-group">
                                <div class="input-group-btn ">
                                  <button class="btn btn-info" type="submit" onclick="myFunction()"  >
                                    <i class="glyphicon glyphicon-page" >Copy</i>
                                  </button>
                                </div>
                                <?php $url_result = " https://app.prokakis.com/register-ref/Mjg=" ?>
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
                    

                            </div>

                            </div>





                    </div>





                    <div class="portlet light ">

                        <div class="portlet-title">





                            <div class="caption">



                                <i class="icon-share"></i>

                                <span class="caption-subject font-blue sbold uppercase">List of referrals under your account. </span>



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















                </div>

                </div>



        </div>





    <script src="{{ asset('public/js-tabs/jquery-1.12.4.js') }}"></script>

    <script src="{{ asset('public/js-tabs/jquery-ui.js') }}"></script>



    <!--<script src="{{ asset('public/js/app.js') }}"></script>-->

    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>



    <script>

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
