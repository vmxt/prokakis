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
        
             
            .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}

    </style>

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />
<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

    <div class="container">

        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

            <li>

                <a href="{{ url('/home') }}">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="{{ route('manageRegsLink') }}">Registration Links</a>

            </li>

        </ul>

        <div class="row justify-content-center">



            <div class="col-md-12">



                    <div class="portlet light ">

                            <div class="portlet-title" style="border-bottom:none !important">

                                    <form action="{{ route('addRegsLink') }}" method="POST" style="display: block;" onSubmit="if(!confirm('Are you sure to add a new link?')){return false;}">

                                            {{ csrf_field() }}
                                            <label> Select A Category </label>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <select style="float:right;"  name="user_type" class="form-control" >

                                                        <option value="0"></option>
    
                                                      <!--  <option value="1">Company</option> -->
    
                                                        <option value="2">Assistant Consultant</option>
    
                                                        <option value="3">Master Consultant</option>
    
                                                        <option value="4">Ebos Staff</option>
    
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="submit" style="float:right;" class="btn btn-primary" value="ADD LINK">
                                                </div>
                                            </div>

                                    </form>

                            </div>

                        </div>





                    <div class="portlet light ">

                        <div class="portlet-title" style="border-bottom:none !important">





                            <div class="caption">



                                <i class="icon-share"></i>

                                <span class="caption-subject sbold uppercase">List of Registration links</span>



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

                                <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped">

                                        <thead>

                                                <tr>

                                                    <th>Category</th>

                                                    <th>Link</th>

                                                    <th>Token</th>

                                                    <th>Active</th>

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

                                                    <tr>



                                                    <td align="center">

                                                        <?php echo $d->category; ?>

                                                    </td>



                                                    <td align="center">

                                                        <?php echo $d->link; ?>

                                                    </td>



                                                    <td align="center">

                                                            <?php echo $d->token; ?>

                                                        </td>



                                                    <td align="center">

                                                            <?php

                                                            if($d->status == 1){

                                                              echo 'True';

                                                            } else{

                                                              echo 'False';

                                                            }

                                                            ?>

                                                    </td>


                                                    <td align="center">

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

