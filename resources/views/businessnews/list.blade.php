@extends('layouts.app')



@section('content')

<script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script> 


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">

<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />
<script>



    tinymce.init({



      selector: '#businessnewsArea, #opportunitiesArea',



      branding: false,



       height: 200



    });



</script>







    <style>

        .edit_icon {

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

            background: rgba(0, 0, 0, 0.9);

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



        .popup_content{

            float:left;

            width:100%;

            overflow-y: auto;

            height: 100%;

        }

        .displayActive{
            display: flex !important;
        }

        .edit_news{
/*
            float:left;

            width:100%;

            overflow-y: auto;

            height: 100%;

            width: 80%;



            width: 200px; height: 150px; padding: 5px;

            text-align: center; margin: 0; */

        }


/* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.modal-load {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modal-load {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal-load {
    display: block;
}

.cardborder-radius{
        border-radius: 20px !important;
        border: 1px solid #a5a5a5; ;
    }
    
     .cardborder-radius:hover{
        box-shadow:  0 8px 16px 0 rgb(187 187 187) !important;
    }
    
      .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}

.btn.btn-outline.blue{
    border-color:black !important;
}
    </style>



    <script src="{{ asset('public/js/app.js') }}"></script>

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

        <li>

            <a href="{{ url('/home') }}">Intellinz</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            Business News

        </li>



    </ul>



    <div class="row justify-content-center">

        <div id="manage_news_section" class="portlet light">

            <div class="portlet-title">

                <div class="caption">

                    <i class="icon-settings "></i>

                    <span class="caption-subject  sbold uppercase">MANAGE BUSINESS NEWS</span>



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



           <button align="right" id="add_news_content_btn" style="margin-bottom:10px" data-popup-open="popup-2" class="edit_icon btn btn-outline btn-sm blue mb-2">

             <i class="fa fa-plus"></i> ADD NEWS CONTENT </button>


            <div class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">
            <div id="container" style="border:none !important" class="table-scrollable">

                <table id="system_data" class="table  pure-table pure-table-horizontal pure-table-striped" style="width:100%">

                    <thead>

                    <tr>

                        <th width="10%">#</th>

                        <th data-priority="1" width="60%">News Title</th>

                        <th width="15%">Date Submitted</th>

                        <th width="15%">Action</th>

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

                            <a   onclick="ajxProcess('<?php echo $data->id; ?>','<?php echo $data->business_title; ?>')"

                                 data-popup-open="popup-1" class=" edit_btn edit_icon btn btn-outline btn-circle btn-sm blue">

                             <i class="fa fa-edit"></i> Edit </a>

                            

                            <a   onclick="ajxDel('<?php echo $data->id; ?>', '<?php echo $data->business_title; ?>')"

                               class=" edit_icon btn btn-outline btn-circle btn-sm red">

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



</div>
        </div>
</div>
    </div>


 <div class="row justify-content-center">
        <div class="portlet light">
          
            <div id="container"  class="news_div table-scrollable">

                <div class="panel bg-dark">
                    <!-- Default panel contents -->
                    <div class="panel-heading bg-dark text-white">
                        <h3 class="panel-title">TOP 10 MOST/RECENT NEWS</h3>
                        <input type="hidden" id="business-news-id" value="{{ isset($_GET['busnews']) ? $_GET['busnews'] : 0  }}">
                    </div>
                 
                    <!-- List group -->
                    <ul class="list-group">
                       <?php 
                        $bn = App\BusinessOpportunitiesNews::where('status', '1')->limit(10)->orderBy('id', 'desc')->get();
                        $i = 1;
                        foreach($bn as $d){
                       ?>
                        <li class="list-group-item"><a href="#" id="a_bus_news_{{ $d->id }}"  data-toggle="modal" data-target="#bus_news_{{ $d->id }}" >{{ $d->business_title }}</a>
                            <span class="badge badge-info">{{ $i }}</span>
                        </li>


                          
                        <?php
                        $i++; 
                        } 
                        ?>
                    </ul>
                </div>

            </div>


        </div>
    </div>



    <div class="popup" id='edit_news' data-popup="popup-1">

        <div class="popup_content popup-inner">

            <div class="form-group">

                <input type="text" id="news_title_update" name="news_title_update" class="form-control" />

                <input type="hidden" name="newsId" id="newsId" value="">

                <input type="hidden" name="public_path" id="public_path" value="{{ asset('public/company/feature_images/') }}/">

            </div>

            <div class="form-group">

                <label for="feature_image_preview_save">Feature Image</label>

                <input type='file' id='feature_img'  class="form-control-file" onchange="readURL(this,'feature_image_preview_edit');" />

                    <img id="feature_image_preview_edit" src="#" alt="feature image" width="250px" style="visibility:  hidden" />

            </div>

            <div class="form-group" id="load_feature_image">

            </div>

            <div class="form-group">

                <p>

                <textarea rows="5" cols="20" class="form-control" name="opportunitiesArea" id="opportunitiesArea"></textarea>

                </p>

           </div>

            <div class="alert alert-danger">
              <strong>Warning!</strong> Business news article should not contain direct advertisements of companies or users. 
                        To offer Something you can use this 
                        <a class="btn btn-primary" href="{{ env('APP_URL') }}opportunity/select"> opportunity page. </a>
            </div>
            
            <div class="form-group">

                <p>

                <button align="right" id="ajxUpdate" type="button" class="btn btn-primary">Update</button>
                <button align="right" id="closeBut1" data-popup-close="popup-1" type="button" class="btn btn-danger">Close</button>

                </p>

            </div>

            {{-- <a class="popup-close" data-popup-close="popup-2" href="#">x</a> --}}

        </div>

    </div>


    <div class="popup" data-popup="popup-2">

        <div class="popup_content popup-inner">

            <div class="form-group">

                 <input type="text" id="news_title" class="form-control" placeholder="News Title" />

            </div>

            <div class="form-group">

                <label for="feature_image_preview_save">Feature Image</label>

                <input type='file' id='feature_img2'  class="form-control-file" onchange="readURL(this,'feature_image_preview_save');" />

                    <img id="feature_image_preview_save" src="#" alt="feature image" width="250px" style="visibility:  hidden" />

            </div>

            <div class="form-group">

                <p>

                <textarea rows="5" cols="20" class="form-control" name="businessnewsArea" id="businessnewsArea"></textarea>

                </p>

           </div>

            <div class="alert alert-danger">
              <strong>Warning!</strong> Business news article should not contain direct advertisements of companies or users. 
                        To offer Something you can use this 
                        <a class="btn btn-primary" href="{{ env('APP_URL') }}opportunity/select"> opportunity page. </a>
            </div>

            <div class="form-group">

                <p>

                <button align="right" id="ajxSave" type="button" class="btn btn-primary">Save</button>

                <button align="right" id="closeBut2" data-popup-close="popup-2" type="button" class="btn btn-danger">Close</button>

                </p>

            </div>

            {{-- <a class="popup-close" data-popup-close="popup-2" href="#">x</a> --}}

        </div>

    </div>











<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>



<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>

<script>

$.extend( $.fn.dataTable.defaults, {
    responsive: true

} );



$(document).ready( function () {
    $('#system_data').DataTable({

        responsive: true,

        columnDefs: [ 

            { targets:"_all", orderable: false },

            { targets:[0,1,2,3], className: "desktop" },

            { targets:[0,1], className: "tablet, mobile" }

        ]

    });

    $(".popup").hide();



   if($('.popup-1').modal('show') == true){

       alert('sdfsd');

   }



    $("#closeBut1").click(function () {
        $("#edit_news").removeClass("displayActive");
        $('#edit_news').dialog('close');

    });



var tour = new Tour({
  steps: [
  {
    element: "#manage_news_section",
    title: "MANAGE NEWS",
    content: "This is the list of the news you added",
    placement: "top"
  },
  {
    element: "#add_news_content_btn",
    title: "ADD NEWS",
    content: "This is the button to add news content",
    placement: "top"
  },
  {
    element: ".news_div",
    title: "LIST OF RECENT NEWS",
    content: "This is the list of recent news",
    placement: "top"
  },
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

// Start the tour
if( $('#is_tour').val() == 1 ){
    $('html').css('overflow','visible');
     $('.intro-tour-overlay').show();
    tour.start();
}

} );



function readURL(input,id) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {

            $('#'+id).attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);

        $('#load_feature_image').hide();

        $('#'+id).attr('style', 'visibility: true');

    }

}







function ajxProcess(cId, nTitle){

   

        $("#newsId").val(cId);

        $("#news_title_update").val(nTitle);

        var path = $("#public_path").val()

        $.ajax({

            url: "{{ url('/businessnews/retNewsDetails/') }}"+"/"+cId,

            type: "GET",

            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

            processData: false,

            contentType: false,



            success: function (data) {

                $('#load_feature_image').empty();

                if(data.feature_image){
                $('<img src="'+ path+data.feature_image +'">').load(function() {
                  $(this).width('250px').appendTo('#load_feature_image');
                });
                }

                if(data.content_business){
                tinymce.get("opportunitiesArea").setContent(data.content_business);
                }

                $("#edit_news").addClass("displayActive");
                // $( "#edit_news" ).dialog();

            }

        });



 

      

}



        $("#ajxUpdate").click(function () {

            tinyMCE.triggerSave();

            var newsId = $("#newsId").val();

            var newsTitle = $("#news_title_update").val();

            var newsContent = $("#opportunitiesArea").val();

            var files = $('#feature_img')[0].files[0];



            formData = new FormData();

            formData.append("newsId", newsId);

            formData.append("newsTitle", newsTitle);

            formData.append("newsContent", newsContent);

            formData.append("newsFeatureImage",files);

            $.ajax({

                url: "{{ route('updateNews') }}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,

                cache: false,

                success: function (data) {

                    console.log(data);

                    $(".popup").hide(250);
                    $(".popup").removeClass("displayActive");

                    document.location = "{{ route('businessnewsList') }}"

                }

            });



        });



        $("#ajxSave").click(function () {

           
            tinyMCE.triggerSave();

            var newsTitle = $("#news_title").val();
            if($.trim(newsTitle) == ""){
                notifyAlert("Required!", "News Title is mandatory before you can submit the form", 'error');
                return false;
            }
            var newsContent = $.trim($("textarea#businessnewsArea").val());

            var files = $('#feature_img2')[0].files[0];



            formData = new FormData();

            formData.append("newsTitle", newsTitle);

            formData.append("newsContent", newsContent);

            formData.append("newsFeatureImage",files);

       

            $.ajax({

                url: "{{ route('saveBusinessNews') }}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,

                cache: false,

                success: function (data) {

                  console.log(data);

                   $("#news_title").val('');

                   $("#businessnewsArea").val('');

                    

                    $(".popup").hide(250);

                    document.location = "{{ route('businessnewsList') }}"

                }

            });



        });


        function notifyAlert(title, desc, status){
            swal(title, desc, status);
        }


        function ajxDel(iDx, nTitle) {

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

<script type="text/javascript">
    let newsid = $('#business-news-id').val()
    if(newsid  != 0){
         $("body").addClass("loading");
     setTimeout(myGreeting, 3000);
    }
    function myGreeting() {
          $('#a_bus_news_'+newsid).click();
          $("body").removeClass("loading");
    }

// $( "#a_bus_news_"+newsid ).click(function() {
//   alert( "Handler for .click() called." );
// console.log('bus_news_'+newsid);

// });
</script>

@foreach($bn as $d)
<!-- Modal -->
<div class="modal" id="bus_news_{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="BusinenessNewsTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="BusinenessNewsTitle">{{ $d->business_title }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p> {!! $d->content_business !!} </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal-load"><!-- Place at bottom of page --></div>
@endforeach
@endsection