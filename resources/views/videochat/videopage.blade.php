@extends('layouts.app')



@section('content')



<script type='text/javascript' src='https://cdn.scaledrone.com/scaledrone.min.js'></script>



<style>

    .video {
      width:100%;
      height:60vh;
      box-sizing: border-box;
      border-radius: 5px;
      padding: 0;
      border:1px solid silver;
      background:black;
      margin-bottom:5px;
    }
    
    .video .name{
      position: absolute;
      display: block;
      z-index: 150;
      left: 25px;
      top: 10px;
      padding-top:6px;
      padding-bottom:6px;
      padding-left:15px;
      padding-right:15px;
      border-radius:5px;
      font-weight:bold;
    }
    
    video {
      width:100%;
      height:100%;
      
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



  <div class="alert bg-dark text-white" style="width: 100%; overflow: hidden; margin-left: 0px !important;">

  <p class="chat-intro-text"> <b class="text-company">Welcome to Intellinz Video Chat! </b>

    <br>

        Congrats for finding your potential business match. 

        Get started by introducing yourself & your company to the opportunity provider. Please be as respectful as possible when connecting with your potential partner.

        Good luck! 

  </p>

  </div>

 

  <?php if($isOnline == 0) { ?>

  <div class="alert alert-warning" role="alert">The company provider is not online.</div>

  <?php } ?>



  

  <div class="row">
    <div class="col-md-6 mb-2" >
        <div class="video" id="local_video_div">
            
            <div class="name  bg-company text-dark" >
                ME
            </div>
            <video id="localVideo"  autoplay muted></video>
        </div>
        
    </div>
    <div class="col-md-6 mb-2">
        <div class="video">
            <div class="name  bg-company text-dark">
                <?php 
                $company_id_result = App\CompanyProfile::getCompanyId(Auth::id());
                
                if($company_id_result == $companyViewer){
                  $company = App\CompanyProfile::where('id',  $companyOpp)->first();  
                }
                else{
                    $company = App\CompanyProfile::where('id',  $companyViewer)->first();
                }
                    echo strtoupper($company->company_name);
                ?>
            </div>
            <video id="remoteVideo"  autoplay></video>
        </div>
    </div>
  </div>

  <br />

 <?php if($eVC != ''){ ?>
  <div align="center" style="padding-bottom: 20px; padding-top: 30px; clear:both">
    <a href="<?php echo url('/vc-end/'.$eVC); ?>" class="btn btn-danger "><i class="fa fa-phone"></i> End Video Chat Session</a>
  </div>
  <?php } else { ?>
    <div align="center" style="padding-bottom: 20px; padding-top: 30px; clear:both">
      Please wait..while video is initialising.
    </div>
  <?php } ?>
 

  <script src="{{ asset('public/vc/script.js') }}"></script>
  
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="https://heyman.github.io/jquery-draggable-touch/jquery.draggableTouch.js"></script>

<script type="text/javascript">
  var url  = window.location.href;
      formData = new FormData();

   formData.append("vc_url", url);
              $.ajax({
                url: "{{ route('getVideoChatDetails') }}",
                type: "POST",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                  console.log(data);
                },
                error: function (data) {
                  console.log("error:" + data);
                }
            });
</script>

  <script>

  $(document).ready(function() {
      var win = $(window); //this = window  //"position":"fixed"  //
        
        if (win.width() <= 991) {
            $("#local_video_div").css({ "height":"200px", "width":"200px", "z-index":"4324325432543423", "position":"fixed", "right":"10px"});
            $("#local_video_div").draggableTouch();
        }
      
    $(window).on('resize', function(){
        var win = $(this); //this = window
        
        if (win.width() <= 991) {
            $("#local_video_div").css({ "height":"200px", "width":"200px", "z-index":"4324325432543423", "position":"fixed", "right":"10px"  });
            $("#local_video_div").draggableTouch();
        }
        else{
            
            $("#local_video_div").css({ "height":"60vh", "width":"100%", "z-index":"4324325432543423", "position":"unset"  });
            $("video").css({ "height":"100%", "width":"100%" });
            $("#local_video_div").draggableTouch("disable");
        }
    });
     
    // var url  = window.location.href;

    // console.log("current url:  " + url);



    // formData = new FormData();

    // formData.append("vc_url", url);

  

    //     $.ajax({

    //         url: "{{ route('getVideoChatDetails') }}",

    //         type: "POST",

    //         data: formData,

    //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

    //         processData: false,

    //         contentType: false,



    //     });





        <?php if($eVC == ''){ ?>  

       // setTimeout(function () { location.reload(true); }, 5000);

        <?php } ?>  



  });

 </script>

@endsection