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
                <span>Opportunities</span>
            </li>
        </ul>
        <div class="row justify-content-center">
            <div class="col-md-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb font-blue"></i>
                                <span class="caption-subject  sbold uppercase">List of {{ $status }} Rewards</span>
                            </div>

                        </div>
                        <div class="portlet-body">
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
                                        <th>User</th>
                                        <th>Company</th>
                                        <th>Earned Amount</th>
                                        <th>Earned Point</th>
                                        <th>Last Update</th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $counter = 1;
                                    if(count((array)$news) > 0){
                                        foreach($news as $b){  ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><p> <?php echo App\User::getFullnameUser($b->user_id)  ?></p></td>
                                        <td><p> <?php echo App\CompanyProfile::getCompanyName($b->company_id) ?></p></td>
                                        <td><p> <?php echo $b->earned_amount; ?></p></td>
                                        <td><p> <?php echo $b->earned_points; ?></p></td>
                                        <td><p> <?php echo $b->updated_at; ?></p></td>
                                        <td class="btn" style="width:100%">
                                            <a href="#"   onclick="approvedAward('<?=$b->id ?>')" 
                                                class="btn btn-primary"
                                                style="color: white">Approved
                                            </a>
                                            <a href="#" onclick="rejectAward('<?=$b->id ?>')" 
                                                class="btn btn-danger" onclick="return confirm('Are you sure to reject this request?')"
                                                style="color: white">Reject
                                            </a>
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

<script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                { targets:"_all", orderable: false },
                { targets:[0,1,2,3,4,5, 6], className: "desktop" },
                { targets:[0,1], className: "tablet, mobile" }
            ]
            });
            $(".popup").hide();

           if($('.popup-1').modal('show') == true){
               alert('sdfsd');
           }

            $("#closeBut1").click(function () {
                $('#edit_news').dialog('close');
            });

            $("#searchMyOpportunity").click(function () {
                var industry = $("#industry").val();
                var business = $("#businessType").val();

                var getUrl = window.location;
                var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

                if (industry != "" && business != "") {
                    window.location.href = baseUrl + "/opportunity/exploreMy/" + industry + "/" + business;
                } else {
                    window.location.href = baseUrl + "/opportunity";
                }
            });

        });

        function approvedAward(id){
            swal({
                title: "Are you sure?",
                text: "You are about to approved this Reward!",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: false,

              }).then(function(isConfirm) {

                if (isConfirm) {
                  swal({
                    title: 'Approved',
                    text: 'Done on Approving this reward!',
                    icon: 'success'
                  }).then(function(isConfirm) {
                    //form.submit(); // <--- submit form programmatically

                    formData = new FormData();
                    formData.append("reward_id", id);

                        $.ajax({
                            url: "{{ route('rewardApproved') }}",
                            type: "POST",
                            data: formData,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            processData: false,
                            contentType: false,

                            success: function (data) {
                                document.location = "{{ route('rewardApprovalPending') }}"
                            }
                        });

                  });
                } else {
                  swal("Cancelled", "Privacy option to the opportunity was cancelled :)", "error");
                }
              })
        }


        function rejectAward(id){
            swal({
                title: "Are you sure?",
                text: "You are about to reject this Reward!",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: false,

              }).then(function(isConfirm) {

                if (isConfirm) {
                  swal({
                    title: 'Reject',
                    text: 'Done on rejecting this reward!',
                    icon: 'success'
                  }).then(function(isConfirm) {
                    //form.submit(); // <--- submit form programmatically

                    formData = new FormData();
                    formData.append("reward_id", id);

                        $.ajax({
                            url: "{{ route('rewardReject') }}",
                            type: "POST",
                            data: formData,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            processData: false,
                            contentType: false,

                            success: function (data) {
                                document.location = "{{ route('rewardApprovalPending') }}"
                            }
                        });

                  });
                } else {
                  swal("Cancelled", "Privacy option to the opportunity was cancelled :)", "error");
                }
              })
        }

    </script>

@foreach($news as $d)
<!-- Modal -->
<div class="modal" id="bus_news_{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="BusinenessNewsTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="portlet light" style="margin-top: 10px;" >
                <div class="portlet-body">
                    <div class="form-group">
                        <label for="business_goal"><b>Business News Title</b></label>
                        <input type="text" class="form-control input-text-form" dataName="news_title" id="newstitle_{{ $d->id }}" name="news_title"  value="<?php if(isset($d->business_title)){ echo $d->business_title; }else{echo "";} ?>" />
                    </div>
                </div>
            </div>

            <div class="portlet light" style="margin-top: -40px;" >
                <div class="portlet-body">
                    <div class="form-group">
                        <label for="business_goal"><b>Business Content</b></label>
                        <textarea class="form-control input-text-form businessnewsArea" id="newscontent_{{ $d->id }}" rows="5" dataName="news_content" name="news_content"><?php if(isset($d->content_business)){ echo $d->content_business; }else{echo "";} ?></textarea>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="ApprovedNews('{{ $d->id }}')" >Approved</button>
      </div>
    </div>
  </div>
</div>
<!-- onclick="location.href='{{ url('/businessnews/approved/'.$d->id) }}';" -->
<div class="modal-load"><!-- Place at bottom of page --></div>
@endforeach

<script>
    tinymce.init({
      selector: '.businessnewsArea',
      branding: false,
       height: 200
    });

    function ApprovedNews(id){
        formData = new FormData();
        formData.append("news_id", id);
        formData.append("news_content", $('#newscontent_'+id).val() );
        formData.append("news_title", $('#newstitle_'+id).val() );

        
            $.ajax({
                url: "{{ route('businessNewsApproved') }}",
                type: "POST",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,

                success: function (data) {
                    location.reload();
                }
            });
    }
</script>

@endsection
