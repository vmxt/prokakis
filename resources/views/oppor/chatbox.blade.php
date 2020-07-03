@extends('layouts.app')

@section('content')


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

#page-wrap  { 
    /*width: 85%; */
    margin: 30px auto; 
    position: relative; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

    /*margin-bottom: 90px;*/
}

#chat-wrap { 
    /*border: 1px solid #eee; */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    margin: 0 0 15px 0; 
}

#chat-area { 
    height: 400px; 
    overflow: auto; 
        border-width:5px;  
    border-style:groove;
    padding: 20px; 
     /*background: #E5DDD5; */
}

#chat-area span { 
    color: black;
    padding: 0px 10px; 
    -moz-border-radius: 5px; 
    -webkit-border-radius: 8px; 
    margin: 0 5px 0 0; 
    margin-left: -20px;
    width: 65%;
/*    border: 1.5px #707080;
    border-style: groove;*/
      -moz-box-shadow: 0 0 1px 1px #707080 !important;
  -webkit-box-shadow: 0 0 1px 1px #707080 !important;
  /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
  box-shadow: 0 0 5px 0 #707080 !important;
}

#chat-area p  { 
    margin-left: 20px;
    padding: 1px 0;
}

#name-area { 
    position: absolute; 
    top: 12px; right: 0; 
    color: white; 
    font-size: 15px;
    text-align: right; 
}   

#name-area span  { 
    color: #fa9f00; 
}

#send-message-area p  { 
    float: left; 
    color: white; 
    padding-top: 27px; 
    font-size: 14px; 
}

#sendie  { 
    border: 3px solid #999; 
    width: 360px; 
    padding: 10px; 
    font-size: 15px;
    float: right; 

    width: 100% !important;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

#chat-area h6 {
    text-transform: uppercase;
    font-weight: 900;
}

h2.chatOppTitle {
    font-size: 35px;
    text-transform: uppercase;
    margin-top: 12px;
    width: 100%;
}

img.chatAvatar {
    border-radius: 50%;
    width: auto;
    height: 60px;
    float: right;
    margin-left: 30px;
}

.chat-header{
    display: flex;
}

.requestorAvatar{
    margin-right: 30px;
}

.providerAvatar{
    margin-left: 30px;
    position: absolute;
    right: 15px;
}

.chat-area-text img{
    width: auto;
    border-radius: 50%;
    height: 50px;

}

.chat-area-text {
    display: flex;
    padding: 5px;
}

.chat-provider{
    position: relative;
}


.chat-provider span {
     margin-left: 10em !important;
    background: #DCF8C6; 
}

.chat-requestor span{
  background: #FFFFFF; 

}

.send-msg-container{
    position: relative;
}

.send-msg-container form{
    position: absolute;
    margin-top: -20px;
    width: 100%;
}

.portlet{
   height: 40em;
}

.modal-body{
  padding: 0px;
}

.portlet.light .portlet-body{
  padding-top: 0px;
}

/*badge*/
*.icon-blue {color: #0088cc}
*.icon-grey {color: grey}
.badge-msg {   
    width:100px;
    text-align:center;
    vertical-align:middle;
    position: relative;
}
.badge-msg:after{
    content:attr(data-count);
    position: absolute;
    background: rgba(0,0,255,1);
    height:2rem;
    top: -1rem;
    right: -1.3rem;
    width:2rem;
    text-align: center;
    line-height: 2rem;;
    font-size: 1rem;
    border-radius: 50%;
    color:white;
    border:1px solid blue;
}

.col3 {
    position: absolute;
    left: 0;
}

.fa-border{
  border: 0;
}

.text-container-col-4 {
    margin-top: 6em;
}

.list-group-item a{
  text-decoration: none;
}

.desc.h-effect {
    margin-bottom: 5px;
}

@media (min-width: 992px){
  .for-mobile{
    display: none;
  }
  .for-desktop{
    display: block;
   }

  .collapse{
    display: block !important;
    visibility: visible !important;
  }
}

@media (max-width: 1200px){
  .providerAvatar{
    right: -11px;
  }
}

@media (max-width: 992px){
  .for-mobile{
    display: block;
  }
  .for-desktop{
    display: none;
   }

  .panel.h-effect {
      height: auto;
  }
  .portlet.light{
    height: auto;
  }


}

@media (max-width: 640px){
  #chat-area span{
    width: 85%;
  }

  .chat-provider span{
    margin-left: 0em !important;
    background: #82CCDD;
  }

  .chat-area-text img{
    height: 30px;
  }
}

