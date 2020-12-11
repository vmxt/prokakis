@extends('layouts.app')

@section('content')

<script type='text/javascript' src='https://cdn.scaledrone.com/scaledrone.min.js'></script>

<style>
    body {
      display: flex;
      height: 100vh;
      margin: 0;
      align-items: center;
      justify-content: center;
      padding: 0 50px;
      font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    }
    video {
      max-width: calc(50% - 100px);
      width: 50%;
      margin: 0 50px;
      box-sizing: border-box;
      border-radius: 2px;
      padding: 0;
      box-shadow: rgba(156, 172, 172, 0.2) 0px 2px 2px, rgba(156, 172, 172, 0.2) 0px 4px 4px, rgba(156, 172, 172, 0.2) 0px 8px 8px, rgba(156, 172, 172, 0.2) 0px 16px 16px, rgba(156, 172, 172, 0.2) 0px 32px 32px, rgba(156, 172, 172, 0.2) 0px 64px 64px;
    }
    .copy {
      position: fixed;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 16px;
      color: rgba(0, 0, 0, 0.5);
    }
  </style>


  <br />
  <br />
  <div class="alert alert-info" style="width: 100%; overflow: hidden; margin-left: 0px !important;">
  <p class="chat-intro-text"> Welcome to ProKakis Video Chat! 
    <br>
        Congrats for finding your potential business match. 
        Get started by introducing yourself & your company to the opportunity provider. Please be as respectful as possible when connecting with your potential partner.
        Good luck! 
  </p>
  </div>
 
  <?php if($isOnline == 0) { ?>
  <div class="alert alert-warning" role="alert">The company provider is not online.</div>
  <?php } ?>

  
  <div>
  <video id="remoteVideo" style="float:right;" autoplay></video>  
  <video id="localVideo" style="float:left;" autoplay muted></video>
  </div>
  <br />

  <?php if($eVC != ''){ ?>
  <div align="center" style="padding-bottom: 20px; padding-top: 30px; clear:both">
    <a href="<?php echo url('/vc-end/'.$eVC); ?>" class="btn btn-primary ">End Video Chat Session</a>
  </div>
  <?php } ?>
 
  <script src="{{ asset('public/vc/script.js') }}"></script>

  <script>
  $(document).ready(function() {
    var url  = window.location.href;
    console.log("current url:  " + url);

    formData = new FormData();
    formData.append("vc_url", url);
  
        $.ajax({
            url: "{{ route('getVideoChatDetails') }}",
            type: "POST",
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            processData: false,
            contentType: false,

        });


        <?php if($eVC == ''){ ?>  
        setTimeout(function () { location.reload(true); }, 5000);
        <?php } ?>  

  });
 </script>
@endsection