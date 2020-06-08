@extends('layouts.app')

@section('content')
    <link href="{{asset('public/assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}"
          rel="stylesheet" type="text/css"/>

    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
        }

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
            width: 40%;
            background-color: orangered;
        }

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

        /* Inner */
        .popup-inner {
            max-width: 700px;
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

.panel-body ul:hover {
  -moz-box-shadow: 0 0 1px 1px #31708f !important;
  -webkit-box-shadow: 0 0 1px 1px #31708f !important;
  /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
  box-shadow: 0 0 5px 0 #31708f !important;
  cursor: default !important;
}
.chat-head{
    min-height: 500px;
    height: 450px;
    overflow-x: scroll;
}

  /*for chat box area*/

#page-wrap                      { width: 500px; margin: 30px auto; position: relative; }

#chat-wrap                      { border: 1px solid #eee; margin: 0 0 15px 0; }
#chat-area                      { height: 300px; overflow: auto; border: 1px solid #666; padding: 20px; background: white; }
#chat-area span                 { color: white; background: #333; padding: 4px 8px; -moz-border-radius: 5px; -webkit-border-radius: 8px; margin: 0 5px 0 0; }
#chat-area p                    { padding: 8px 0; border-bottom: 1px solid #ccc; }

#name-area                      { position: absolute; top: 12px; right: 0; color: white; font: bold 12px "Lucida Grande", Sans-Serif; text-align: right; }   
#name-area span                 { color: #fa9f00; }

#send-message-area p            { float: left; color: white; padding-top: 27px; font-size: 14px; }
#sendie                         { border: 3px solid #999; width: 360px; padding: 10px; font: 12px "Lucida Grande", Sans-Serif; float: right; }


    </style>

    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ url('/home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Messages
        </li>

    </ul>
    <div class="container" style="margin-top: 10px;">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="portlet light " style="overflow: scroll;">
                    <div class="card" style="width: 100%; margin-top: 15px;">

                        <div class="panel h-effect">
                            <div class="panel-heading">
                                <span class="caption-subject font-blue-steel bold uppercase"> <i class="fa fa-tv"></i> {{ $company_id }}</span>
                            </div>
                            <div class="panel-body chat-head">
                                <?php
                                if ($chatHeads->count() > 0):
                                    foreach ($chatHeads as $heads):
                                        $date = date("F j, Y, g:i a", strtotime($heads->created_at));
                                ?>
                                <ul class="feeds list-group" style="border-style:none; margin-bottom: 5px;" onclick="loadChat('{{ $heads->opp_title }}', '{{ $heads->company_id }}', '{{ $heads->sender }}','{{ $heads->receiver }}', '{{ $heads->opp_type }}')">
                                    <li class="list-group-item">
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-bell-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2 ">
                                                        <div class="desc h-effect">FROM <br/> {{ App\CompanyProfile::getCompanyName($heads->sender) }}</div>
                                                    </div>
                                                    <div class="cont-col2 ">
                                                        <div class="desc h-effect"> {{ $heads->opp_title }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> <span style="font-size: 9px">{{ $date }}</span></div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <?php 
                                    endforeach;
                                endif;?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col col-md-8">
                <div class="portlet light ">
                    <div class="caption font-dark">
                        <i class="note-icon-menu-check font-dark"></i>
                        <span class="caption-subject bold uppercase">Chat Box</span>
                    </div>
                    <hr>
                    <div class="portlet-body">
                                <div class="modal-body">

                                      <div id="page-wrap">
                                
                                          
                                          <p id="name-area"></p>
                                          
                                          <div id="chat-wrap"><div id="chat-area"></div></div>
                                          
                                          <form id="send-message-area">
                                              <p>Your message: </p>
                                              <textarea id="sendie" maxlength = '100' ></textarea>
                                              <input type="hidden" id="chat-companyViewer">
                                              <input type="hidden" id="chat-companyOpp">
                                              <input type="hidden" id="chat-oppId">
                                              <input type="hidden" id="chat-oppType">
                                          </form>
                                
                                    </div>

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
                        <div id="sample_1_2_wrapper" class="dataTables_wrapper">
                            <div class="row">

                            </div>
                            <div class="table-scrollable">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="{{ asset('public/js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('public/assets/pages/scripts/table-datatables-managed.min.js')}}"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('public/assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/datatables/datatables.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#clickmewow').click(function () {
                $('#radio1003').attr('checked', 'checked');
            });
        })

    </script>
    
    <script>
        
        function loadChat(title,companyOpp,companyViewer,oppId,oppType){
            $('.chatOppTitle').text(title);
            $('#chat-companyOpp').val(companyOpp);
            $('#chat-companyViewer').val(companyViewer);
            $('#chat-oppId').val(oppId);
            $('#chat-oppType').val(oppType);

            $('#chat-area').empty();

            chat.onload();
            chat.getState(); 

            setInterval('chat.update( )', 1000);
     
            $('#inboxMeModal').modal();



        }


//for chat script
    var chat =  new Chat();
    $(function() {
    
      // chat.getState(); 
       
       // watch textarea for key presses
            $("#sendie").keydown(function(event) {  
           
               var key = event.which;  
         
               //all keys including return.  
               if (key >= 33) {
                 
                   var maxLength = $(this).attr("maxlength");  
                   var length = this.value.length;  
                   
                   // don't allow new content if length is maxed out
                   if (length >= maxLength) {  
                       event.preventDefault();  
                   }  
                }  
            });
       // watch textarea for release of key press
       $('#sendie').keyup(function(e) { 
                 
          if (e.keyCode == 13) { 
          
                  var text = $(this).val();
                  var maxLength = $(this).attr("maxlength");  
                  var length = text.length; 
                   
                  // send 
                  if (length <= maxLength + 1) { 
                   
                chat.send(text, name);  
                $(this).val("");
                
                  } else {
                  
                  $(this).val(text.substring(0, maxLength));
            
              } 
          
          }
           });
    });

var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
    this.getState = getStateOfChat;
    this.onload = chatload;
}