@media (max-width: 375px){
  #chat-area span{
    width: 100%;
  }

  .chat-area-text img{
    height: 20px;
    position: absolute;
  }

  .chat-area-text{
    position: relative;
    width: 245px;
  }

  .providerAvatar{
    margin-right: 20px !important;
  }

  .requestorAvatar {
    margin-left: -20px;
  }

  #chat-area .chat-requestor span{
    margin-left: -15px;
    margin-top: 10px;
    width: 125%;
  }

  .chat-provider span {
      margin-left: -10px !important;
      margin-top: 7px !important;
  }

}

@media (max-width: 320px){
  #chat-area span { 
    padding: 4px 8px; 
    -moz-border-radius: 5px; 
    -webkit-border-radius: 8px; 
    margin: 0 ; 
    margin-left: 0px;
    width: 100%;
  }

  .chat-area-text {
      width: 190px;
  }

}


/* new start chat*/
 .message-input {
    position: absolute;
    bottom: -35px;
    width: 100%;
    z-index: 99;
}

 .message-input .wrap {
    position: relative;
    display: flex;
}

.message-input .wrap input {
    font-family: "proxima-nova", "Source Sans Pro", sans-serif;
    float: left;
    border: none;
    width: calc(100% - 90px);
    padding: 11px 32px 10px 8px;
    font-size: 0.8em;
    color: #32465a;
}

#sendie {
    box-sizing: border-box;
}

#sendie {
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto;
    color: -internal-light-dark-color(black, white);
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: start;
    -webkit-appearance: textfield;
    background-color: -internal-light-dark-color(rgb(255, 255, 255), rgb(59, 59, 59));
    -webkit-rtl-ordering: logical;
    cursor: text;
    margin: 0em;
    font: 400 13.3333px Arial;
    padding: 1px 2px;
    border-width: 2px;
    border-style: ridge;
    border-color: -internal-light-dark-color(rgb(118, 118, 118), rgb(195, 195, 195));
    border-image: initial;
}
 .message-input .wrap button {
    float: right;
    border: none;
    width: 50px;
    padding: 12px 0;
    cursor: pointer;
    background: #32465a;
    color: #f5f5f5;
}

.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

