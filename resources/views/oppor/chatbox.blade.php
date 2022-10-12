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
  /*-moz-box-shadow: 0 0 1px 1px #31708f !important;
  -webkit-box-shadow: 0 0 1px 1px #31708f !important;
  /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
  box-shadow: 0 0 5px 0 #7cda24 !important;
  cursor: pointer !important;
}
.chat-head{
    min-height: 500px;
    height: 450px;
    overflow-x: scroll;
}

  /*for chat box area*/

#page-wrap  { 
    /*width: 85%; */
    margin: 10px auto; 
    position: relative; 

    /*margin-bottom: 90px;*/
}

#chat-wrap { 
    /*border: 1px solid #eee; */

    margin: 0 0 15px 0; 
}

#chat-area { 
    height: 70vh; 
    overflow: auto; 
    padding: 20px; 
     /*background: #E5DDD5; */
}

.list-group-item:hover{
    border-shadow:none !important
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
    /*border: 3px solid #999; 
    width: 360px; 
    padding: 10px; 
    font-size: 15px;
    float: right; 

    width: 100% !important;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);*/
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
    /*background: #DCF8C6; */
}

.chat-requestor span{
  background: #dff7d9; 

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
.badge-msg, .badge-msg2 {   
    width:100px;
    text-align:center;
    vertical-align:middle;
    position: relative;
    font-size:30px !imprtant;
}
.badge-msg:after{
    content:attr(data-count);
    position: absolute;
    background: red;
    height:2rem;
    top: -1rem;
    right: -1.3rem;
    width:2rem;
    text-align: center;
    line-height: 2rem;;
    font-size: 1rem;
    border-radius: 50%;
    color:white;
    border:1px solid red;
        animation: beat .55s infinite alternate;
    transform-origin: center;
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
    /*background: #82CCDD;*/
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
.rounded-circle {
    border-radius: 50%!important;
}
.img-fluid, .img-thumbnail {
    max-width: 100%;
    height: auto;
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
    /*font-family: "proxima-nova", "Source Sans Pro", sans-serif;
    float: left;
    border: none;
    width: calc(100% - 90px);
    padding: 11px 32px 10px 8px;
    font-size: 0.8em;
    color: #32465a;*/
}

#sendie {
    
}

#sendie {
    /*-webkit-writing-mode: horizontal-tb !important;
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
    border-image: initial;*/
    height:45px;
}
 .message-input .wrap button {
    float: right;
    border: none;
    width: 50px;
    padding: 12px 0;
    cursor: pointer;
    background: black;
    color: #f5f5f5;
}
.portlet.light{
    padding:none !important;
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

#chat-area .chat-intro-text  { 
    background: #FFFFFF;
    padding: 10px;
    box-shadow: 0 0 5px 0 #707080 !important;
    text-align: center;
    line-height: 1.5;
    margin-bottom: 3em;
    color: #827e7e;
    font-size: 14px;
}

.circle {
    border: 2px solid #7cda24 !important;
    border-radius: 50% !important;
    display: inline-block;
    width:100px !important;
    height:100px !important;
    background-position: center;
      background-size: cover;
      background-color:white;
}
.circle img {
}

.my-3{
    text-transform:uppercase;
    font-size:14px !important;
    color:black ;
    font-weight:bold
    ;
}

.opp_title_txt{
    text-transform:uppercase;
    font-size:13px !important;
    color:black ;
}

.feeds li{
    /*background-color: #dff7d9 ;*/
}

.chathead_selected{
    background:black !important;
}
.chathead_selected .my-3, .chathead_selected .company_name_label{
    /*border: 3px solid black !important;*/
    
    color:white !important;
}

.chat_date{
    font-size:10px;
    margin-left:10px;
}

    </style>
    
   
