@extends('layouts.app')



@section('content')



    <link href="{{ asset('public/mini-upload/assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/css/profileedit.css')}}">



    <link rel="stylesheet" href="{{asset('public/css/edit-profile.css')}}">


    <link href="{{asset('public/canva/css/piechart.css')}}">
    <script src="{{ asset('public/canva/js/donutty.js') }}"></script>
    <script src="{{ asset('public/canva/js/vanilla.js') }}"></script>



<style>
.loading {
      position: fixed;
      z-index: 999;
      height: 2em;
      width: 2em;
      overflow: show;
      margin: auto;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
    }
    /* Transparent Overlay */
    .loading:before {
      content: '';
      display: block;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
        background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));
    
      background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
    }
    
    /* :not(:required) hides these rules from IE9 and below */
    .loading:not(:required) {
      /* hide "loading..." text */
      font: 0/0 a;
      color: transparent;
      text-shadow: none;
      background-color: transparent;
      border: 0;
    }
    
    .loading:not(:required):after {
      content: '';
      display: block;
      font-size: 10px;
      width: 1em;
      height: 1em;
      margin-top: -0.5em;
      -webkit-animation: spinner 150ms infinite linear;
      -moz-animation: spinner 150ms infinite linear;
      -ms-animation: spinner 150ms infinite linear;
      -o-animation: spinner 150ms infinite linear;
      animation: spinner 150ms infinite linear;
      border-radius: 0.5em;
      -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
    box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
    }
    
    /* Animation */
    
    @-webkit-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @-moz-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @-o-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    
.pie {
            background-color: #7cda24;
            width: 200px;
            height: 200px;
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            position: relative;
        }

        .clip1 {
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
            height: 200px;
            clip: rect(0px, 200px, 200px, 100px);
        }

        .slice1 {
            position: absolute;
            width: 200px;
            height: 200px;
            clip: rect(0px, 100px, 200px, 0px);
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            background-color: #dff7d9;
            border-color: #F0A22E;
            -moz-transform: rotate(0);
            -webkit-transform: rotate(0);
            -o-transform: rotate(0);
            transform: rotate(0);
        }

        .clip2 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            clip: rect(0, 100px, 200px, 0px);
        }

        .slice2 {
            position: absolute;
            width: 200px;
            height: 200px;
            clip: rect(0px, 200px, 200px, 100px);
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            background-color: #F0A22E;
            border-color: #F0A22E;
            -moz-transform: rotate(0);
            -webkit-transform: rotate(0);
            -o-transform: rotate(0);
            transform: rotate(0);
        }

        .status {
            position: absolute;
            height: 30px;
            width: 200px;
            line-height: 60px;
            text-align: center;
            top: 50%;
            color: black;
            margin-top: -35px;
            font-size: 25px;
            font-weight: 600;
        }

        html, body {

            width: 100%;

            height: 100%;

            margin: 0px;

            padding: 0px;

            overflow-x: hidden;

            overflow: visible;

        }

       .containerCimg

       {



       }

       .actionCimg

       {

           width: 300px;

           height: 100% !important;

           margin: 5px 0;

           float: none !important;

            padding: 10px;

       }

       .croppedCimg>img

       {

           margin-right: 10px;

       }



       .niceDisplay{

                  font-family: 'PT Sans Narrow', sans-serif;

                   font-weight: bold;

                   font-size: 15px;

                   background-color: white;

                   padding: 30px;

                   border-radius: 3px;

                   box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

                   text-align: center;

                   color: orangered;

        }



        #edit_icon{

            cursor: pointer;

        }



        /* Outer */

        .popup {

        width:100%;

        height:100%;

        display:none;

        position:fixed;

        top:0px;

        left:0px;

        background:rgba(0,0,0,0.75);

        }



        /* Inner */

        .popup-inner {

        max-width:700px;

        width:90%;

        padding:40px;

        position:absolute;

        top:50%;

        left:50%;

        -webkit-transform:translate(-50%, -50%);

        transform:translate(-50%, -50%);

        box-shadow:0px 2px 6px rgba(0,0,0,1);

        border-radius:3px;

        background:#fff;

        }



        /* Close Button */

        .popup-close {

        width:30px;

        height:30px;

        padding-top:4px;

        display:inline-block;

        position:absolute;

        top:0px;

        right:0px;

        transition:ease 0.25s all;

        -webkit-transform:translate(50%, -50%);

        transform:translate(50%, -50%);

        border-radius:1000px;

        background:rgba(0,0,0,0.8);

        font-family:Arial, Sans-Serif;

        font-size:20px;

        text-align:center;

        line-height:100%;

        color:#fff;

        }



        .popup-close:hover {

        -webkit-transform:translate(50%, -50%) rotate(180deg);

        transform:translate(50%, -50%) rotate(180deg);

        background:rgba(0,0,0,1);

        text-decoration:none;

        }


        .popup-inner{
            float:left;
            width:100%;
            overflow-y: auto;
            height: 95%;
        }

        .forDesktop{
            display: none;
        }

        .forMobile{
            display: block;
        }

        .card-body ul li i{
            color: red;
        }

        .card-body ul li{
            font-size: 14px;
            display: flex;
        }

        .profCompleteness{
            display: inline-grid ;
            width:100%;
            border:1px solid silver !important;
            padding:15px;
            border-radius:5px;
        }

        .busineNews {
            line-height: 25px;
        }

        .read_more {
            margin-left: 15px;
        }

        .card-title h1{
            font-size: 4em;
            font-weight: 500;
        }

        /*li.active {
            background-color: black !important;
        }

        li.active a {
            color: #EFF3F8 !important;
            font-weight: 700 !important;
        }*/
        .nav-tabs>li.active{
                border-bottom:4px solid #7cda24 !important;
            }
            
            .nav-tabs>li:hover{
                border-bottom:4px solid black !important;
            }

        .actionImg input#btnCrop{
            width: 30%;
            margin-right: 25px;
        }

        .actionImg input.btn-info{
            width: 20%;
            font-size: 30px;
            height: 35px;
            line-height: 0px !important;
        }

        .actionImg p{
            font-size: 12px;
            color: red;
            font-weight: 600;
            font-style: italic;
            margin-top: -3px;
        }

        .table-outer{
            width: 100%;
            height: 100%;
            /*white-space: nowrap;*/
            position: relative;
            overflow-x: scroll;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .table-inner {
            width: 100%;
            background-color: #eee;
            float: none;
            height: 90%;
            margin: 0 0.25%;
            display: inline-block;
            zoom: 1;
        }
    .containerCimg {
        margin: 0 auto;
        
    }
    
    .imageBoxCimg{
        border-radius:5px !important;
    }

@media (max-width: 346px){
    .container{
        padding-left: 5px;
    }
}

@media (max-width: 640px){
    .table-inner {
        width: 500px;
    }

    .sticky-row {
      position: sticky;
      position: -webkit-sticky;
      left: 0;
      background-color: #EEEEEE;
      z-index: 3;
      border: 3px solid #FFFFFF!important;
    }
}

#upload a, #upload1 a, #upload2 a, #upload3 a{
    background:black !important;
}

.link_btn a{
    background:none !important;
}

.progress-bar{
    background-color:black !important;
    color:#7cda24 !important;
}


.page-content-inner{
    border:1px solid silver;
    border-radius:5px;
    padding:15px;
}

.card{
        border:1px solid silver;
        border-radius:5px;
    }  
    .card-body{
        padding:20px;
    }  
    
    .pieLabel{
        font-weight:bold !important;
        font-size:12px !important;
    }
    
    #flotTip {
        padding: 6px 15px;
        background-color: black;
        z-index: 100;
        color: white;
    }
    
    #company_primary_country_chartLegend td {display: inline-block;}
    
    .legendColorBox > div{
        padding:0px !important;
    }
    
    .legendColorBox > div > div{
        border-width:8px !important;
    }
    
    .mb-2{
        margin-bottom:10px;
    }
    
    #yourBtn {
      top: 150px;
      font-family: calibri;
      padding: 10px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border: 1px dashed #BBB;
      text-align: center;
      background-color: #DDD;
      cursor: pointer;
    }
    
    .form-group label{
        color:black !important;
        text-transform:uppercase;
    }
    
     .fit {
       width:1% !important;
       white-space: nowrap !important;
     }
    
    .table th {
      color: #7cda24 !important;
      background:black !important;
    }
    
    #key_personel_table th{
        font-size:12px;
    }
    
    #key_personel_table td{
        font-size:11px;
    }

.procedure_img{
        width:50%;margin-left:20px;
        border:1px solid silver;
    }
    
    #hidden_fullscreen {
        z-index:9999999999999;
        display:none;
        background-color:rgb(0,0,0, 0.7);
        position:fixed;
        height:100%;
        width:100%;
        left: 0px;
        top: 0px;    
        text-align: center;
        justify-content: center;
    }
    .close_fullscreen {
        position: absolute;
        right: 5px;
        top: 5px;
        background: red;
        color: white;
        cursor: pointer;
        width: 35px;
        height: 35px;
        text-align: center;
        line-height: 30px;
        border-radius:50px;
        font-weight:bold;
    }
    
     .procedure_img:hover{
        cursor: pointer;
     }
     
     .loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

.amount_css{
    text-align:right !important;
}

.text-center{
    text-align:center !important;
}
</style>
<div class="loading text-company" style="display:none;">Loading&#8230;</div>
<div class="loading text-company" style="display:none;">Loading&#8230;</div>
<!-- Modal -->
<div class="modal fade" style="z-index:9999999999998;" id="procedure_modal" tabindex="-1" role="dialog" aria-labelledby="procedure_modal_label" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:80%">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="procedure_modal_label">How to Connect to your Xero Account <i class="text-dark">(Click the image to enlarge)</i></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 1: </b> Go to <a class="" target="_blank" href="https://developer.xero.com/">https://developer.xero.com/</a></p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 2: </b> Click login.</p>
                <img class="img-fluid procedure_img"  src="{{ asset('public/assets/xero_images/login1.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 3: </b> Skip this step if you are already logged in. If not, enter your xero account.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/login.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 4: </b> Connect your organisation by clicking the button (Connect your Xero organisation). It will redirected you to a page which you need to allowed the API to have access to your organisation. Click the allow access to proceed.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step1.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 5: </b> After that, go to "My Apps" menu and click New app.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step2.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 6: </b> Provide App Name (App Name should based on your company/organisation name) and select Web App as integration type.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step3.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 7: </b> In the "Company or Application URL", copy and enter this link<br>
                
                <b>{{ env('APP_URL') }} <button name="{{ env('APP_URL') }}" class="copy_btn btn btn-xs btn-primary">COPY</button></b> 
                <br><br>
                and in "Redirect URL", copy and enter this link
                <br>
                <b>{{ env('APP_URL') }}profile/view <button name="{{ env('APP_URL') }}" class=" copy_btn btn btn-xs btn-primary">COPY</button></b>.</p>
                
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step4.png') }}" />
                
                <p>and click "Create App"</p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 8: </b> Under My Apps menu, go to Configuration.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step5.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 9: </b> Generate a secret id clicking "Generate a secret" <i>(Note: Please copy immediately the generated secret key and save it as it disappear once the page is loaded again).</i>.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step6.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 10: </b> You will now have a client id and secret id that is needed to connect your Xero account to Intellinz App.</i>.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step7.png') }}" />
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="hidden_fullscreen">
    <img id="fullscreen_img" class="img-fluid" style="width:90%;height:90%;margin-top:1%" />
<div class="close_fullscreen">X</div>
</div>

<script>
     $('.procedure_img').click( function(e) {
        $("#fullscreen_img").attr("src", $(this).attr("src"));
          e.preventDefault();
          $("#hidden_fullscreen").show();
          $("#hidden_fullscreen").css("display","flex")
      });
      $('.close_fullscreen').click(function(){
          $("#hidden_fullscreen").hide();
      });
      $(".copy_btn").click(function(){
          var val = $(this).attr("name");
          navigator.clipboard.writeText(val);

          alert("Copied the text: " + val);
      });