#chat-wrap {
  background-image: url("{{ asset('public/img-resources/chat-backdrop.png') }}");
  background-position: bottom;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
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
                            <div class="panel-heading for-mobile" data-toggle="collapse" data-target="#chatHeads">
                                <span class="caption-subject font-blue-steel bold uppercase"> <i class="fa fa-tv"></i>{{ App\CompanyProfile::getCompanyName($company_id) }}</span>
                            </div>
                            <div class="panel-heading for-desktop">
                                <span class="caption-subject font-blue-steel bold uppercase"> <i class="fa fa-tv"></i>{{ App\CompanyProfile::getCompanyName($company_id) }}</span>
                            </div>
                            <div class="panel-body chat-head collapse"  id="chatHeads" >
                            <?php
                                if ($chatHeads->count() > 0):
                                    foreach ($chatHeads as $heads):
                                        $date = date("F j, Y, g:i a", strtotime($heads->created_at));

                                        $avatar = \App\UploadImages::where('company_id', $heads->sender)->where('file_category', 'PROFILE_AVATAR')
                                            ->orderBy('id', 'desc')
                                            ->first();
                                        $avat = '';
                                        if (!isset($avatar->file_name)) 
                                            $avatarUrl = asset('public/images/industry')."/guest.png";
                                        else 
                                            $avatarUrl = asset('public/images')."/".$avatar->file_name;
                                            
                                        

                                ?>
                                <ul class="feeds list-group" style="border-style:none; margin-bottom: 5px;" onclick="loadChat('{{ $avatarUrl }}', '{{ $heads->opp_title }}', '{{ $heads->company_id }}', '{{ $heads->sender }}','{{ $heads->receiver }}', '{{ $heads->opp_type }}', '{{ $heads->head_id }}')">
                                    <li class="list-group-item">
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                            <img id="chatAvatar_{{ $heads->sender. $heads->receiver }}" class='chatAvatar' src="{{ $avatarUrl }}">
                                                    
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> <span style="font-size: 9px">{{ $date }}</span></div>
                                            </div>
                                            <div class="col3">
                                              <i data-count="{{ App\ChatHistory::getStatusCount($heads->head_id) }}" class="fa fa-envelope fa-2x fa-border icon-grey badge-msg"></i>
                                            </div>
                                            <div class="text-container-col-4">
                                                <div class="cont-col2 ">
                                                    <div class="desc h-effect"><strong> {{ App\CompanyProfile::getCompanyName($heads->sender) }}</strong></div>
                                                </div>
                                                <div class="cont-col2 ">
                                                    <div class="desc h-effect"> {{ $heads->opp_title }}</div>
                                                </div>
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

                                    <div class="message-input">
                                        <div class="wrap">
                                            <input id="sendie" type="text" placeholder="Write your message here..." disabled="disabled">
                                            {{-- <textarea id="sendie" placeholder="Type your message here..." maxlength = '100' rows="2" ></textarea> --}}
                                            <button title="Send" id='sendMessage' class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                        </div>
                                    </div>

                                      <div class="send-msg-container" style="display: none;">
                                        <form id="send-message-area">
                                            <textarea id="sendie" placeholder="Type your message here..." maxlength = '100' rows="3" ></textarea>
                                            <input type="hidden" id="chat-companyViewer">
                                            <input type="hidden" id="chat-companyOpp">
                                            <input type="hidden" id="chat-oppId">
                                            <input type="hidden" id="chat-oppType">
                                            <input type="hidden" id="chat-headId">
                                        </form>
                                      </div>
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
                    {{--         <div class="table-scrollable">
                                
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
        
        $(document).ready(function () {
            chat.getAllState(); 
            // chat.chatHead();
           setInterval('chat.chatHead( )', 1000);
        });

        function loadChat(avatarUrl, title,companyOpp,companyViewer,oppId,oppType,headId){
            $('.chatOppTitle').text(title);
            $('#chatAvatar_'+companyViewer+oppId).attr('src',avatarUrl);
            $('#chat-companyOpp').val(companyOpp);
            $('#chat-companyViewer').val(companyViewer);
            $('#chat-oppId').val(oppId);
            $('#chat-oppType').val(oppType);
            $('#chat-headId').val(headId);

            $('#chat-area').empty();

            $('#sendie').prop("disabled", false);

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
       // watch textarea for key presses
        $("#sendie").keydown(function(event) {  
            var key = event.which;  
            //all keys including return.  
            if (key >= 33) {
                //var maxLength = $(this).attr("maxlength");  
                var length = this.value.length;  
                // don't allow new content if length is maxed out
                if (length >= 200) {  
                    event.preventDefault();  
                }  
            }  
        });

       // watch textarea for release of key press
       $('#sendie').keyup(function(e) { 
            if (e.keyCode == 13) { 
                var text = $(this).val();
                //var maxLength = $(this).attr("maxlength");  
                var length = text.length; 
                // send 
                if (length > 1) { 
                    chat.send(text, name);  
                    $(this).val("");
                } 
                    // $(this).val(text.substring(0, maxLength));
                    //event.preventDefault(); 
            }
        });

       // watch textarea for release of key press
       $('#sendMessage').click(function(e) { 

            var text = $('#sendie').val();
            //var maxLength = $('#sendie').attr("maxlength");  
            var length = text.length; 
            // send 
            if (length > 1) { 
                chat.send(text, name);  
                $('#sendie').val("");
            } 
                // $("#sendie").val(text.substring(0, maxLength));
                //event.preventDefault(); 
            
        });


    });

    function NotifyError(){
        swal({
            title:"An error occured!", 
            text: "Reloading the page now!",
            icon: "warning",
            dangerMode: true,

          }).then(function(isConfirm) {
                location.reload();
        });
    }

var instanse = false;
var overAllInstance = false;
var state;
var overAllState;
var overAllChatStatus;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
    this.getState = getStateOfChat;
    this.getAllState = getAllStateofCompanyChat;
    this.chatHead = udpateChatHeads;
    this.onload = chatload;
}

function setStatustoSeen(sender, receiver, opp_type, headId){
      formData = new FormData();
      formData.append("function", 'setStatusToSeen');
      formData.append("sender", sender);
      formData.append("receiver", receiver);
      formData.append("opp_type", opp_type);
      formData.append("head_id", headId);

        $.ajax({
              url: "{{ route('chatSetStatus') }}",
              type: "POST",
              data: formData,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (data) {
                console.log(data);

              },
                error: function(){
                NotifyError();
            }
        });
}