<?php
$userType = App\User::validateAccountNavigations(Auth::id());
                                                $main_profile_pic = "";
                                                $company_id = App\CompanyProfile::getCompanyId(Auth::id());
                                                $company_name_me = App\CompanyProfile::find($company_id)->company_name;
                                                
                                                if($userType == 1){
                                                    $profilePic = App\CompanyProfile::getProfileImage(Auth::id());
                                                    if($profilePic != null){
                                                        $main_profile_pic = $profilePic;
                                                    } else { 
                                                        $main_profile_pic = "robot.jpg";
                                                    }
                                                } else if($userType == 2){
                                                    $profilePicSC = App\CompanyProfile::getProfileImageSC(Auth::id());
                                                    if($profilePicSC != null){
                                                        $main_profile_pic = $profilePicSC;
                                                    } else {
                                                        $main_profile_pic = "robot.jpg";
                                                    }
                                                } else if($userType == 3){
                                                    $profilePicMC = App\CompanyProfile::getProfileImageMC(Auth::id());
                                                    if($profilePicMC != null){
                                                        $main_profile_pic = $profilePicMC;
                                                    } else { 
                                                     }
                                                }
                                                ?>
                                                
                                                

    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ url('/home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Messages
        </li>

    </ul>
    <div class="container" style="">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="portlet light " style=";">
                    <div class="card" style="width: 100%;">

                        <div class="panel h-effect" style="border:1px solid silver !important">
                            <div class="panel-heading for-mobile bg-dark text-white" style="border-bottom:1px solid white" data-toggle="collapse" data-target="#chatHeads">
                                <span class="caption-subject bold uppercase"> <i class="fa fa-tv">&nbsp;</i>CHAT LIST - (Click To View)</span>
                            </div>
                            <div class="panel-heading for-desktop bg-dark text-white" style="border-bottom:1px solid white">
                                <span class="caption-subject bold uppercase"> <i class="fa fa-tv">&nbsp;</i>CHAT LIST</span>
                            </div>
                            <div class="panel-body chat-head collapse "  id="chatHeads" >
                            <?php
                                if ($chatHeads->count() > 0):
                                    foreach ($chatHeads as $heads):
                                        $date = date("F j, Y, g:i a", strtotime($heads->created_at));
                                        
                                        $com_name = "";
                                        
                                        if($company_id == $heads->sender){
                                            $avatar = \App\UploadImages::where('company_id', $heads->company_id)
                                            	->where('file_category', 'PROFILE_AVATAR')
                                                ->orderBy('id', 'desc')
                                                ->first();
                                                
                                            $com_name = App\CompanyProfile::find($heads->company_id)->company_name;
                                        }
                                        else{
                                            $avatar = \App\UploadImages::where('company_id', $heads->sender)
                                            	->where('file_category', 'PROFILE_AVATAR')
                                                ->orderBy('id', 'desc')
                                                ->first();
                                            $com_name = App\CompanyProfile::find($heads->sender)->company_name;
                                        }
                                            
                                        $avat = '';
                                        if (!isset($avatar->file_name)) 
                                            $avatarUrl = asset('public/images/industry')."/guest.png";
                                        else 
                                            $avatarUrl = asset('public/images')."/".$avatar->file_name;
                                            
                                        
                                        
                                        $action_code = "0";
                                        if($company_id == $heads->sender ){
            		                          $action_code = "1";
            		                    }
            		                    else{
            		                        $action_code = "2";
            		                    }
                                ?>
                                <ul id="head_{{ $heads->head_id }}" class="feeds list-group" name="{{ $heads->sender }}<split>{{ $heads->receiver }}<split>{{ $heads->opp_type }}<split>{{ $heads->head_id }}" style="border-style:none; margin-bottom: 5px;" onclick="loadChat('{{ $avatarUrl }}', '{{ $heads->opp_title }}', '{{ $heads->company_id }}', '{{ $heads->sender }}','{{ $heads->receiver }}', '{{ $heads->opp_type }}', '{{ $heads->head_id }}', '{{ $action_code }}', '{{ $com_name }}')">
                                    <li class="list-group-item">
                                        
                                        <div class="card mb-4">
                                          <div class="card-body text-center">
                                        
                                            <div id="chatAvatar_{{ $heads->sender. $heads->receiver }}" class="circle" style="background-image: url( '{{ $avatarUrl }}' );">
                                                
                                              </div>
                                              
                                            <h5 class=" my-3">{{ $com_name }}</h5>
                                            <p class="opp_title_txt mb-1 company_name_label">{{ $heads->opp_title }}</p>
                                            <?php if(App\ChatHistory::getStatusCount($heads->head_id) > 0){ ?>
                                            <p class="text-muted mb-4"><h3><i data-count="{{ App\ChatHistory::getStatusCount($heads->head_id) }}" style="font-size:30px !imprtant;" class="fa fa-envelope fa-2x fa-border icon-grey badge-msg"></i></h3></p>
                                            <?php }else{ ?>
                                            <p class="text-muted mb-4"><h3><i data-count="{{ App\ChatHistory::getStatusCount($heads->head_id) }}" style="font-size:30px !imprtant;" class="fa fa-envelope fa-2x fa-border icon-grey badge-msg2"></i></h3></p>
                                            <?php } ?>
                                            <div class="d-flex justify-content-center mb-2">
                                                
                                            </div>
                                          </div>
                                        </div>
                                        
                                        
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
                    <div class="caption text-white bg-dark" style="padding:10px;border-radius:3px">
                        <i class="fa fa-user"></i>
                        <span class="caption-subject bold uppercase" id="chat_name_span">Chat Box </span>
                    </div>
                    <div class="portlet-body">
                                <div class="modal-body">
                                  <div id="page-wrap">
                            
                                      
                                      <p id="name-area"></p>
                                      
                                      <div id="chat-wrap"><div id="chat-area"></div></div>

                                    <div class="message-input">
                                        <div class="wrap input-group">
                                            <input id="sendie" type="text" class="form-control" placeholder="Write your message here..." disabled="disabled">
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
                                            <input type="hidden" id="chat-action_code">
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
<input type="hidden" id="selected_chat_heads_hidden" />

    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
        
        $(document).ready(function () {
            chat.getAllState(); 
            // chat.chatHead();
           setInterval('chat.chatHead( )', 1000);
           
           //$("body").on("click", "ul.feeds:eq(0)");
           $("ul.feeds:eq(0)").trigger("click");
        });

        function loadChat(avatarUrl, title,companyOpp,companyViewer,oppId,oppType,headId, action_code, company_name){
            $(".feeds li").removeClass("chathead_selected");
            $("#head_"+headId + " li").addClass("chathead_selected");
            
            $("#selected_chat_heads_hidden").val("head_"+headId);
            
            $('.chatOppTitle').text(title);
            $('#chatAvatar_'+companyViewer+oppId).attr('src',avatarUrl);
            $('#chat-companyOpp').val(companyOpp);
            $('#chat-companyViewer').val(companyViewer);
            $('#chat-oppId').val(oppId);
            $('#chat-oppType').val(oppType);
            $('#chat-headId').val(headId);
            $('#chat-action_code').val(action_code);

            $('#chat-area').empty();
            $("#chat-area").append(`
                <p class="chat-intro-text">
                    Congrats for finding your potential business match!
                    Your opportunity has received a request! 
                    Start connecting by providing more detail about your opportunity and answer any questions that the requestor presents to you.
                    Good luck!  
                </p>
                `);
            $('#sendie').prop("disabled", false);
            
            $("#chat_name_span").html(title + " <i>(" + company_name + ")</i>");

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
            if($("#selected_chat_heads_hidden").val() != ""){
                $( "#" + $("#selected_chat_heads_hidden").val() + " li" ).addClass("chathead_selected");
            }
            if(data.text != false){
                            console.log(data);
            console.log("udpateChatHeads");
                   $('.chat-head').empty();
            
                for (var i = 0; i < data.text.length; i++) {
                    var message_icon = '';
                    if(parseInt(data.text[i].status) > 0){
                        if($("#selected_chat_heads_hidden").val() == "head_"+data.text[i].head_id){
                            
                            setStatustoSeen(data.text[i].sender,data.text[i].receiver,data.text[i].opp_type,data.text[i].head_id);
                            message_icon = '<i data-count="'+data.text[i].status+'" style="font-size:30px !imprtant;" class="fa fa-envelope fa-2x fa-border icon-grey badge-msg2"></i>';
                        }
                        else{
                            message_icon = '<i data-count="'+data.text[i].status+'" style="font-size:30px !imprtant;" class="fa fa-envelope fa-2x fa-border icon-grey badge-msg"></i>';
                        }
                    }
                    else{
                         message_icon = '<i data-count="'+data.text[i].status+'" style="font-size:30px !imprtant;" class="fa fa-envelope fa-2x fa-border icon-grey badge-msg2"></i>';
                    }
                    
                      $('.chat-head').append($(`
                        <ul id="head_`+data.text[i].head_id+`" class="feeds list-group" style="border-style:none; margin-bottom: 5px;" name="`+data.text[i].sender+`<split>`+data.text[i].receiver+`<split>`+data.text[i].opp_type+`<split>`+data.text[i].head_id+`" onclick="loadChat('`+data.text[i].avatarUrl+`', '`+data.text[i].opp_title+`', '`+data.text[i].company_id+`', '`+data.text[i].sender+`','`+data.text[i].receiver+`', '`+data.text[i].opp_type+`', '`+data.text[i].head_id+`', '`+data.text[i].action_code+`', '`+data.text[i].company_name+`')">
                                    <li class="list-group-item">
                                    <div class="card mb-4">
                                          <div class="card-body text-center">
                                            <div class="circle" id="chatAvatar_`+data.text[i].sender+data.text[i].receiver+`" style="background-image: url( '`+data.text[i].avatarUrl+`')">
                                            </div>
                                              
                                            <h5 class="my-3">`+data.text[i].company_name+`</h5>
                                            <p class="opp_title_txt mb-1 company_name_label">`+data.text[i].opp_title+`</p>
                                            <p class=" mb-4"><h3>`+message_icon+`</h3></p>
                                            <div class="d-flex justify-content-center mb-2">
                                                
                                            </div>
                                          </div>
                                        </div>
                                        
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
          url: "{{ route('chatProcess2') }}",
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
          url: "{{ route('chatProcess2') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
            if($("#selected_chat_heads_hidden").val() != ""){
                $( "#" + $("#selected_chat_heads_hidden").val() + " li" ).addClass("chathead_selected");
            }
            if(data.text != false){
                $('#chat-area').empty();
                $("#chat-area").append(`
                <p class="chat-intro-text">
                    Congrats for finding your potential business match!
                    Your opportunity has received a request! 
                    Start connecting by providing more detail about your opportunity and answer any questions that the requestor presents to you.
                    Good luck!  
                </p>
                `);
                for (var i = 0; i < data.text.length; i++) {
                    if(data.text[i].action == 1){
                      $('#chat-area').append($("<div class='chat-area-text chat-requestor'><img class='requestorAvatar' src='"+requestorAvatar+"' /><span><h6>"+data.text[i].sender+ "</h6><p>"+ data.text[i].text +" <b class='chat_date'><i class='fa fa-clock-o'></i> "+ data.text[i].date_chat +"</b> </p></span></div>"));
                    }else{
                      $('#chat-area').append($("<div class='chat-area-text chat-provider '><span class='bg-dark text-white'><h6>{{$company_name_me}}</h6><p>"+ data.text[i].text +" <b class='chat_date'><i class='fa fa-clock-o'></i> "+ data.text[i].date_chat +"</b></p></span><img class='providerAvatar' src='{{ asset('public/images') . "/" . $main_profile_pic }}'  /></div>"));
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

function getBackgroundImageUrl($element) {
    if (!($element instanceof jQuery)) {
      $element = $($element);
    }

    var imageUrl = $element.css('background-image');
    return imageUrl.replace(/(url\(|\)|'|")/gi, ''); // Strip everything but the url itself
  }

//Updates the chat
function updateChat(){
    var companyOpp = $("#chat-companyOpp").val();
    var companyViewer = $("#chat-companyViewer").val();
    var oppId = $("#chat-oppId").val();
    var oppType = $("#chat-oppType").val();
    var requestorAvatar = getBackgroundImageUrl('#chatAvatar_'+companyViewer+oppId);  //$('#chatAvatar_'+companyViewer+oppId).attr('src');

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
          url: "{{ route('chatProcess2') }}",
          type: "POST",
          data: formData,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (data) {
            if($("#selected_chat_heads_hidden").val() != ""){
                $( "#" + $("#selected_chat_heads_hidden").val() + " li" ).addClass("chathead_selected");
                
            }
            if(data.text != false){
                $('#chat-area').empty();
                $("#chat-area").append(`
                <p class="chat-intro-text">
                    Congrats for finding your potential business match!
                    Your opportunity has received a request! 
                    Start connecting by providing more detail about your opportunity and answer any questions that the requestor presents to you.
                    Good luck!  
                </p>
                `);
                for (var i = 0; i < data.text.length; i++) {
                    if(data.text[i].action == 1){
                      $('#chat-area').append($("<div class='chat-area-text chat-requestor'><img class='requestorAvatar' src='"+requestorAvatar+"' /><span><h6>"+data.text[i].sender+ "</h6><p>"+ data.text[i].text +" <b class='chat_date'><i class='fa fa-clock-o'></i> "+ data.text[i].date_chat +"</b></p></span></div>"));
                    }else{
                      $('#chat-area').append($("<div class='chat-area-text chat-provider '><span class='bg-dark text-white'><h6>{{$company_name_me}}</h6><p>"+ data.text[i].text +" <b class='chat_date'><i class='fa fa-clock-o'></i> "+ data.text[i].date_chat +"</b></p></span><img class='providerAvatar' src='{{ asset('public/images') . "/" . $main_profile_pic }}' /></div>"));
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
    formData.append("chatAction", $('#chat-action_code').val());
    
    $.ajax({
        url: "{{ route('chatProcess2') }}",
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