</script>
<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

<div class="modal fade" id="upload_pdf_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" >UPLOAD PDF</h4>
      </div>
      <div class="modal-body">
        <div class="">
            <form id="attachment_file_upload" method='POST' enctype="multipart/form-data" action="{{ route('processPDF') }}">
                {{ csrf_field() }}
            <div>
                <div class="fb-file form-group "><label for="attachment" class="fb-file-label">Upload PNG, JPG or PDF File<span class="fb-required">*</span><span class="tooltip-element" tooltip="choose your pdf">?</span></label>
                <input type="file" placeholder="choose your pdf" class="form-control" name="attachment_file" id="attachment_file"  title="choose your pdf" required="required" aria-required="true" />
                </div>
                <div class="fb-button form-group "><button type="submit" id="process_pdf_submit" class="btn btn-primary" name="submit_pdf" ><i class="fa fa-upload"></i> Upload</button></div>
            </div>
    </form>
    </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


    <link rel="stylesheet" href="{{ asset('public/js-tabs/jquery-ui.css') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">

<script src="{{asset('public/assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
                                    <script src="{{asset('public/assets/global/plugins/flot/jquery.flot.pie.min.js')}}" type="text/javascript"></script>
                                    <script src="{{asset('public/assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
                                    <script src="{{asset('public/assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
                                    <script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.tooltip.min.js"></script>
                                    <script src="http://thgreasi.github.io/growraf/javascripts/jquery.flot.growraf.js"></script>

    <div class="container">



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



        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

            <li>

                <a href="{{ url('/home') }}">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="#">Profile</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <span>Edit Profile</span>

            </li>

        </ul>



        <div id="msg"></div>



        <div class="row" >

            <!-- START IMAGE UPLOAD -->

            <div class="col-md-12 mb-2" >

                <div class="page-content-inner" >
                    <div  class="alert bg-dark text-white text-center" role="alert">
                        <b><i class="fa fa-edit"></i> EDIT YOUR COMPANY PROFILE</b>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-2" style="">
                            
                              <div class="card">
                                <div class="card-body">    
                            <?php 
                                $company_id_result = App\CompanyProfile::getCompanyId(Auth::id());
                                $validateAccount = App\SpentTokens::validateAccountActivation($company_id_result);
                            ?>
                            
                            @if($validateAccount != false)
                                <div class="containerCimg">
                            @else
                                <div class="containerCimg"  onclick="notifytoPremium()" >
                            @endif
                            
                            <div id="croppedCimg" class="croppedCimg" align="center"> </div>
                            
                            <center>
                                            <div class="imageBoxCimg">

                                                <div class="thumbBoxCimg"></div>

                                                <div class="spinnerCimg" style="display: none">Loading...</div>

                                            </div>
                                             </center>
                                             <center>
                                            <div class="actionCimg actionImg " style="">
                                                @if($validateAccount != false)
                                                <p> You can adjust the orientation/size of the image by clicking the <strong>"+"</strong> or <strong>"-"</strong> </p>
                                                    <button class="btn btn-primary " type="button" id="btnCrop"  title="UPLOAD" ><i class="fa fa-upload"></i> UPLOAD</button>
                                                    <input class="btn btn-primary fa-plus btn-info text-white" style="color:#7cda24 !important" type="button" id="btnZoomIn" value="+" title="ZOOM IN" >
                                                    <input class="btn btn-primary fa-plus btn-info text-white" style="color:#7cda24 !important" type="button" id="btnZoomOut" value="-" title="ZOOM OUT" >
                                                    {{-- <i class="fa fa-minus" aria-hidden="true"></i> --}}
                                                    {{-- <i class="fa fa-plus" aria-hidden="true"></i> --}}
                                                @else
                                                    <p> uploading of profie pictures requires a <strong>premium account</strong>.  </p>
                                                    <button class="btn btn-primary "  title="PREMIUM" />BECOME PREMIUM</button>
                                                @endif
                                            </div>
                                            </center>
                                            <center>
                                            <div class="actionCimg" >
                                                @if($validateAccount != false)
                                                    
                                                        <div id="yourBtn" class="bg-intellinz-light-green text-dark" style="height: 50px; width: 80%;border: 1px dashed #BBB; cursor:pointer;" onclick="getFile()"><i class="fa fa-image"></i>
                                                        <b>SELECT IMAGE!</b></div>
                                                    
                                                    <input type="file"  name="profile_img" id="file" style="float:left;display:none">
                                                @endif
                                            </div>
                                            </center>
                                        </div>
                            </div></div>
                        </div>
                        <div class="col-md-7">
                            <div class=" profCompleteness mb-2" style="">

                                        <h3 style="margin-top:0px !important" class="text-company"> PROFILE COMPLETENESS </h3>                                                                                                                              

                                        <div class="progress">



                                            <div class="progress-bar" role="progressbar" style="width:  <?= $completenessProfile; ?>%;" aria-valuenow="{{$completenessProfile}}" aria-valuemin="0"

                                                 aria-valuemax="100"><?php echo $completenessProfile; ?>%</div>

                                        </div>

                                        <div class="row" >
                                            <div class="col-md-5 mb-2">
                                                    <div class="piechart" >
                                                            <div class="wrapper">
                                                                <div title="{{$completenessProfile}}%"
                                                                    data-donutty 
                                                                    data-radius=20
                                                                    data-thickness=20
                                                                    data-padding=0
                                                                    data-round=false
                                                                    data-color="lightgreen"
                                                                    data-text="{{$completenessProfile}}" 
                                                                    data-title="{{$completenessProfile}}%" 
                                                                    data-value="{{$completenessProfile}}" 
                                                                    dir="rtl"  
                                                                    data-anchor="top" ></div>
                                                    </div>
                                                             <div class="status">{{$completenessProfile}}%</div>
                                                    </div>

    
                                            </div>
                                            <div class="col-md-7">
                                                <div class="alert bg-intellinz-light-green text-company" style="width: 100%; overflow: hidden; margin-left: 0px !important;"> <p>
                                                <strong>Intellinz members are three times more likely
                                                to engage with you if your company profile is over 30% complete.
                                                Be sure to include accurate information.</strong>
                                            </p>
                                        </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                
                                                    <?php if(isset($completenessMessages)){ ?>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <ul>
                                                <?php    foreach($completenessMessages as $d){
                                                    ?>
        
                                                    <strong><li style=" list-style-type: none; color: #000000"><?php if ($d != NULL) {
                                                            echo '<i class="fa fa-exclamation" style="color:red !important"></i>' .$d;
                                                        } ?> </li></strong>
                                                    <?php
                                                    } ?>
                                                    </ul>
                                                    </div></div>
                                                <?php    } ?>
                                                
                        </div>
                       
                    </div>
                                            
                </div>
            </div>


            <!-- START METRONIC TAB -->

            </div>
            
            <!-- put xero code here -->
            
            <div class="row">

            <div class="col-md-12 mb-2">

                <div class="portlet light " style="border:1px solid silver">

                    <div class="portlet-title">



                        <div class="caption" style="width:100%">

                            <button class="btn btn-primary pull-right" id="load_pdf_modal_button"><b class=" text-company">UPDATE INFO USING PDF</b></button>
                        </div>



                        <!-- START NAV TABS -->

                        <ul class="nav nav-tabs">

                            <li id="com_overview_section" class="active">

                                <a href="#portlet_tab1" data-toggle="tab"> Company Overview </a>

                            </li>

                            <li id="com_key_section" >

                                <a href="#portlet_tab2" data-toggle="tab"> Key Management </a>

                            </li>

                            <li id="com_info_section" >

                                <a href="#portlet_tab3" data-toggle="tab"> Company Information </a>

                            </li>

                            <li id="com_strength_section">

                                <a href="#portlet_tab4" data-toggle="tab"> Strength </a>

                            </li>

                            <li id="com_financial_section">

                                <a href="#portlet_tab5" data-toggle="tab"> Financial Status </a>

                            </li>

                        </ul>

                        <!-- END NAV TABS -->

                    </div>





                <!-- START FORM TAG-->

                    <form action="{{ route('storeProfile') }}" enctype="multipart/form-data" id="company_profile_form"

                          method="POST">
                        {{ csrf_field() }}



                        <div class="portlet-body">

                            <div class="tab-content">

                                <div class="tab-pane active" id="portlet_tab1">

                                    <!-- START OVERVIEW TAB -->

                                    <div id="tabs-1">

                                        <div class="card-body center">
                                            
                                            <h4 class="" style="margin-bottom:15px; margin-top:0px !important"><b><i class="fa fa-list "></i> COMPANY OVERVIEW</b></h4>

                                            <div  class="alert bg-dark text-white" role="alert">



                                                <b class="text-company">PRO TIP:</b> Companies with filled in general company information have a

                                                greater chance to matched with relevant business for their business

                                                objectives.

                                            </div>



                                            <div class="form-group">

                                                <label for="company_name">Company Name</label>

                                                <input type="text" class="form-control" id="company_name"

                                                       name="company_name"

                                                       value="<?php if (isset($company_data->registered_company_name)) {

                                                           echo $company_data->registered_company_name;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="company_unique_entity">Company Registration Number

                                                    (UEN)</label>

                                                <input type="text" class="form-control" name="company_unique_entity"

                                                       id="company_unique_entity"

                                                       value="<?php if (isset($company_data->unique_entity_number)) {

                                                           echo $company_data->unique_entity_number;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="company_year_founded">Year Founded</label>



                                                <select class="form-control" id="company_year_founded"

                                                        name="company_year_founded">

                                                    <?php

                                                    foreach($year_founded as $key => $value){



                                                    if(isset($company_data->year_founded) && $key == $company_data->year_founded) { ?>

                                                    <option selected

                                                            value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                    <?php  } else { ?>

                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                    <?php }

                                                    }

                                                    ?>

                                                </select>



                                            <!-- <input type="text" class="form-control" id="company_year_founded" name="company_year_founded" value="<?php //if(isset($company_data->year_founded)){ echo $company_data->year_founded; } ?>">-->

                                            </div>



                                            <div class="form-group">

                                                <label for="company_ownership">Business Type</label>

                                                <select class="form-control" id="company_business_type"

                                                        name="company_business_type">

                                                    <option value="" id="">Please select the following</option>

                                                    <?php foreach($business_type as $key => $value)

                                                    {

                                                    if (isset($company_data->business_type) && $key == $company_data->business_type) {

                                                        $selected = 'selected';

                                                    } else {

                                                        $selected = '';

                                                    }

                                                    ?>

                                                    <option

                                                        <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                    <?php

                                                    }  ?>

                                                </select>

                                            </div>



                                            <div class="form-group">

                                                <label for="company_ownership">Industry Type</label>

                                                <select class="form-control" id="company_industry"

                                                        name="company_industry">

                                                    <option value="" id="">Please select the following</option>

                                                    <?php foreach($business_industry as $key => $value)

                                                    {

                                                    if (isset($company_data->industry) && $key == $company_data->industry) {

                                                        $selected = 'selected';

                                                    } else {

                                                        $selected = '';

                                                    }

                                                    ?>

                                                    <option

                                                        <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                    <?php

                                                    }  ?>



                                                </select>

                                            </div>





                                            <div class="form-group">

                                                <label for="description">Description</label>

                                                <textarea onclick="return false;" rows="5" cols="20"  maxlength="500" class="form-control" name="description"

                                                          id="description"><?php if (isset($company_data->description)) {

                                                        echo $company_data->description;

                                                    } ?></textarea>

                                                <div class="alert bg-dark text-white">
                                                  <span>Characters left:&nbsp;</spa><span style="color:red;" id="count">500</span>
                                                </div>
                                            </div>





                                            <div class="form-group">

                                                <label for="company_address">Office Address </label>

                                                <input type="text" class="form-control" id="company_address"

                                                       name="company_address"

                                                       value="<?php if (isset($company_data->registered_address)) {

                                                           echo $company_data->registered_address;

                                                       } ?>">

                                            </div>



                                        <!-- <div class="form-group">

                                     <label for="company_number_employeee">Numbered of Employees</label>

                                     <select  class="form-control" id="company_number_employeee" name="company_number_employeee">

                                         <?php
                                        if( !empty($num_of_employee) ){
                                            foreach($num_of_employee as $key => $value){


                                            if(isset($company_data->number_of_employees) && $key == $company_data->number_of_employees) { ?>

                                                    <option selected value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                <?php  } else { ?>

                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                <?php }

                                            }
                                        }
                                        ?>

                                                </select>

                                        </div>  -->



                                        <!--  <div class="form-group ">

                                     <label for="company_estmated_sales offset-md-5">Estimated Sales</label> <br />



                                      <select  class="form-control" id="company_estmated_sales_currency" name="company_estmated_sales_currency">

                                         <option value="">Currency</option>

                                         <?php

                                        foreach($currency as $key => $value)

                                        {

                                        if (isset($company_data->estimatedsales_currency) && $key == $company_data->estimatedsales_currency) {

                                            $selected = 'selected';

                                        } else {

                                            $selected = '';

                                        }

                                        ?>

                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                         <?php

                                        }  ?>



                                                </select>

                                           <br />

                                           <select  class="form-control" id="company_estmated_sales_value" name="company_estmated_sales_value">

                                              <option value="">Please select the following</option>

