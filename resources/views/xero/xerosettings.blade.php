@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>


        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 30px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .btn-x3 {
            font-size: 15px;
            border-radius: 5px;
            width: 25%;
            background-color: orangered;
        }
@media (max-width: 425px){
    .col-md-12{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
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

<script src="https://cdn.tiny.cloud/1/slw9lhdv4c3fx4qi60rcwkfkpr4dwlfj265xiqescxzq8y76/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Opportunities</span>
            </li>
        </ul>
        
        <div class="modal fade" style="" id="agreement_modal" tabindex="-1" role="dialog" aria-labelledby="modal_lbl" aria-hidden="true">
          <div class="modal-dialog" role="document" style="width:80%">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="modal_lbl"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                  <form method='post' action="{{ route('insertAgreement') }}">
                      {{ csrf_field() }}
                            <div class="mb-1">
                                <label><strong>Agreement:</strong></label>
                                <input type="hidden" name="id_txt" id="id_txt" />
                                <textarea id="mytextarea" name='agreement_txt' class="form-control"></textarea><br>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" name="submit" value="Submit" class="btn btn-success">
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb "></i>
                                <span class="caption-subject  sbold uppercase">List Xero Connection Agreement</span>
                            </div>

                        </div>
                        <div class="portlet-body">
                            <button type='button' id="add_btn" class='btn btn-primary '>ADD NEW</button>
                            
                            <div id="container" class="table-scrollable" style="border:none !important">

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

                                <table id="system_data" class="table pure-table pure-table-horizontal pure-table-striped" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Agreement</th>
                                        <th>Created Date</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $counter = 1;
                                    if(count((array)$result) > 0){
                                        foreach($result as $b){  ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><p> <?php echo $b->agreement ?></p></td>
                                        <td><p> <?php echo $b->created_at ?></p></td>
                                        <td><p> 
                                        <?php 
                                        $user_res = App\User::find($b->created_by );
                                        echo $user_res->firstname . " " . $user_res->lastname;
                                        
                                        ?></p></td>
                                        <td><p> <?php echo ($b->status == "1") ? "<b class='text-success'>ACTIVE</b>" : "<a href='".env("APP_URL")."company/makeAgreementActive/".$b->id."' type='button' class='btn btn-primary active_btn'>Make this Active</a>" ?></p></td>
                                        <td>
                                            <button type='button' name="{{ $b->id }}" class='btn btn-success edit_btn'>EDIT</button>
                                        </td>
                                    </tr>

                                    <?php
                                    $counter++;
                                        }

                                    } ?>

                                    </tbody>
                                 
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
                </div>

        </div>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            
            $("body").on("click", ".edit_btn", function(){
                var id = $(this).attr("name");
                var text = $(this).closest("tr").find("td:eq(1)").html();
                
                $("#id_txt").val(id);
                //$("#mytextarea").val(text);
                tinymce.get("mytextarea").setContent(text);
                $("#agreement_modal").modal("show");
            });

        tinymce.init({
            selector: '#mytextarea',
            plugins: [
                'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
                'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
                'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
            ],
            relative_urls : false,
    remove_script_host: true,
            toolbar: 'undo redo | formatpainter casechange styleselect | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
        
        $(document).on('focusin', function(e) {
        if ($(e.target).closest(".tox-textfield").length)
            e.stopImmediatePropagation();
});

            $("#add_btn").click(function(){
                $("#id_txt").val("");
                $("#agreement_modal").modal("show");
            });

            $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                { targets:"_all", orderable: false },
                { targets:[0,1,2,3,4], className: "desktop" },
                { targets:[0,1], className: "tablet, mobile" }
            ]
            });
    
        });

       


    </script>






@endsection