//gets the state of the chat
function getStateOfChat(){
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();

  if(!instanse){
     instanse = true;
      formData = new FormData();
      formData.append("function", 'getState');
      formData.append("companyOpp", companyOpp);
      formData.append("companyViewer", companyViewer);
      formData.append("oppId", oppId);
      formData.append("oppType", oppType);
      formData.append("chatAction", "2");

      
      $.ajax({
          url: "{{ route('chatProcess') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
            state = data.state;
            instanse = false;
          }
      });

  }  
}

function chatload(){
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();

      formData = new FormData();
      formData.append("function", 'onload');
      formData.append("companyOpp", companyOpp);
      formData.append("companyViewer", companyViewer);
      formData.append("oppId", oppId);
      formData.append("oppType", oppType);
      formData.append("chatAction", "2");

      
      $.ajax({
          url: "{{ route('chatProcess') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
            
            if(data.text != false){
                $('#chat-area').empty();
                for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p><span>"+data.text[i].sender+"</span>"+ data.text[i].text +"</p>"));
                }                 
           }
           document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;

          }
      });
}

//Updates the chat
function updateChat(){
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();

   if(!instanse){
     instanse = true;

      formData = new FormData();
      formData.append("function", 'update');
      formData.append("companyOpp", companyOpp);
      formData.append("companyViewer", companyViewer);
      formData.append("oppId", oppId);
      formData.append("oppType", oppType);
      formData.append("state", state);
      formData.append("chatAction", "2");
      
      $.ajax({
          url: "{{ route('chatProcess') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
            
            if(data.text != false){
                $('#chat-area').empty();
                for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p><span>"+data.text[i].sender+"</span>"+ data.text[i].text +"</p>"));
                }                 
           }
           document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
           instanse = false;
           state = data.state;

          }
      });

   }
   else {
     setTimeout(updateChat, 1500);
   }
}

//send the message
function sendChat(message, nickname)
{       
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();

    // updateChat(companyOpp, companyViewer );

    formData = new FormData();
    formData.append("function", 'send');
    formData.append("message", message);
    formData.append("companyOpp", companyOpp);
    formData.append("companyViewer", companyViewer);
    formData.append("oppId", oppId);
    formData.append("oppType", oppType);
    formData.append("chatAction", "2");
    
    $.ajax({
        url: "{{ route('chatProcess') }}",
        type: "POST",
        data: formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            updateChat();
        }
    });

}

    </script>

    <!-- END PAGE LEVEL PLUGINS -->
@endsection