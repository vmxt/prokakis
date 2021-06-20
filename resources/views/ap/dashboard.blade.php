@extends('layouts.app')

<style>
    html,body
    {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
    }

</style>

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
<style>
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
   
.btn-x3 {
   font-size: 15px;
   border-radius: 5px;
   width: 25%;
   background-color: orangered;
   margin-top: 10px;
   }

.close {
   line-height: 12px;
   width: 18px;
   font-size: 8pt;
   font-family: tahoma;
   margin-top: 20px;
   margin-right:20px;
   position: absolute;
   top: 0;
   right: 0;
}



* {
   margin:0;
   padding:0;
}

.pie {
   background-color:#ecc0b7;
   width:200px;
   height:200px;
   -moz-border-radius:100px;
   -webkit-border-radius:100px;
   border-radius:100px;
   position:relative;
}
.clip1 {
   position:absolute;
   top:0;
   left:0;
   width:200px;
   height:200px;
   clip:rect(0px, 200px, 200px, 100px);
}
.slice1 {
   position:absolute;
   width:200px;
   height:200px;
   clip:rect(0px, 100px, 200px, 0px);
   -moz-border-radius:100px;
   -webkit-border-radius:100px;
   border-radius:100px;
   background-color:#f7e5e1;
   border-color:#f7e5e1;
   -moz-transform:rotate(0);
   -webkit-transform:rotate(0);
   -o-transform:rotate(0);
   transform:rotate(0);
}
.clip2 {
   position:absolute;
   top:0;
   left:0;
   width:100px;
   height:100px;
   clip:rect(0, 100px, 200px, 0px);
}
.slice2 {
   position:absolute;
   width:200px;
   height:200px;
   clip:rect(0px, 200px, 200px, 100px);
   -moz-border-radius:100px;
   -webkit-border-radius:100px;
   border-radius:100px;
   background-color:#f7e5e1;
   border-color:#f7e5e1;
   -moz-transform:rotate(0);
   -webkit-transform:rotate(0);
   -o-transform:rotate(0);
   transform:rotate(0);
}
.status {
   position:absolute;
   height:30px;
   width:200px;
   line-height:60px;
   text-align:center;
   top:50%;
   margin-top:-35px;
   font-size:50px;
}
</style>

<div class="container">
   <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
       <li>
           <a href="{{ url('/home') }}">Home</a>
           <i class="fa fa-circle"></i>
       </li>
       <li>
           <span>Dashboard</span>
       </li>
   </ul>

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
   
   <div class="row justify-content-center">
    
               
      
       <div class="col-md-8">
           <!-- graph card -->
           <div class="page-content-inner">
               <div class="mt-content-body">
                   <div class="portlet light ">
                       <div class="well well-lg justify-content-center">
                           <div class="note note-success">
                       
                           </div>

                           <div class="row">

                           To open redemption request page data click <a href="{{ route('APfinalApproverList') }}">here</a> <br /> <br />
                               
                           </div>
                       </div>
                   </div>
               </div>
           </div>
         
       </div>

              
       
       <div class="col-md-4" style="min-height:800px">
        

           <!-- Log activity sidebar -->
           <div class="page-content-inner">
               <div class="mt-content-body">
                   <div class="portlet light ">
                       <div class="card">
                           <div class="card-header" style="margin-bottom: 25px;"><b>Last Activity</b> </div>
                           <div class="card-body center">
                               <?php
                               $log = App\AuditLog::where('user_id', Auth::id())->orderBy('id', 'desc')->take(10)->get();

                               if(count((array) $log) > 0){
                                   foreach ($log as $l) {
                                       echo date("F j, Y, g:i a", strtotime($l->created_at)).'<br />';
                                       echo '<a href="">'.$l->action.' '.$l->model.'</a><br /><br />';

                                   }
                               }
                               ?>
                           </div>
                       </div>
                   </div>
               </div>
           </div>





           
            
       </div>
               

       </div>

</div>

<script src="{{ asset('public/jq1110/jquery.min.js') }}"></script>
<script>
$(document).ready(function(){

$(".close").click(function(){
     $(".jumbotron").remove();
  });

 
});  


function rotate(element, degree) {
   element.css({
       '-webkit-transform': 'rotate(' + degree + 'deg)',
           '-moz-transform': 'rotate(' + degree + 'deg)',
           '-ms-transform': 'rotate(' + degree + 'deg)',
           '-o-transform': 'rotate(' + degree + 'deg)',
           'transform': 'rotate(' + degree + 'deg)',
           'zoom': 1
   });
}

function progressBarUpdate(x, outOf) {
   var firstHalfAngle = 180;
   var secondHalfAngle = 0;

   // caluclate the angle
   var drawAngle = x / outOf * 360;

   // calculate the angle to be displayed if each half
   if (drawAngle <= 180) {
       firstHalfAngle = drawAngle;
   } else {
       secondHalfAngle = drawAngle - 180;
   }

   // set the transition
   rotate($(".slice1"), firstHalfAngle);
   rotate($(".slice2"), secondHalfAngle);

   // set the values on the text
   $(".status").html(x + "%");
}


</script>

@endsection