<?php

                                        foreach($estimated_sales as $key => $value)

                                        {

                                        if (isset($company_data->estimatedsales_value) && $key == $company_data->estimatedsales_value) {

                                            $selected = 'selected';

                                        } else {

                                            $selected = '';

                                        }

                                        ?>

                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                         <?php

                                        }

                                        ?>



                                                </select>



                                        </div> -->



                                            <div class="form-group">

                                                <label for="office_phone">Office Phone </label>

                                                <input type="text" class="form-control" id="office_phone"

                                                       name="office_phone"

                                                       value="<?php if (isset($company_data->office_phone)) {

                                                           echo $company_data->office_phone;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="mobile_phone">Mobile Phone </label>

                                                <input type="text" class="form-control" id="mobile_phone"

                                                       name="mobile_phone"

                                                       value="<?php if (isset($company_data->mobile_phone)) {

                                                           echo $company_data->mobile_phone;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="company_email">Email </label>

                                                <input type="text" class="form-control" id="company_email"

                                                       name="company_email"

                                                       value="<?php if (isset($company_data->company_email)) {

                                                           echo $company_data->company_email;

                                                       } ?>">

                                            </div>

					    <div class="form-group">

                                                <label for="incorporation_date">Incorporation Date </label>

                                                <input type="text" class="form-control"  id="mask_incorporation_date"

                                                       name="incorporation_date"

                                                       value="<?php if (isset($company_data->incorporation_date)) {

                                                           echo $company_data->incorporation_date;

                                                       } ?>">
                                                <span class="form-text text-muted">Custom date format:<code>yyyy-mm-dd</code></span>
                                            </div>



                                            <div class="form-group">

                                                <label for="company_website">Website </label>

                                                <input type="text" class="form-control" id="company_website"

                                                       name="company_website"

                                                       value="<?php if (isset($company_data->company_website)) {

                                                           echo $company_data->company_website;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="facebook">Facebook </label>

                                                <input type="text" class="form-control" id="facebook" name="facebook"

                                                       value="<?php if (isset($company_data->facebook)) {

                                                           echo $company_data->facebook;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="twitter">Twitter </label>

                                                <input type="text" class="form-control" id="twitter" name="twitter"

                                                       value="<?php if (isset($company_data->twitter)) {

                                                           echo $company_data->twitter;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="linkedin">Linkedin </label>

                                                <input type="text" class="form-control" id="linkedin" name="linkedin"

                                                       value="<?php if (isset($company_data->linkedin)) {

                                                           echo $company_data->linkedin;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="googleplus">Google Plus </label>

                                                <input type="text" class="form-control" id="googleplus"

                                                       name="googleplus"

                                                       value="<?php if (isset($company_data->googleplus)) {

                                                           echo $company_data->googleplus;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="otherlink">Other Link </label>

                                                <input type="text" class="form-control" id="otherlink" name="otherlink"

                                                       value="<?php if (isset($company_data->otherlink)) {

                                                           echo $company_data->otherlink;

                                                       } ?>">

                                            </div>



                                            <div class="form-group">

                                                <label for="company_primary_country">Primary Country</label>

                                                <select class="form-control" id="company_primary_country"

                                                        name="company_primary_country">

                                                    <option value="" id="">Please select the following</option>

                                                    <?php foreach($countries as $data)

                                                    {

                                                    if (isset($company_data->primary_country) && $data->country_code == $company_data->primary_country) {

                                                        $selected = 'selected';

                                                    } else {

                                                        $selected = '';

                                                    }

                                                    ?>

                                                    <option

                                                        <?php echo $selected; ?> value="<?php echo $data->country_code; ?>"><?php echo $data->country_name; ?></option>

                                                    <?php

                                                    }  ?>



                                                </select>

                                            </div>





                                            <hr/>





                                        </div>



                                    </div>

                                    <!-- END OVERVIEW TAB -->

                                </div>

                                <!-- START KEY PERSONNEL TAB -->

                                <div class="tab-pane" id="portlet_tab2">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8 mb-2">
                                                    <h4 class="" style="margin-bottom:15px; margin-top:0px !important"><b><i class="fa fa-users "></i> KEY PERSONEL</b></h4>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <button onclick="clearKM()" data-popup-open="popup-1" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> ADD KEY PERSONEL</button>
                                                </div>
                                            </div>
                                            
                                            <div id="container table-responsive table-scrollable table-scrollable-borderless" style="overflow-x:scroll">

                                              <table id="key_personel_table" class="table pure-table pure-table-horizontal pure-table-striped" >
                                                    <thead>
                                                        <tr>
                                                            <th class="fit"></th>
                                                            <th>FIRST NAME</th>
                                                            <th >LAST NAME</th>
                                                            <th>GENDER</th>
                                                            <th>BIRTH DATE</th>
                                                            <th >NATIONALITY</th>
                                                            <th>IDENTIFICATION/PASSPORT</th>
                                                            <th>MAJORITY SHAREHOLDER</th>
                                                            <th>DIRECTORSHIP</th>
                                                            <th>POSITION</th>
                                                            <th>ACTION</th>
                                                        </tr>
                                                    </thead>    
                                                    <tbody>
                                                    <?php
                                                    $count = 0;
    
                                                    if (count((array) $keyPersons) > 0) {

                                                    foreach ($keyPersons as $data) {
                                                        $count++; ?>
                                                        <td class="fit">{{ $count }}</td>
                                                        <td>{{ $data->first_name }}</td>
                                                        <td>{{ $data->last_name }}</td>
                                                        <td>{{ $data->gender }}</td>
                                                        <td>{{ $data->date_of_birth }}</td>
                                                        <td>{{ $data->nationality }}</td>
                                                        <td>{{ $data->idn_passport }}</td>
                                                        <td>{{ $data->shareholder }}</td>
                                                        <td>{{ $data->is_directorship }}</td>
                                                        <td>{{ $data->position }}</td>
                                                        <td class="fit">
                                                            <input data-popup-open="popup-1" onclick="editKM(' . $data->id . ');" type="button" class="btn btn-primary btn-xs" value="EDIT">
                                                            <input type="button" onclick="delKM(' . $data->id . ',' . $kp . ');" class="btn btn-xs btn-danger" value="DELETE">
                                                            </td>
                                                    <?php }
                                                    }
                                                    ?>
                                                    </tbody>
                                                
                                                 </table>
                                              </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- END KEY PERSONNEL TAB -->

                                <!-- START Financial Information TAB -->

                                <div class="tab-pane" id="portlet_tab3">

                                    <div class="row">
                                                <div class="col-md-8 mb-2">
                                                    <h4 class="" style="margin-bottom:15px; margin-top:0px !important"><b><i class="fa fa-building "></i> COMPANY INFORMATION</b></h4>
                                                </div>
                                                
                                            </div>

                                    <div class="card-body center">



                                        <div class="form-group ">

                                            <label for="company_financial_currency">Primary Currency</label> <br/>

                                            <select class="form-control" id="company_financial_currency"

                                                    name="company_financial_currency">

                                                <option value="">Currency</option>

                                                <?php foreach($currency as $data){

                                                if (isset($company_data->currency) && $data->code == $company_data->currency) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $data->code ?>"><?php echo $data->code . ' - ' . $data->currency; ?></option>

                                                <?php }  ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_years_establishment">Years of Establishment </label>

                                            <select class="form-control" id="company_years_establishment"

                                                    name="company_years_establishment">

                                                <option value="" id="">Year</option>

                                                <?php foreach($years_establishment as $key => $value)

                                                {

                                                if (isset($company_data->years_establishment) && $key == $company_data->years_establishment) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group ">

                                            <label for="company_financial_numstaff">No. of Staff</label> <br/>

                                            <select class="form-control" id="company_financial_numstaff"

                                                    name="company_financial_numstaff">

                                                <option value="">No of staff</option>

                                                <?php foreach($no_of_staff as $key => $value){

                                                if (isset($company_data->no_of_staff) && $key == $company_data->no_of_staff) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php }  ?>



                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_gross_profit">Gross Profit / (Loss)</label>

                                            <select class="form-control" id="company_gross_profit"

                                                    name="company_gross_profit">

                                                <option value="" id=""></option>

                                                <?php foreach($gross_profit_loss as $key => $value)

                                                {

                                                if (isset($company_data->gross_profit) && $key == $company_data->gross_profit) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>



                                        </div>



                                        <div class="form-group">

                                            <label for="company_gross_profit">Net Profit / (Loss)</label>

                                            <select class="form-control" id="company_net_profit"

                                                    name="company_net_profit">

                                                <option value="" id=""></option>

                                                <?php foreach($net_profit_loss as $key => $value)

                                                {

                                                if (isset($company_data->net_profit) && $key == $company_data->net_profit) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_annual_tax">Annual Return Filling Rating </label>

                                            <select class="form-control" id="company_annual_tax_return"

                                                    name="company_annual_tax_return">

                                                <option value="" id=""></option>

                                                <?php foreach($filling_rate as $key => $value)

                                                {

                                                if (isset($company_data->annual_tax_return) && $key == $company_data->annual_tax_return) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_annual_tax">Corporate Tax Filling Rating </label>

                                            <select class="form-control" id="company_corporate_tax"

                                                    name="company_corporate_tax">

                                                <option value="" id=""></option>

                                                <?php foreach($filling_rate as $key => $value)

                                                {

                                                if (isset($company_data->corporate_tax) && $key == $company_data->corporate_tax) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_annual_tax">Asset more than Liability </label>

                                            <select class="form-control" id="company_asset_more_liability"

                                                    name="company_asset_more_liability">

                                                <option value="" id=""></option>

                                                <?php foreach($asset_more_liability as $key => $value)

                                                {

                                                if (isset($company_data->asset_more_liability) && $key == $company_data->asset_more_liability) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_paid_capital">Paid up capital</label>

                                            <select class="form-control" id="company_paid_up_capital"

                                                    name="company_paid_up_capital">

                                                <option value="" id=""></option>

                                                <?php foreach($paid_up_capital as $key => $value)

                                                {

                                                if (isset($company_data->paid_up_capital) && $key == $company_data->paid_up_capital) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>




                                        <div class="form-group">
                                            <div class="col-12">
                                            <?php 
                                            if(isset($company_data->financial_year_end)){
                                                if(strpos($company_data->financial_year_end, "/") !== false){
                                                    $date = explode('/', $company_data->financial_year_end); 
                                                    $new_date = $date[2]."-".$date[0]."-".$date[1];
                                                }else{
                                                    $date = explode('-', $company_data->financial_year_end); 
                                                    $new_date = $company_data->financial_year_end;
                                                }
                                            }
                                            ?>
                       @if(isset($new_date))
                                            <input type="hidden" id="default_financial_year_end" 
                                             value="{{ $new_date }}" >
                       @endif   

                                            <label for="financial_year_end">Financial Year End</label>
                                            </div>  
                                        </div>
                                        <div class="form-group example">
                                            <div class="col-12">
                                            <input type="text" class="form-control" id="financial_year_end"
                                                   name="financial_year_end"
                                                   value="<?php if (isset($company_data->financial_year_end)) {
                                                       echo $company_data->financial_year_end;
                                                   } ?>">
                                            </div>  
                                        </div>





                                        <div class="form-group">

                                            <input

                                                <?php if (isset($company_data->solvent_value) && $company_data->solvent_value == 'insolvent') {

                                                    echo 'checked="checked"';

                                                }  ?> type="radio" value="insolvent" name="company_vent_value"

                                                id="company_vent_value"> Insolvent

                                            <input

                                                <?php if (isset($company_data->solvent_value) && $company_data->solvent_value == 'solvent') {

                                                    echo 'checked="checked"';

                                                }  ?> type="radio" value="solvent" name="company_vent_value"

                                                id="company_vent_value"> Solvent

                                        </div>



                                    </div>

                                </div>



                            </form>

                                <!-- END Financial Information TAB -->

                                <!-- START UPLOAD DOCUMENT TAB -->

                                <div class="tab-pane" id="portlet_tab4">

                                    <div class="row">
                                                <div class="col-md-8 mb-2">
                                                    <h4 class="" style="margin-bottom:15px; margin-top:0px !important"><b><i class="fa fa-upload "></i> UPLOAD DOCUMENTS</b></h4>
                                                </div>
                                            </div>



                                    <div class="form-group">

                                        <div id="upload">
                                           
                                            

                                            <form method="post" action="{{ route('uploadAwards') }}" enctype="multipart/form-data">



                                                {{ csrf_field() }}

                                                <div id="drop">

                                                    <?php  
                                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false) { 
                                                    ?>

                                                    <a>UPLOAD AWARDS</a>

                                                    <input type="file" name="awardsFiles" id="up1"/>

                                                    <?php } ?>    
                                                </div>



                                                <ul>

                                                    <!-- The file uploads will be shown here -->



                                                </ul>



                                                <?php if(count((array) $profileAwards) > 0) { ?>

                                                <p>Saved Awards</p>

                                                <ol>

                                                    <?php foreach($profileAwards as $aw) {  ?>

                                                    <li style="padding:5px;" id="awardsSaved<?php echo $aw[0]; ?>">

                                                        <span><b><?php echo $aw[2]; ?></b></span>





                                                        <span class="link_btn" style="float:right">

                                                                    <a style="background:none !important;" target="_blank" href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>">Download</a>

                                                                    -

                                                                    <a style="background:none !important;" href="#" onclick="processRemoveFile('<?php echo $aw[0]; ?>', 'awardsSaved', '<?php echo $aw[2]; ?>');">Delete</a>

                                                        </span>

                                                        <br />

                                                        <br />

                                                        <span style="float:right">

                                                        Expiry Date: <input type="text" disabled id="expiryDate<?php echo $aw[0]; ?>" value="<?php echo $aw[4]; ?>"  />

                                                        <input class="btn btn-primary" type="button" value="update" onclick="updateExpirydate('<?php echo $aw[0]; ?>');">

                                                        <input class="btn btn-primary" type="button" value="edit" onclick="editExpirydate('<?php echo $aw[0]; ?>');">



                                                        </span>



                                                    </li>

                                                    <hr />

                                                    <?php } ?>

                                                </ol>

                                                <?php } ?>



                                            </form>

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label for="invoices"><b>Invoices</b></label> <br/>

                                        <div id="upload1">

                                            <form method="post" action="{{ route('uploadPurchaseInvoices') }}"  enctype="multipart/form-data">

                                                {{ csrf_field() }}

                                                <div id="drop1">

                                                    <?php  
                                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false) { 
                                                    ?>

                                                    <a>UPLOAD PURCHASE INVOICES</a>

                                                    <input type="file" name="purchaseInvoiceFiles" id="up2"/>

                                                    <?php } ?>

                                                </div>



                                                <ul>

                                                    <!-- The file uploads will be shown here -->

                                                </ul>



                                                <?php if(count((array)$profilePurchaseInvoice) > 0) { ?>

                                                <p>Saved Purchase Invoice</p>

                                                <ol>

                                                    <?php foreach($profilePurchaseInvoice as $aw) {  ?>

                                                    <li style="padding:5px;"

                                                        id="purchaseInvoiceSaved<?php echo $aw[0]; ?>">

                                                        <span><b><?php echo $aw[2]; ?></b></span>

                                                        <span class="link_btn" style="float:right"> <a style="background:none !important;"

                                                                    target="_blank"

                                                                    href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>">Download</a> - <a style="background:none !important;"

                                                                    href="#"

                                                                    onclick="processRemoveFile('<?php echo $aw[0]; ?>', 'purchaseInvoiceSaved', '<?php echo $aw[2]; ?>');">Delete</a></span>

                                                    </li>

                                                    <?php } ?>

                                                </ol>

                                                <?php } ?>



                                            </form>

                                        </div>



                                        <div id="upload2">

                                            <form method="post" action="{{ route('uploadSalesInvoies') }}"

                                                  enctype="multipart/form-data">

                                                {{ csrf_field() }}

                                                <div id="drop2">

                                                    <?php  
                                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false) { 
                                                    ?>

                                                    <a>UPLOAD SALES INVOICES</a>

                                                    <input type="file" name="salesInvoiceFiles" id="up3"/>

                                                    <?php } ?>

                                                </div>



                                                <ul>

                                                    <!-- The file uploads will be shown here -->



                                                </ul>

                                                <?php if(count((array)$profileSalesInvoice) > 0) { ?>

                                                <p>Saved Sales Invoice</p>

                                                <ol>

                                                    <?php foreach($profileSalesInvoice as $aw) {  ?>

                                                    <li style="padding:5px;"

                                                        id="salesInvoiceSaved<?php echo $aw[0]; ?>">

                                                        <span><b><?php echo $aw[2]; ?></b></span>

                                                        <span class="link_btn" style="float:right"> <a style="background:none !important;"

                                                                    target="_blank"

                                                                    href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>">Download</a> - <a style="background:none !important;"

                                                                    href="#"

                                                                    onclick="processRemoveFile('<?php echo $aw[0]; ?>', 'salesInvoiceSaved', '<?php echo $aw[2]; ?>');">Delete</a></span>

                                                    </li>

                                                    <?php } ?>

                                                </ol>

                                                <?php } ?>

                                            </form>

                                        </div>

                                    </div>





                                    <div class="form-group">

                                        <label for="awards"><b>Certifications</b></label> <br/>



                                        <div id="upload3">

                                            <form method="post" action="{{ route('uploadCertifications') }}"

                                                  enctype="multipart/form-data">

                                                {{ csrf_field() }}

                                                <div id="drop3">

                                                    <?php  
                                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false) { 
                                                    ?>

                                                    <a>UPLOAD CERTIFICATES</a>

                                                    <input type="file" name="certificationFiles" id="up4"/>

                                                    <?php } ?>

                                                </div>



                                                <ul>

                                                    <!-- The file uploads will be shown here -->



                                                </ul>



                                                <?php if(count((array)$profileCertifications) > 0) { ?>

                                                <p>Saved Certificates</p>

                                                <ol>

                                                    <?php foreach($profileCertifications as $aw) {  ?>

                                                    <li style="padding:5px;"

                                                        id="certificatesSaved<?php echo $aw[0]; ?>">

                                                        <span><b><?php echo $aw[2]; ?></b></span>

                                                        <span class="link_btn" style="float:right">

                                                                    <a style="background:none !important;" target="_blank" href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>">Download</a>

                                                                    -

                                                                    <a style="background:none !important;" href="#" onclick="processRemoveFile('<?php echo $aw[0]; ?>', 'certificatesSaved', '<?php echo $aw[2]; ?>');">Delete</a>

                                                        </span>



                                                        <br />

                                                        <br />

                                                        <span style="float:right">

                                                        Expiry Date: <input type="text" disabled id="expiryDate<?php echo $aw[0]; ?>" value="<?php echo $aw[4]; ?>"  />

                                                        <input class="btn btn-primary" type="button" value="update" onclick="updateExpirydate('<?php echo $aw[0]; ?>');">

                                                        <input class="btn btn-primary" type="button" value="edit" onclick="editExpirydate('<?php echo $aw[0]; ?>');">



                                                        </span>





                                                    </li>

                                                    <?php } ?>

                                                </ol>

                                                <?php } ?>



                                            </form>

                                        </div>

                                    </div>

                                </div>

                                <!-- END UPLOAD DOCUMENT TAB -->

                                <!-- START FINANCIAL ENTRIES TAB -->
                                
                                <?php 
                                $csvLink = asset('public/assets/templates/IntellinzFinancialStatusTemplate.csv');
                                ?>
                                <style>
                                
                                    #placeholder2 div.yAxis div.tickLabel {
                                        margin-right: 20px !important;
                                    }
                                    
                                    .flot-x-axis > div{
                                        max-width:100px !important;
                                        margin-top:10px;
                                        font-weight:bold !important;
                                    }
                                    
                                    #legendContainer td, #legend_hide_Container td {display: inline-block;}
                                    
                                    #legendContainer2, #legend_hide_Container {
                                        border:1px solid silver;
                                        border-radius:5px;
                                        margin:15px;
                                    }
                                    
                                    #legend_hide_Container label{
                                        margin-left:3px;
                                        margin-right:20px;
                                    }
                                </style>
                                
                                
                                <div class="tab-pane" id="portlet_tab5">
                                    <h4 class=""><i class="fa fa-book"></i><b> Financial Entries</b></h4>
                                    
                                    <br>
                                    
                                    <?php $xero_info = \App\Http\Controllers\XeroController::checkIfConnected(); ?>
                                    <?php 
                                        $xero_id = "0";
                                        
                                        if($xero_info != null){
                                            $xero_id = $xero_info->id;
                                        }
                                        
                                        $token_info = App\XeroTokenInfo::where("connection_id","=",$xero_id)->where("status","=","1")->first();
                                        $org_name = "";
                                        $if_con = 0;
                                    
                                        if($xero_info != null){ 
                                            if(time() > $token_info->expires){
                                                $provider = new \League\OAuth2\Client\Provider\GenericProvider([
                                                  'clientId'                => $xero_info->client_id,
                                                  'clientSecret'            => $xero_info->secret_id,
                                                  'redirectUri'             => env("APP_URL").'company/goXeroAnalytics',
                                                  'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
                                                  'urlAccessToken'          => 'https://identity.xero.com/connect/token',
                                                  'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
                                                ]);
                                            
                                                $newAccessToken = $provider->getAccessToken('refresh_token', [
                                                  'refresh_token' => $token_info->refresh_token
                                                ]);
                                                
                                                $token_info->token = $newAccessToken->getToken();
                                                $token_info->expires = $newAccessToken->getExpires();
                                                $token_info->refresh_token = $newAccessToken->getRefreshToken();
                                                $token_info->id_token = $newAccessToken->getValues()["id_token"];
                                                $token_info->save();
                                            }
                                            
                                            $token_info = App\XeroTokenInfo::where("connection_id","=",$xero_info->id)->where("status","=","1")->first();
                                            
                                            try{
                                                $token_info = App\XeroTokenInfo::where("connection_id","=",$xero_info->id)->where("status","=","1")->first();
                                                
                                                $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( (string)$token_info->token );
                                                $apiInstance = new XeroAPI\XeroPHP\Api\AccountingApi(
                                                    new GuzzleHttp\Client(),
                                                    $config
                                                );
                                                
                                                $tenant_info = App\XeroTenantId::where("token_id", "=", $token_info->id)->where("status", "=", "1")->first();
                                                $xeroTenantId = (string)$tenant_info->tenant_id;
                                                
                                                $apiResponse = $apiInstance->getOrganisations($xeroTenantId);
                                                $org_name = $apiResponse->getOrganisations()[0]->getName();
                                                $org_id = $apiResponse->getOrganisations()[0]->getOrganisationID();
                                                $if_con = 1;
                                                
                                                } catch (Exception $e) {
                                                      //echo 'Exception when calling AccountingApi->getOrganisations: ', $e->getMessage(), PHP_EOL;
                                                      $org_name = "Not Connected to XERO";
                                                }
                                        }
                                    ?>
                                     
                                    <div class="card mb-2">
                                        <?php 
                                            $ifpremium = App\SpentTokens::check_if_premium($company_id_result);
                                        ?>
                                        <div class="card-body">
                                            <div class="row mb-2 ">
                                                <div class="col-md-12">
                                                    <div class=" note-success" style="margin-bottom:0px !important">
                                                        <h4 class="xero_logo"><img src="https://edge.xero.com/images/1.0.0/logo/xero-logo.svg" class="img-fluid" style="width:60px" /><strong>&nbsp;&nbsp;XERO INTEGRATION</strong></h4>
                                                    </div>
                                                </div>
                                                <?php if(!$ifpremium){ ?>
                                                    <div class="col-md-12">
                                                    <h3 class="text-danger">Your Account is Free. Please Purchase Premium Account to use the XERO Integration.</h3>
                                                    </div>
                                                <?php }else{ ?>
                                                <div class="col-md-12">
                                                    <?php if($if_con > 0){ ?>
                                                    <label>STATUS: <span class="badge badge-pill "style="background:green !important">Connected</span></label>
                                                    <?php }else{ ?>
                                                    <label>STATUS: <span class="badge badge-pill "style="background:red !important">Not Connected</span></label>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-md-12">
                                                     <h4 style="margin-top:5px !important"><b>Organization Name:  </b> <a data-toggle="modal" data-target="#org_details_modal" id="org_txt">{{ strtoupper($org_name) }}</a></h4>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            
                                            <?php if($ifpremium){ ?>
                                            
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <div class="alert bg-dark text-white text-center">
                                                        <b class="text-center"><i class="fa fa-download"></i> IMPORT DATA FROM XERO</b>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label>Month & Year:</label>
                                                    <input type="month" id="import_date_txt" value="<?php echo date('Y-m'); ?>" class="form-control" />
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label>Comparison period(s), Compare with:</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="number" disabled min="1" max="11" id="import_period_no_txt" value="3" class="form-control" />
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-control" id="import_period_type_cb">
                                                                <option value="YEAR">YEAR</option>
                                                                <!--<option value="QUARTER">QUARTER</option>
                                                                <option value="MONTH">MONTH</option>-->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-1 mb-2">
                                                    <label style="color:white">:</label>
                                                    <button id="import_load_btn" class="btn btn-sm btn-primary"><i class="fa fa-spinner"></i> IMPORT</button>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <script>
                                        $("#import_load_btn").click(function(){
                                            $(".loading").show();
                                            
                                            var date = $("#import_date_txt").val();
                                            var timeframe = $("#import_period_type_cb option:selected").val();
                                            
                                            $.ajax({
                                                url: "<?php echo env("APP_URL"); ?>company/loadFinancialEntries/"+ date + "/" + timeframe,
                                                type: "GET",
                                                dataType: "json",
                                                success: function (return_data) {
                                                     $.each(return_data, function(key, value){
                                                         $.each(value, function(key1, value1){
                                                            
                                                            for(var x = 0; x <= value1.length - 1; x++){
                                                                
                                                                if(key1 == "Header Titles"){
                                                                    var splits = value1[x].split(" ");
                                                                    $( "#fa_month"+ (x + 1) +" option:contains('"+ splits[1] +"')" ).attr("selected", true);
                                                                    $( "#fa_year"+ (x + 1) +" option:contains('"+ splits[2] +"')" ).attr("selected", true);
                                                                }
                                                                
                                                                if(key1 == "Income"){
                                                                    $( "#income"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Purchase"){
                                                                    $( "#purchase"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Cost of Goods Sold"){
                                                                    $( "#cost_good_sold"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Gross Profit"){
                                                                    $( "#gross_profit"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Directors Remuneration"){
                                                                    $( "#directors_fee_renum"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Total Remuneration excluding"){
                                                                    $( "#total_renum_exdirector"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Medical Expenses"){
                                                                    $( "#medical_expense"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Travelling Expenses"){
                                                                    $( "#transport_travelling_expenses"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Entertainment Expenses"){
                                                                    $( "#entertainment_expense"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Debt Interest/Finance Expense"){
                                                                    $( "#debt_interest_finance_expenses"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Net Profit"){
                                                                    $( "#net_profit"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Net Profit before"){
                                                                    $( "#net_profit_before_interest_tax"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Inventories"){
                                                                    $( "#inventories_closing_stock"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                //balance sheet
                                                                
                                                                if(key1 == "Trade Receivable"){
                                                                    $( "#trade_receivable"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Trade Payable"){
                                                                    $( "#trade_payable"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Non-Current Assets"){
                                                                    $( "#non_current_assets"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Current Assets"){
                                                                    $( "#current_assets"+ (x + 1)).val(value1[x]);
                                                                } 
                                                                
                                                                if(key1 == "Current Liabilities"){
                                                                    $( "#current_liabilities"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Non-Current Liabilities"){
                                                                    $( "#non_current_liabilities"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Share Capital"){
                                                                    $( "#share_capita"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Retained Earning"){
                                                                    $( "#retained_earning"+ (x + 1)).val(value1[x]);
                                                                } 
                                                                
                                                                if(key1 == "Translation Reserves"){
                                                                    $( "#translation_reserves"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Total Debt"){
                                                                    $( "#total_debt"+ (x + 1)).val(value1[x]);
                                                                }
                                                                
                                                                if(key1 == "Prepaid Expenses"){
                                                                    $( "#prepaid_expenses"+ (x + 1)).val(value1[x]);
                                                                }
                                                            }
                                                         });
                                                     });
                                                     
                                                     $(".loading").hide();
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) {
                                                    console.log(textStatus, errorThrown);
                                                    $(".loading").hide();
                                                }
                                            });
                                        });
                                    </script>
                                    
                                    <div class='card'>
                                    <div class="card-body center table-outer">
                                        <a style="float:right" class="mb-2" target="_blank" href="{{ $csvLink }}">Download CSV Template</a> <br />
                                        
                                        <div class='table-inner'>

                                        
                                        <table id="financial_data_table" class="table table-bordered table-striped table-condensed flip-content"

                                               style="width: 100%; padding-top: 5px;" border="1" cellpadding="2"

                                               cellspacing="2">

                                            <tr>

                                                <td width="20%" class='sticky-row'> Month / Year</td>

                                                <?php


                                                $entry1 = App\FinancialAnalysis::where('entry', 1)->where('company_id',  $company_id_result)->where('user_id', $user_id)
                                               
                                                ->first();
                                                

                                                $entry2 = App\FinancialAnalysis::where('entry', 2)->where('company_id',  $company_id_result)->where('user_id', $user_id)
                                                
                                                ->first();

                                                $entry3 = App\FinancialAnalysis::where('entry', 3)->where('company_id',  $company_id_result)->where('user_id', $user_id)
                                               
                                                ->first();

                                                $entry4 = App\FinancialAnalysis::where('entry', 4)->where('company_id',  $company_id_result)->where('user_id', $user_id)
                                               
                                                ->first();


                                                ?>

                                                <td>

                                                    <select class="form-control" id="fa_month1" name="fa_month1">

                                                        <option value="0"></option>

                                                        <?php foreach($param_months as $key => $value)

                                                        {



                                                        if (isset($entry1->month_param) && $key == $entry1->month_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                    <select class="form-control" id="fa_year1" name="fa_year1">

                                                        <option value="0"></option>

                                                        <?php foreach($param_years as $data)

                                                        {

                                                        if (isset($entry1->year_param) && $data == $entry1->year_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $data ?>"><?php echo $data; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                </td>

                                                <td>

                                                    <select class="form-control" id="fa_month2" name="fa_month2">

                                                        <option value="0"></option>

                                                        <?php foreach($param_months as $key => $value)

                                                        {

                                                        if (isset($entry2->month_param) && $key == $entry2->month_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?>  value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                    <select class="form-control" id="fa_year2" name="fa_year2">

                                                        <option value="0"></option>

                                                        <?php foreach($param_years as $data)

                                                        {

                                                        if (isset($entry2->year_param) && $data == $entry2->year_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $data ?>"><?php echo $data; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>



                                                </td>

                                                <td>

                                                    <select class="form-control" id="fa_month3" name="fa_month3">

                                                        <option value="0"></option>

                                                        <?php foreach($param_months as $key => $value)

                                                        {

                                                        if (isset($entry3->month_param) && $key == $entry3->month_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                    <select class="form-control" id="fa_year3" name="fa_year3">

                                                        <option value="0"></option>

                                                        <?php foreach($param_years as $data)

                                                        {

                                                        if (isset($entry3->year_param) && $data == $entry3->year_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }

                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $data ?>"><?php echo $data; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>



                                                </td>

                                                <td>

                                                    <select class="form-control" id="fa_month4" name="fa_month4">

                                                        <option value="0"></option>

                                                        <?php foreach($param_months as $key => $value)

                                                        {

                                                        if (isset($entry4->month_param) && $key == $entry4->month_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                    <select class="form-control" id="fa_year4" name="fa_year4">

                                                        <option value="0"></option>

                                                        <?php foreach($param_years as $data)

                                                        {

                                                        if (isset($entry4->year_param) && $data == $entry4->year_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $data ?>"><?php echo $data; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                </td>



                                            </tr>



                                            <tr>

                                                <td class='sticky-row' >Income</td>

                                                <td><input type="number" class="form-control" id="income1" name="income1"

                                                           value="<?php if (isset($entry1->income)) {

                                                               echo $entry1->income;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="income2" name="income2"

                                                           value="<?php if (isset($entry2->income)) {

                                                               echo $entry2->income;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="income3" name="income3"

                                                           value="<?php if (isset($entry3->income)) {

                                                               echo $entry3->income;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="income4" name="income4"

                                                           value="<?php if (isset($entry4->income)) {

                                                               echo $entry4->income;

                                                           } ?>"></td>

                                            </tr>



                                            <tr>

                                                <td class='sticky-row'>Purchase</td>

                                                <td><input type="number" class="form-control" id="purchase1"

                                                           name="purchase1"

                                                           value="<?php if (isset($entry1->purchase)) {

                                                               echo $entry1->purchase;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="purchase2"

                                                           name="purchase2"

                                                           value="<?php if (isset($entry2->purchase)) {

                                                               echo $entry2->purchase;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="purchase3"

                                                           name="purchase3"

                                                           value="<?php if (isset($entry3->purchase)) {

                                                               echo $entry3->purchase;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="purchase4"

                                                           name="purchase4"

                                                           value="<?php if (isset($entry4->purchase)) {

                                                               echo $entry4->purchase;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Cost of Goods Sold / Cost of Sales</td>

                                                <td><input type="number" class="form-control" id="cost_good_sold1"

                                                           name="cost_good_sold1"

                                                           value="<?php if (isset($entry1->cost_goodsold_costsales)) {

                                                               echo $entry1->cost_goodsold_costsales;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="cost_good_sold2"

                                                           name="cost_good_sold2"

                                                           value="<?php if (isset($entry2->cost_goodsold_costsales)) {

                                                               echo $entry2->cost_goodsold_costsales;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="cost_good_sold3"

                                                           name="cost_good_sold3"

                                                           value="<?php if (isset($entry3->cost_goodsold_costsales)) {

                                                               echo $entry3->cost_goodsold_costsales;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="cost_good_sold4"

                                                           name="cost_good_sold4"

                                                           value="<?php if (isset($entry4->cost_goodsold_costsales)) {

                                                               echo $entry4->cost_goodsold_costsales;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Gross Profit</td>

                                                <td><input type="number" class="form-control" id="gross_profit1"

                                                           name="gross_profit1"

                                                           value="<?php if (isset($entry1->gross_profit)) {

                                                               echo $entry1->gross_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="gross_profit2"

                                                           name="gross_profit2"

                                                           value="<?php if (isset($entry2->gross_profit)) {

                                                               echo $entry2->gross_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="gross_profit3"

                                                           name="gross_profit3"

                                                           value="<?php if (isset($entry3->gross_profit)) {

                                                               echo $entry3->gross_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="gross_profit4"

                                                           name="gross_profit4"

                                                           value="<?php if (isset($entry4->gross_profit)) {

                                                               echo $entry4->gross_profit;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td valign="top" class='sticky-row'>Directors’ Fees & Remuneration</td>

                                                <td><input type="number" class="form-control" id="directors_fee_renum1"

                                                           name="directors_fee_renum1"

                                                           value="<?php if (isset($entry1->directors_fee_renum)) {

                                                               echo $entry1->directors_fee_renum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="directors_fee_renum2"

                                                           name="directors_fee_renum2"

                                                           value="<?php if (isset($entry2->directors_fee_renum)) {

                                                               echo $entry2->directors_fee_renum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="directors_fee_renum3"

                                                           name="directors_fee_renum3"

                                                           value="<?php if (isset($entry3->directors_fee_renum)) {

                                                               echo $entry3->directors_fee_renum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="directors_fee_renum4"

                                                           name="directors_fee_renum4"

                                                           value="<?php if (isset($entry4->directors_fee_renum)) {

                                                               echo $entry4->directors_fee_renum;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Total Remuneration excluding Directors’ Fees and Remuneration</td>

                                                <td><input type="number" class="form-control" id="total_renum_exdirector1"

                                                           name="total_renum_exdirector1"

                                                           value="<?php if (isset($entry1->totalrenum_exdirector_feerenum)) {

                                                               echo $entry1->totalrenum_exdirector_feerenum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="total_renum_exdirector2"

                                                           name="total_renum_exdirector2"

                                                           value="<?php if (isset($entry2->totalrenum_exdirector_feerenum)) {

                                                               echo $entry2->totalrenum_exdirector_feerenum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="total_renum_exdirector3"

                                                           name="total_renum_exdirector3"

                                                           value="<?php if (isset($entry3->totalrenum_exdirector_feerenum)) {

                                                               echo $entry3->totalrenum_exdirector_feerenum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="total_renum_exdirector4"

                                                           name="total_renum_exdirector4"

                                                           value="<?php if (isset($entry4->totalrenum_exdirector_feerenum)) {

                                                               echo $entry4->totalrenum_exdirector_feerenum;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Medical Expenses</td>

                                                <td><input type="number" class="form-control" id="medical_expense1"

                                                           name="medical_expense1"

                                                           value="<?php if (isset($entry1->medical_expenses)) {

                                                               echo $entry1->medical_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="medical_expense2"

                                                           name="medical_expense2"

                                                           value="<?php if (isset($entry2->medical_expenses)) {

                                                               echo $entry2->medical_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="medical_expense3"

                                                           name="medical_expense3"

                                                           value="<?php if (isset($entry3->medical_expenses)) {

                                                               echo $entry3->medical_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="medical_expense4"

                                                           name="medical_expense4"

                                                           value="<?php if (isset($entry4->medical_expenses)) {

                                                               echo $entry4->medical_expenses;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Transport/Travelling Expenses</td>

                                                <td><input type="number" class="form-control"

                                                           id="transport_travelling_expenses1"

                                                           name="transport_travelling_expenses1"

                                                           value="<?php if (isset($entry1->transport_traveling_expenses)) {

                                                               echo $entry1->transport_traveling_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="transport_travelling_expenses2"

                                                           name="transport_travelling_expenses2"

                                                           value="<?php if (isset($entry2->transport_traveling_expenses)) {

                                                               echo $entry2->transport_traveling_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="transport_travelling_expenses3"

                                                           name="transport_travelling_expenses3"

                                                           value="<?php if (isset($entry3->transport_traveling_expenses)) {

                                                               echo $entry3->transport_traveling_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="transport_travelling_expenses4"

                                                           name="transport_travelling_expenses4"

                                                           value="<?php if (isset($entry4->transport_traveling_expenses)) {

                                                               echo $entry4->transport_traveling_expenses;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Entertainment Expenses</td>

                                                <td><input type="number" class="form-control" id="entertainment_expense1"

                                                           name="entertainment_expense1"

                                                           value="<?php if (isset($entry1->entertainment_expenses)) {

                                                               echo $entry1->entertainment_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="entertainment_expense2"

                                                           name="entertainment_expense2"

                                                           value="<?php if (isset($entry2->entertainment_expenses)) {

                                                               echo $entry2->entertainment_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="entertainment_expense3"

                                                           name="entertainment_expense3"

                                                           value="<?php if (isset($entry3->entertainment_expenses)) {

                                                               echo $entry3->entertainment_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="entertainment_expense4"

                                                           name="entertainment_expense4"

                                                           value="<?php if (isset($entry4->entertainment_expenses)) {

                                                               echo $entry4->entertainment_expenses;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Debt Interest/Finance Expense</td>

                                                <td><input type="number" class="form-control"

                                                           id="debt_interest_finance_expenses1"

                                                           name="debt_interest_finance_expenses1"

                                                           value="<?php if (isset($entry1->debt_interest_finance_expenses)) {

                                                               echo $entry1->debt_interest_finance_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="debt_interest_finance_expenses2"

                                                           name="debt_interest_finance_expenses2"

                                                           value="<?php if (isset($entry2->debt_interest_finance_expenses)) {

                                                               echo $entry2->debt_interest_finance_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="debt_interest_finance_expenses3"

                                                           name="debt_interest_finance_expenses3"

                                                           value="<?php if (isset($entry3->debt_interest_finance_expenses)) {

                                                               echo $entry3->debt_interest_finance_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="debt_interest_finance_expenses4"

                                                           name="debt_interest_finance_expenses4"

                                                           value="<?php if (isset($entry4->debt_interest_finance_expenses)) {

                                                               echo $entry4->debt_interest_finance_expenses;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Net Profit</td>

                                                <td><input type="number" class="form-control" id="net_profit1"

                                                           name="net_profit1"

                                                           value="<?php if (isset($entry1->net_profit)) {

                                                               echo $entry1->net_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="net_profit2"

                                                           name="net_profit2"

                                                           value="<?php if (isset($entry2->net_profit)) {

                                                               echo $entry2->net_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="net_profit3"

                                                           name="net_profit3"

                                                           value="<?php if (isset($entry3->net_profit)) {

                                                               echo $entry3->net_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="net_profit4"

                                                           name="net_profit4"

                                                           value="<?php if (isset($entry4->net_profit)) {

                                                               echo $entry4->net_profit;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Net Profit Before Interest and Tax (EBIT)</td>

                                                <td><input type="number" class="form-control"

                                                           id="net_profit_before_interest_tax1"

                                                           name="net_profit_before_interest_tax1"

                                                           value="<?php if (isset($entry1->net_profit_before_interest_tax_ebit)) {

                                                               echo $entry1->net_profit_before_interest_tax_ebit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="net_profit_before_interest_tax2"

                                                           name="net_profit_before_interest_tax2"

                                                           value="<?php if (isset($entry2->net_profit_before_interest_tax_ebit)) {

                                                               echo $entry2->net_profit_before_interest_tax_ebit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="net_profit_before_interest_tax3"

                                                           name="net_profit_before_interest_tax3"

                                                           value="<?php if (isset($entry3->net_profit_before_interest_tax_ebit)) {

                                                               echo $entry3->net_profit_before_interest_tax_ebit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="net_profit_before_interest_tax4"

                                                           name="net_profit_before_interest_tax4"

                                                           value="<?php if (isset($entry4->net_profit_before_interest_tax_ebit)) {

                                                               echo $entry4->net_profit_before_interest_tax_ebit;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Inventories (Closing Stock)</td>

                                                <td><input type="number" class="form-control"

                                                           id="inventories_closing_stock1"

                                                           name="inventories_closing_stock1"

                                                           value="<?php if (isset($entry1->inventories_closing_stock)) {

                                                               echo $entry1->inventories_closing_stock;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="inventories_closing_stock2"

                                                           name="inventories_closing_stock2"

                                                           value="<?php if (isset($entry2->inventories_closing_stock)) {

                                                               echo $entry2->inventories_closing_stock;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="inventories_closing_stock3"

                                                           name="inventories_closing_stock3"

                                                           value="<?php if (isset($entry3->inventories_closing_stock)) {

                                                               echo $entry3->inventories_closing_stock;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="inventories_closing_stock4"

                                                           name="inventories_closing_stock4"

                                                           value="<?php if (isset($entry4->inventories_closing_stock)) {

                                                               echo $entry4->inventories_closing_stock;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Trade Receivable</td>

                                                <td><input type="number" class="form-control" id="trade_receivable1"

                                                           name="trade_receivable1"

                                                           value="<?php if (isset($entry1->trade_receivable)) {

                                                               echo $entry1->trade_receivable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="trade_receivable2"

                                                           name="trade_receivable2"

                                                           value="<?php if (isset($entry2->trade_receivable)) {

                                                               echo $entry2->trade_receivable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="trade_receivable3"

                                                           name="trade_receivable3"

                                                           value="<?php if (isset($entry3->trade_receivable)) {

                                                               echo $entry3->trade_receivable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="trade_receivable4"

                                                           name="trade_receivable4"

                                                           value="<?php if (isset($entry4->trade_receivable)) {

                                                               echo $entry4->trade_receivable;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Trade Payable</td>

                                                <td><input type="number" class="form-control" id="trade_payable1"

                                                           name="trade_payable1"

                                                           value="<?php if (isset($entry1->trade_payable)) {

                                                               echo $entry1->trade_payable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="trade_payable2"

                                                           name="trade_payable2"

                                                           value="<?php if (isset($entry2->trade_payable)) {

                                                               echo $entry2->trade_payable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="trade_payable3"

                                                           name="trade_payable3"

                                                           value="<?php if (isset($entry3->trade_payable)) {

                                                               echo $entry3->trade_payable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="trade_payable4"

                                                           name="trade_payable4"

                                                           value="<?php if (isset($entry4->trade_payable)) {

                                                               echo $entry4->trade_payable;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Non-Current Assets</td>

                                                <td><input type="number" class="form-control" id="non_current_assets1"

                                                           name="non_current_assets1"

                                                           value="<?php if (isset($entry1->non_current_assets)) {

                                                               echo $entry1->non_current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="non_current_assets2"

                                                           name="non_current_assets2"

                                                           value="<?php if (isset($entry2->non_current_assets)) {

                                                               echo $entry2->non_current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="non_current_assets3"

                                                           name="non_current_assets3"

                                                           value="<?php if (isset($entry3->non_current_assets)) {

                                                               echo $entry3->non_current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="non_current_assets4"

                                                           name="non_current_assets4"

                                                           value="<?php if (isset($entry4->non_current_assets)) {

                                                               echo $entry4->non_current_assets;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Current Assets</td>

                                                <td><input type="number" class="form-control" id="current_assets1"

                                                           name="current_assets1"

                                                           value="<?php if (isset($entry1->current_assets)) {

                                                               echo $entry1->current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="current_assets2"

                                                           name="current_assets2"

                                                           value="<?php if (isset($entry2->current_assets)) {

                                                               echo $entry2->current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="current_assets3"

                                                           name="current_assets3"

                                                           value="<?php if (isset($entry3->current_assets)) {

                                                               echo $entry3->current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="current_assets4"

                                                           name="current_assets4"

                                                           value="<?php if (isset($entry4->current_assets)) {

                                                               echo $entry4->current_assets;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Current Liabilities</td>

                                                <td><input type="number" class="form-control" id="current_liabilities1"

                                                           name="current_liabilities1"

                                                           value="<?php if (isset($entry1->current_liabilities)) {

                                                               echo $entry1->current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="current_liabilities2"

                                                           name="current_liabilities2"

                                                           value="<?php if (isset($entry2->current_liabilities)) {

                                                               echo $entry2->current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="current_liabilities3"

                                                           name="current_liabilities3"

                                                           value="<?php if (isset($entry3->current_liabilities)) {

                                                               echo $entry3->current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="current_liabilities4"

                                                           name="current_liabilities4"

                                                           value="<?php if (isset($entry4->current_liabilities)) {

                                                               echo $entry4->current_liabilities;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Non-current Liabilities</td>

                                                <td><input type="number" class="form-control"

                                                           id="non_current_liabilities1" name="non_current_liabilities1"

                                                           value="<?php if (isset($entry1->non_current_liabilities)) {

                                                               echo $entry1->non_current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="non_current_liabilities2" name="non_current_liabilities2"

                                                           value="<?php if (isset($entry2->non_current_liabilities)) {

                                                               echo $entry2->non_current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="non_current_liabilities3" name="non_current_liabilities3"

                                                           value="<?php if (isset($entry3->non_current_liabilities)) {

                                                               echo $entry3->non_current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control"

                                                           id="non_current_liabilities4" name="non_current_liabilities4"

                                                           value="<?php if (isset($entry4->non_current_liabilities)) {

                                                               echo $entry4->non_current_liabilities;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Share Capital</td>

                                                <td><input type="number" class="form-control" id="share_capita1"

                                                           name="share_capita1"

                                                           value="<?php if (isset($entry1->share_capital)) {

                                                               echo $entry1->share_capital;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="share_capita2"

                                                           name="share_capita2"

                                                           value="<?php if (isset($entry2->share_capital)) {

                                                               echo $entry2->share_capital;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="share_capita3"

                                                           name="share_capita3"

                                                           value="<?php if (isset($entry3->share_capital)) {

                                                               echo $entry3->share_capital;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="share_capita4"

                                                           name="share_capita4"

                                                           value="<?php if (isset($entry4->share_capital)) {

                                                               echo $entry4->share_capital;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Retained Earning</td>

                                                <td><input type="number" class="form-control" id="retained_earning1"

                                                           name="retained_earning1"

                                                           value="<?php if (isset($entry1->retained_earning)) {

                                                               echo $entry1->retained_earning;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="retained_earning2"

                                                           name="retained_earning2"

                                                           value="<?php if (isset($entry2->retained_earning)) {

                                                               echo $entry2->retained_earning;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="retained_earning3"

                                                           name="retained_earning3"

                                                           value="<?php if (isset($entry3->retained_earning)) {

                                                               echo $entry3->retained_earning;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="retained_earning4"

                                                           name="retained_earning4"

                                                           value="<?php if (isset($entry4->retained_earning)) {

                                                               echo $entry4->retained_earning;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Translation Reserves</td>

                                                <td><input type="number" class="form-control" id="translation_reserves1"

                                                           name="translation_reserves1"

                                                           value="<?php if (isset($entry1->translation_reserves)) {

                                                               echo $entry1->translation_reserves;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="translation_reserves2"

                                                           name="translation_reserves2"

                                                           value="<?php if (isset($entry2->translation_reserves)) {

                                                               echo $entry2->translation_reserves;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="translation_reserves3"

                                                           name="translation_reserves3"

                                                           value="<?php if (isset($entry3->translation_reserves)) {

                                                               echo $entry3->translation_reserves;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="translation_reserves4"

                                                           name="translation_reserves4"

                                                           value="<?php if (isset($entry4->translation_reserves)) {

                                                               echo $entry4->translation_reserves;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Total Debt</td>

                                                <td><input type="number" class="form-control" id="total_debt1"

                                                           name="total_debt1"

                                                           value="<?php if (isset($entry1->total_debt)) {

                                                               echo $entry1->total_debt;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="total_debt2"

                                                           name="total_debt2"

                                                           value="<?php if (isset($entry2->total_debt)) {

                                                               echo $entry2->total_debt;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="total_debt3"

                                                           name="total_debt3"

                                                           value="<?php if (isset($entry3->total_debt)) {

                                                               echo $entry3->total_debt;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="total_debt4"

                                                           name="total_debt4"

                                                           value="<?php if (isset($entry4->total_debt)) {

                                                               echo $entry4->total_debt;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Prepaid Expenses</td>

                                                <td><input type="number" class="form-control" id="prepaid_expenses1"

                                                           name="prepaid_expenses1"

                                                           value="<?php if (isset($entry1->prepaid_expenses)) {

                                                               echo $entry1->prepaid_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="prepaid_expenses2"

                                                           name="prepaid_expenses2"

                                                           value="<?php if (isset($entry2->prepaid_expenses)) {

                                                               echo $entry2->prepaid_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="prepaid_expenses3"

                                                           name="prepaid_expenses3"

                                                           value="<?php if (isset($entry3->prepaid_expenses)) {

                                                               echo $entry3->prepaid_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control" id="prepaid_expenses4"

                                                           name="prepaid_expenses4"

                                                           value="<?php if (isset($entry4->prepaid_expenses)) {

                                                               echo $entry4->prepaid_expenses;

                                                           } ?>"></td>

                                            </tr>
                                            
                                            <tr>

                                             <td colspan="5">
                                                 <div class="alert bg-dark text-white">
                                                     <p><b class="text-company">TIP:</b>
                                                     
                                                        When inputing MONTH in the file, make sure that the month word is exactly the same in the following below:<br>
                                                        <br>
                                                        <ul class="text-company sbold" style="margin-20px">
                                                            <li>Jan.</li>
                                                            <li>Feb.</li>
                                                            <li>Mar.</li>
                                                            <li>Apr.</li>
                                                            <li>May</li>
                                                            <li>Jun.</li>
                                                            <li>Jul.</li>
                                                            <li>Aug.</li>
                                                            <li>Sep.</li>
                                                            <li>Oct.</li>
                                                            <li>Nov.</li>
                                                            <li>Dec.</li>
                                                        </ul>
                                                     
                                                     </p>
                                                 </div>
                                                <div class="alert" style="width: 100%; overflow: hidden; margin-left: 0px !important;"><p>
                                                    <strong>Upload CSV</strong>
                                                <input type="file" name="uploadCSV" id="uploadCSV" class="btn btn-primary" style="float:right">
                                                 
                                                </p>
                                                </div>
                                             
                                            </td>   
                                            </tr>  

                                        </table>

                                    </div>

                                    </div>
                                    </div>
                                </div>

                                <!-- END FINANCIAL ENTRIES TAB -->

                            </div>

                        </div>

                        <!-- SAVE AND CANCEL BUTTON-->

                        <div class="form-group" style="margin-top:15px">

                            <input type="button" class="btn btn-danger" value="Cancel"

                                   id="cancelButtonCompanyProfile"/>

                            <button id="saveButtonCompanyProfile" type="submit" class="btn btn-primary" ><i class="fa fa-save"></i> SAVE</button>

                        </div>



                    </form>

                    <!-- END FORM TAG-->

                </div>
            </div>

            <!--END METRONIC TAB -->





            <!-- END IMAGE UPLOAD -->



        </div>


    </div>


<!-- Modal -->
<div class="modal fade" id="update_xxxx" tabindex="-1" role="dialog" aria-labelledby="update_xxxx_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="update_xxxx_label">Update Xero Client ID and Secret ID</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('saveConnection') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            
                <p><i class="text-danger">If you dont have client id and secret id, please follow the procedure provided by clicking the button below: </i>
                <button type="button" class="btn btn-info " data-toggle="modal" data-target="#procedure_modal" style="margin-top:5px">OPen XERO Connection Procedure</button></p>
                <br>
                <div class="form-group">
                    <label for="company_name">CLIENT ID:</label>
                    <input type="text"  onfocus="this.type='password'" required class="form-control" autocomplete="new-password" placeholder="Client ID" id="client_id_txt" name="client_id_txt" />
                </div>
                <div class="form-group">
                    <label for="company_name">SECRET ID:</label>
                    <input type="text"  onfocus="this.type='password'" required class="form-control" autocomplete="new-password" placeholder="Secret ID" id="secret_id_txt" name="secret_id_txt" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="xero_save_btn" name="xero_save_btn"><i class="fa fa-save"></i> SAVE</button>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


    <!-- START MODAL FOR ADDING KEY PERSONNEL -->

    <div class="popup" data-popup="popup-1">

        <div class="popup-inner">

            <div class="card-header"><b>Key Management Personnel</b></div>

            <br/>



            <div class="form-group">

                <label for="derictorship">Directorship</label>

                <br>

                <input type="radio" name="is_directorship" id="is_directorship_km" value="Yes"> Yes <br/>

                <input type="radio" name="is_directorship" name="is_directorship_km" value="No"> No

            </div>

            <input type="hidden" name="km_id" id="km_id" value="<?php if (isset($km_id)) {

                echo $km_id;

            } else {

                echo '0';

            } ?>">



            <input type="hidden" name="user_id_km" id="user_id_km" value="<?php if (isset($user_id)) {

                echo $user_id;

            } else {

                echo '0';

            } ?>">



            <div class="form-group">
                <label>First Name: </label>
                <input class="form-control" type="text" id="first_name_km" placeholder="First Name"/></h4>

            </div>



            <div class="form-group">
                <label>Last Name: </label>
                <input class="form-control" type="text" id="last_name_km" placeholder="Last Name"/></h4>

            </div>



            <div class="form-group">
                <label>Identification / Passport: </label>
                <input class="form-control" type="text" id="idn_passport_km"

                       placeholder="Identification / Passport"/></h4>

            </div>



            <div class="form-group">
                <label>Nationality</label>
                <input class="form-control" type="text" id="nationality_km" placeholder="Nationality"/></h4>

            </div>


         
            <div class="form-group">
                <div class="col-12">
                <input type="hidden" id="default_datepicker_dob"  >
                <label for="datepicker_dob">Date Of Birth</label>
                </div>  
            </div>
            <div class="form-group example">
                <div class="col-12">
                <input type="text" class="form-control" id="datepicker_dob"
                       name="datepicker_dob" >
                </div>  
            </div>


            <div class="form-group">
                <label>Majority Shareholder</label>
                <input class="form-control" type="text" onblur="addPercent()" id="shareholder_km"

                       placeholder="Majority Shareholder"/></h4>

            </div>



            <div class="form-group">
                <label>Position</label>
                <input class="form-control" type="text" id="position_km" placeholder="Position"/></h4>

            </div>



            <div class="form-group">

                <label for="gender_km">Gender</label>

                <br>

                <input type="radio" name="gender" id="gender_km" value="Male"> Male <br/>

                <input type="radio" name="gender" id="gender_km" value="Female"> Female



            </div>



            <div class="form-group">
              <div class="modal-footer">
                <button type="button" class="btn btn-raised btn-secondary" data-popup-close="popup-1" >Close</button>
                <button type="button" class="btn btn-raised btn-success" id="ajxUpdateKM">Save</button>
              </div>
            </div>

            <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->

            {{-- <a class="popup-close" data-popup-close="popup-1" href="#">x</a> --}}

        </div>

    </div>


    <script src="{{ asset('public/js-tabs/jquery-ui.js') }}"></script>





    <!-- JavaScript Includes -->

     <script src="{{ asset('public/mini-upload/assets/js/jquery.knob.js') }}"></script>



    <!-- jQuery File Upload Dependencies -->

     <script src="{{ asset('public/mini-upload/assets/js/jquery.ui.widget.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/jquery.iframe-transport.js') }}"></script>



    <script src="{{ asset('public/mini-upload/assets/js/jquery.fileupload.js') }}"></script>



    <!-- Our own JS file -->

    <script src="{{ asset('public/mini-upload/assets/js/script.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/script1.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/script2.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/script3.js') }}"></script>

    <script src="{{ asset('public/img-cropper/js/cropbox.js') }}"></script>



    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

<script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>


    <script type="text/javascript">
    
    
    function getFile() {
          document.getElementById("file").click();
        }

        function notifytoPremium(){
            swal({
            title: "This feature is only available on premium members. You want to upgrade to premium?",
            // text: "You are about to set the view status of this opportunity to be publish with company information!",
            icon: "info",
            buttons: [
              'No, cancel it!',
              'Yes, I am sure!'
            ],
          }).then(function(isConfirm) {
              if (isConfirm) {
                    document.location = "{{ route('reportsBuyCredits') }}"
                } else {

                  swal("Cancelled", "Upgrading your account to premium was cancelled :)", "error");

                }

          });
        }
        
        $('#load_pdf_modal_button').click(function() {
          // reset modal if it isn't visible
          if (!($('.modal.in').length)) {
            $('.modal-dialog').css({
              top: 0,
              left: 0
            });
          }
          $('#upload_pdf_modal').modal({
            
          });
        
        });

        window.onload = function () {
            
            
            

            var options =

                {

                    imageBox: '.imageBoxCimg',

                    thumbBox: '.thumbBoxCimg',

                    spinner: '.spinnerCimg',

                    <?php 
                    
                    
                    if($profileAvatar != null){  
                        
                    ?>

                    imgSrc: "{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>"

                    <?php } else { ?>

                    imgSrc: "{{ asset('public/images/robot.jpg') }}"

                    <?php } ?>



                }

            var cropper = new cropbox(options);

            document.querySelector('#file').addEventListener('change', function () {

                var reader = new FileReader();

                reader.onload = function (e) {

                    options.imgSrc = e.target.result;

                    cropper = new cropbox(options);

                }

                reader.readAsDataURL(this.files[0]);

                //this.files = [];

            })

            document.querySelector('#btnCrop').addEventListener('click', function () {

                var img = cropper.getDataURL();

                // document.querySelector('.croppedCimg').innerHTML += '<img src="' + img + '">';

                var croppng = cropper.getBlob();

                uploadFile(croppng);



            })

            document.querySelector('#btnZoomIn').addEventListener('click', function () {

                cropper.zoomIn();

            })

            document.querySelector('#btnZoomOut').addEventListener('click', function () {

                cropper.zoomOut();

            });



            $(".popup").hide();



        };



        function uploadFile(cropf) {

            file = cropf;

            if (file != undefined) {

                formData = new FormData();

                formData.append("cropimage", file);



                $.ajax({

                    url: "{{ route('uploadProfileImg') }}",

                    type: "POST",

                    data: formData,

                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                    processData: false,

                    contentType: false,



                    success: function (data) {

                        //alert('success updating profile image.');

                        swal("Good job!", "Success updating profile image!", "success");


                        location.reload();
                        // var elements = document.getElementsByClassName('imageBoxCimg');

                        // while (elements.length > 0) {

                        //     elements[0].parentNode.removeChild(elements[0]);

                        // }



                        // var elements = document.getElementsByClassName('actionCimg');

                        // while (elements.length > 0) {

                        //     elements[0].parentNode.removeChild(elements[0]);

                        // }

                    }



                }).ajaxError(function( event, request, settings ) {

                    $( "#msg" ).append( "<li>Error requesting page " + settings.url + "</li>" );

                  });;



            } else {

                alert('Input something!');

            }

        }



        $('#saveButtonCompanyProfile').click(function () {

            $('#company_profile_form').submit();

        });
      
        /*$('#attachment_file_upload').submit(function(e) {
            e.preventDefault();
            formData = new FormData(this);
            
            $.ajax({
                url: "{{ route('processPDF') }}",
                type: "POST",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (data) {
                    console.log(data + " lalala j");
                },
                error: function(xhr, status, error) {
                  console.log(xhr.responseText);
                }
            });

        });*/



        function processRemoveFile(cId, divIdx, fname) {



            swal({

                title: "Are you sure to delete this file '" + fname + "'?",

                text: "You will not be able to recover this file!",

                icon: "warning",

                buttons: [

                    'No, cancel it!',

                    'Yes, I am sure!'

                ],

                dangerMode: true,

            }).then(function (isConfirm) {

                if (isConfirm) {

                    swal({

                        title: 'Succesful',

                        text: 'Files has been removed',

                        icon: 'success'

                    }).then(function () {

                        //form.submit(); // <--- submit form programmatically



                        formData = new FormData();

                        formData.append("fileupload_id", cId);

                        $.ajax({

                            url: "{{ route('delUploadedFile') }}",

                            type: "POST",

                            data: formData,

                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                            processData: false,

                            contentType: false,



                            success: function (data) {

                                $('#' + divIdx + cId).remove();

                            }



                        });





                    });

                } else {

                    swal("Cancelled", "", "error");

                }

            })



        }

    </script>



    <script>

        $(function () {

            $("#tabs").tabs();

            // $("#datepicker_dob").datepicker();

            // $("#financial_year_end").datepicker();



        });





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



        $("#ajxUpdateKM").click(function () {



            var userId = $("#user_id_km").val();

            var fname = $("#first_name_km").val();

            var lname = $("#last_name_km").val();

            var idnpassport = $("#idn_passport_km").val();

            var nationality = $("#nationality_km").val();

            var gender = $('input[name=gender]:checked').val();

            var dob = $("#datepicker_dob").val();

            var shareholder = $("#shareholder_km").val();

            var isDirectorship = $('input[name=is_directorship]:checked').val();

            var position = $("#position_km").val();

            var kmid = $("#km_id").val();

            formData = new FormData();

            formData.append("km_id", kmid);

            formData.append("user_id", userId);

            formData.append("first_name", fname);

            formData.append("last_name", lname);

            formData.append("idn_passport", idnpassport);

            formData.append("nationality", nationality);

            formData.append("gender", gender);

            formData.append("date_of_birth", dob);

            formData.append("shareholder", shareholder);

            formData.append("is_directorship", isDirectorship);

            formData.append("position", position);


            $.ajax({

                url: "{{route('saveKM')}}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,



                success: function (data) {

                    $(".popup").hide(250);

                    $("#keyPersonnels").html(data);

                    document.location = "{{ route('editProfile') }}";

                }

            });



        });



        function delKM(tor, idx) {

            var txt;

            var r = confirm("Are you sure to delete personnel number " + idx + "  ?");

            if (r == true) {



                formData = new FormData();

                formData.append("km_id", tor);



                $.ajax({

                    url: "{{ route('deleteKM') }}",

                    type: "POST",

                    data: formData,

                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                    processData: false,

                    contentType: false,



                    success: function (data) {

                        document.location = "{{ route('editProfile') }}";

                    }

                });





            } else {

                txt = "You pressed Cancel!";

            }



        }



        function editKM(tor) {

            $("#km_id").val(tor);



            formData = new FormData();

            formData.append("km_id", tor);



            $.ajax({

                url: "{{ route('editKM') }}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,



                success: function (data) {

                    $("#user_id_km").val(data.user_id);

                    $("#first_name_km").val(data.first_name);

                    $("#last_name_km").val(data.last_name);

                    $("#idn_passport_km").val(data.idn_passport);

                    $("#nationality_km").val(data.nationality);

                    $("#default_datepicker_dob").val( data.date_of_birth) ;

                    $("#shareholder_km").val(data.shareholder);

                    $("#position_km").val(data.position);

                    $("input[name=gender]").val([data.gender]);

                    $("input[name=is_directorship]").val([data.is_directorship]);

                    dropDateKM();

                }

            });



        }



        function clearKM() {

            $("#first_name_km").val('');

            $("#last_name_km").val('');

            $("#idn_passport_km").val('');

            $("#nationality_km").val('');

            $("#default_datepicker_dob").val('');

            $("#shareholder_km").val('');

            $("#position_km").val('');

            $("input[name=gender]").val([]);

            $("input[name=is_directorship]").val([]);

            $("#km_id").val(0);

            dropDateKM();

        }



        function addPercent() {

            var r = $("#shareholder_km").val();

            if (r.indexOf('%') > -1) {

                $("#shareholder_km").val(r);

            } else {

                $("#shareholder_km").val(r + '%');

            }

        }



        function updateExpirydate(strExpiry)

        {

         var dateValue =  $("#expiryDate"+strExpiry).val();



          formData = new FormData();

          formData.append("file_id", strExpiry);

          formData.append("date_value", dateValue);



            $.ajax({

                url: "{{ route('updateFileExpiry') }}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,



                success: function (data) {

                    $("#expiryDate"+strExpiry).prop("disabled", true);

                    swal("Good job!", "Success updating expiray date!", "success");

                }

            });



        }


        function editExpirydate(strExpiry)

        {

            $("#expiryDate"+strExpiry).prop("disabled", false);

            $("#expiryDate"+strExpiry).datepicker({ dateFormat: 'yy-mm-dd' });

        }

        function dropDateKM(){
                var default_datepicker_dob = $("#default_datepicker_dob").val();
                $("#datepicker_dob").dateDropdowns({
                    defaultDate: default_datepicker_dob,
                    required: true
                });
        }

        /*$("#description").keyup(function(){
            $("#count").text((500 - $(this).val().length));
        }); */

        var maxLength = 500;
        $('#description').keyup(function() {
          var length = $(this).val().length;
          var length = maxLength-length;
          $(this).parent().find('#count').text(length +"/"+maxLength);
        });


    $(document).ready(function(){
           
        var tour = new Tour({
          steps: [
          {
            element: ".containerCimg",
            title: "PROFILE PICTURE",
            content: "Change your profile picture here if you are premium",
            placement: "top"
          },
          {
            element: "#com_overview_section",
            title: "COMPANY OVERVIEW TAB",
            content: "Overview information about your company",
            placement: "top"
          },
          {
            element: "#com_key_section",
            title: "KEY MANAGEMENT",
            content: "Manage your personal keys here",
            placement: "top"
          },
          {
            element: "#com_info_section",
            title: "COMPANY INFORMATION",
            content: "Manage your company\'s information here",
            placement: "top"
          },
          {
            element: "#com_strength_section",
            title: "COMPANY STRENGTH",
            content: "Uploaded documents, invoices and etc. is in here",
            placement: "top"
          },
          {
            element: "#com_financial_section",
            title: "FINANCIAL STATUS",
            content: "Manage your financial status here",
            placement: "top"
          },
          {
            element: "#saveButtonCompanyProfile",
            title: "SAVE BUTTON",
            content: "Click this to save any updates you\'ve done",
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
        
    });

    </script>

<script>
            $(function() {
                var default_financial_year = $("#default_financial_year_end").val();
                $("#financial_year_end").dateDropdowns({
                    defaultDate: default_financial_year,
                    required: true
                });
                 $('#mask_incorporation_date').mask('0000-00-00');

                // Set all hidden fields to type text for the demo
                // $('input[type="hidden"]').attr('type', 'text').attr('readonly', 'readonly');
            });
        </script>

    <script src="{{ asset('public/drop-date/jquery.date-dropdowns.js') }}"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
@endsection