function getAllStateofCompanyChat(){
      formData = new FormData();
      formData.append("function", 'getAllState');

        $.ajax({
              url: "{{ route('chatProcessHead') }}",
              type: "POST",
              data: formData,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (data) {
                console.log(data);
                overAllState = data.overAllState;
                overAllChatStatus = data.overAllChatStatus;
                overAllInstance = false;
                //chat.chatHead();
              },
                error: function(){
                NotifyError();
            }
        });
}


function udpateChatHeads(){

   if(!overAllInstance){
     overAllInstance = true;
      formData = new FormData();
      formData.append("function", 'updateChatHeads');
      formData.append("overAllState", overAllState);
      formData.append("overAllChatStatus", overAllChatStatus);
      
      $.ajax({
          url: "{{ route('chatProcessHead') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {

            if(data.text != false){
                            console.log(data);
            console.log("udpateChatHeads");
                   $('.chat-head').empty();
            
                for (var i = 0; i < data.text.length; i++) {
                      $('.chat-head').append($(`
                        <ul class="feeds list-group" style="border-style:none; margin-bottom: 5px;" onclick="loadChat('`+data.text[i].avatarUrl+`', '`+data.text[i].opp_title+`', '`+data.text[i].company_id+`', '`+data.text[i].sender+`','`+data.text[i].receiver+`', '`+data.text[i].opp_type+`', '`+data.text[i].head_id+`')">
                                    <li class="list-group-item">
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                            <img id="chatAvatar_`+data.text[i].sender+data.text[i].receiver+`" class='chatAvatar' src="`+data.text[i].avatarUrl+`">
                                                    <div class="cont-col2 ">
                                                        <div class="desc h-effect"><strong> `+data.text[i].company_name+`</strong></div>
                                                    </div>
                                                    <div class="cont-col2 ">
                                                        <div class="desc h-effect"> `+data.text[i].opp_title+`</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                              <div class="date"> <span style="font-size: 9px">`+data.text[i].date+`</span></div>
                                            </div>
                                            <div class="col3">
                                              <i data-count="`+data.text[i].status+`" class="fa fa-envelope fa-2x fa-border icon-grey badge-msg"></i>
                                            </div>
                                        </a>
                                    </li>
                                </ul>`));
                }    
           }

           overAllInstance = false;
           overAllState = data.overAllState;
            overAllChatStatus = data.overAllChatStatus;

          },
            error: function(){
                NotifyError();
            }
      });

   }
   else {
     setTimeout(udpateChatHeads, 1500);
   }
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
          },
            error: function(){
                NotifyError();
            }
      });

  }  
}

function chatload(){
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();
    var headId = $("#chat-headId").val();
    var requestorAvatar = $('#chatAvatar_'+companyViewer+oppId).attr('src');

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
                    if(data.text[i].action == 1){
                      $('#chat-area').append($("<div class='chat-area-text chat-requestor'><img class='requestorAvatar' src='"+requestorAvatar+"' /><span><h6>"+data.text[i].sender+ "</h6><p>"+ data.text[i].text +"</p></span></div>"));
                    }else{
                      $('#chat-area').append($("<div class='chat-area-text chat-provider'><span><h6>"+data.text[i].sender+"</h6><p>"+ data.text[i].text +"</p></span><img class='providerAvatar' src='http://placehold.it/50/FA6F57/fff&text=ME'  /></div>"));
                    }
                }    
            document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
           }

          },
            error: function(){
                NotifyError();
            }
      });

      setStatustoSeen(companyViewer,oppId,oppType,headId);
}

//Updates the chat
function updateChat(){
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();
    var requestorAvatar = $('#chatAvatar_'+companyViewer+oppId).attr('src');

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
                    if(data.text[i].action == 1){
                      $('#chat-area').append($("<div class='chat-area-text chat-requestor'><img class='requestorAvatar' src='"+requestorAvatar+"' /><span><h6>"+data.text[i].sender+ "</h6><p>"+ data.text[i].text +"</p></span></div><hr>"));
                    }else{
                      $('#chat-area').append($("<div class='chat-area-text chat-provider'><span><h6>"+data.text[i].sender+data.text[i].action+ "</h6><p>"+ data.text[i].text +"</p></span><img class='providerAvatar' src='http://placehold.it/50/FA6F57/fff&text=ME' /></div><hr>"));
                    }
                }    
            document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
           }
           instanse = false;
           state = data.state;

          },
            error: function(){
                NotifyError();
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
        },
            error: function(){
                NotifyError();
            }
    });

}

    </script>

    <!-- END PAGE LEVEL PLUGINS -->
@endsection