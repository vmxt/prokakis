@extends('layouts.app')

@section('content')
<script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script> 


<script>

    tinymce.init({

      selector: '#businessnewsArea, #opportunitiesArea',

      branding: false,

       height: 200

    });

</script>



    <style>
        #edit_icon {
            cursor: pointer;
        }

        /* Outer */
        .popup {
            width: 100%;
            height: 100%;
            display: none;
            position: fixed;
            top: 0px;
            left: 0px;
            background: rgba(0, 0, 0, 0.75);
        }

        table {
            table-layout:fixed;
        }
        table td {
            word-wrap: break-word;
            max-width: 400px;
        }
        #system_data td {
            white-space:inherit;
        }

        /* Inner */
        .popup-inner {
            max-width: 800px;
            width: 90%;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
            border-radius: 3px;
            background: #fff;
        }

        /* Close Button */
        .popup-close {
            width: 30px;
            height: 30px;
            padding-top: 4px;
            display: inline-block;
            position: absolute;
            top: 0px;
            right: 0px;
            transition: ease 0.25s all;
            -webkit-transform: translate(50%, -50%);
            transform: translate(50%, -50%);
            border-radius: 1000px;
            background: rgba(0, 0, 0, 0.8);
            font-family: Arial, Sans-Serif;
            font-size: 20px;
            text-align: center;
            line-height: 100%;
            color: #fff;
        }

        .popup-close:hover {
            -webkit-transform: translate(50%, -50%) rotate(180deg);
            transform: translate(50%, -50%) rotate(180deg);
            background: rgba(0, 0, 0, 1);
            text-decoration: none;
        }

    </style>

    <script src="{{ asset('public/js/app.js') }}"></script>

    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Prokakis</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Business News
        </li>

    </ul>

    <div class="row justify-content-center">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-blue"></i>
                    <span class="caption-subject font-blue sbold uppercase">MANAGE BUSINESS NEWS</span>

                    @if (session('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
    
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
            @endif
               
                </div>
            </div>

           <center> <a align="right" id="edit_icon" data-popup-open="popup-2" class="btn btn-outline btn-circle btn-sm blue">
              ADD NEWS CONTENT </a> </center>

            <div id="container" class="table-scrollable">
                <table id="system_data" class="table table-hover table-light">
                    
                    <thead>
                    <tr>
                        <th width="5">#</th>
                        <th>News Title</th>
                        <th>Date Submitted</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                    <?php  
                    if(isset($rs)){
                        $i = 1;
                    foreach($rs as $data){
                    ?>
                    <input type="hidden" name="uId" id="uId" value="<?php if(isset($data->id)){ echo $data->id; } ?>">
                    <tr>
                        <td class="wrap" width='10'><?php echo $i++; ?></td> 
                        <td class="wrap"><b><?php echo $data->business_title; ?></b></td>
                        <td><b><?php echo date("F j, Y", strtotime($data->created_at)); ?></b></td>
                        <td>
                            <a id="edit_icon"  onclick="ajxProcess('<?php echo $data->id; ?>','<?php echo $data->business_title; ?>')"
                               data-popup-open="popup-1" class="btn btn-outline btn-circle btn-sm blue">
                             <i class="fa fa-edit"></i> Edit </a>
                            
                            <a id="edit_icon"  onclick="ajxDel('<?php echo $data->id; ?>', '<?php echo $data->business_title; ?>')"
                               class="btn btn-outline btn-circle btn-sm red">
                             <i class="fa fa-eraser"></i> Delete </a>
         
                        </td>

                    </tr>
                    <?php 
                        } 
                    } 
                   ?>
                    </tbody>
                 
                </table>

            </div>
            <center> <a align="right" id="edit_icon" data-popup-open="popup-2" class="btn btn-outline btn-circle btn-sm blue">
                ADD NEWS CONTENT </a> </center>

        </div>
    </div>




    <div class="popup" data-popup="popup-1">
        <div class="popup-inner">

            <input type="text" id="news_title_update" name="news_title_update" class="form-control" />
            <input type="hidden" name="newsId" id="newsId" value="">
            <p>
                <textarea rows="5" cols="20" id="opportunitiesArea"  name="opportunitiesArea"></textarea>

            </p>
            <p>
                <button align="right" id="ajxUpdate" type="button" class="btn btn-primary">Update</button>
                <button align="right" id="closeBut1" data-popup-close="popup-1" type="button" class="btn btn-danger">Close</button>
            </p>

            <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->
            <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
        </div>
    </div>


    <div class="popup" data-popup="popup-2">
        <div class="popup-inner">

            <input type="text" id="news_title" class="form-control" placeholder="News Title" />
            <p>
                <textarea rows="5" cols="20" class="form-control" name="businessnewsArea" id="businessnewsArea"></textarea>
            </p>
            <p>
                <button align="right" id="ajxSave" type="button" class="btn btn-primary">Save</button>
                <button align="right" id="closeBut2" data-popup-close="popup-2" type="button" class="btn btn-danger">Close</button>
                
            </p>

        
            <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
        </div>
    </div>




<link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
<script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

<script>
$(document).ready( function () {
    $('#system_data').DataTable();
    $(".popup").hide();

   if($('.popup-1').modal('show') == true){
       alert('sdfsd');
   }


} );


function ajxProcess(cId, nTitle){
   
        $("#newsId").val(cId);
        $("#news_title_update").val(nTitle);

        $.ajax({
            url: "{{ url('/businessnews/retcontent/') }}"+"/"+cId,
            type: "GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            processData: false,
            contentType: false,

            success: function (data) {
                console.log(data);
               
                tinymce.get("opportunitiesArea").setContent(data);

            }
        });

 
      
}

        $("#ajxUpdate").click(function () {
            tinyMCE.triggerSave();
            var newsId = $("#newsId").val();
            var newsTitle = $("#news_title_update").val();
            var newsContent = $("#opportunitiesArea").val();
         
            formData = new FormData();
            formData.append("newsId", newsId);
            formData.append("newsTitle", newsTitle);
            formData.append("newsContent", newsContent);

            $.ajax({
                url: "{{ route('updateNews') }}",
                type: "POST",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,

                success: function (data) {
                    $(".popup").hide(250);
                    document.location = "{{ route('businessnewsList') }}"
                }
            });

        });

        $("#ajxSave").click(function () {
            tinyMCE.triggerSave();
            var newsTitle = $("#news_title").val();
            var newsContent = $.trim($("textarea#businessnewsArea").val());
          
            formData = new FormData();
            formData.append("newsTitle", newsTitle);
            formData.append("newsContent", newsContent);
       
            $.ajax({
                url: "{{ route('saveBusinessNews') }}",
                type: "POST",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,

                success: function (data) {
                  console.log(data);
                   $("#news_title").val('');
                   $("#businessnewsArea").val('');
                    
                    $(".popup").hide(250);
                    document.location = "{{ route('businessnewsList') }}"
                }
            });

        });



        function ajxDel(iDx, nTitle)
        {
            
           
            swal({
                title: "Are you sure?",
                text: "You are about to delete a news item",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,

              }).then(function(isConfirm) {

                if (isConfirm) {
                  swal({
                    title: 'News Title : "'+nTitle+'", successfully deleted',
                    text:  '',
                    icon: 'success'
                  }).then(function() {
                                    formData = new FormData();
                                    formData.append("newsId", iDx);
                                
                                    $.ajax({
                                        url: "{{ route('delBusinessNews') }}",
                                        type: "POST",
                                        data: formData,
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                        processData: false,
                                        contentType: false,

                                        success: function (data) {
                                            
                                            $(".popup").hide(250);
                                            document.location = "{{ route('businessnewsList') }}"
                                        }
                                    });

                                });

                            } else {
                              swal("Cancelled", "Deleting a news item was cancelled :)", "error");
                            }
                          })
        }


        //----- OPEN
        $('[data-popup-open]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

            e.preventDefault();
        });

        //----- CLOSE
        $('[data-popup-close]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

            e.preventDefault();
        });

    </script>

@endsection